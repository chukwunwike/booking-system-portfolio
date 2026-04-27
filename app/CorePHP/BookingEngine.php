<?php

namespace App\CorePHP;

use PDO;
use Exception;
use DateTime;

/**
 * Pure Core PHP Implementation.
 * Framework-agnostic Booking Engine using raw PDO for logic processing.
 */
class BookingEngine
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        // Enforce strict exception mode for transaction integrity
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    /**
     * Checks if a specific time slot is available for a service.
     */
    public function isAvailable(int $service_id, string $start_time, string $end_time): bool
    {
        $sql = "SELECT id FROM bookings 
                WHERE service_id = :service_id 
                AND status != 'cancelled'
                AND (
                    (:start_time >= start_time AND :start_time < end_time) OR
                    (:end_time > start_time AND :end_time <= end_time) OR
                    (:start_time <= start_time AND :end_time >= end_time)
                ) LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':service_id' => $service_id,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
        ]);

        return $stmt->fetch() === false;
    }

    /**
     * Creates a booking with transaction locking to prevent double bookings.
     */
    public function createBooking(int $user_id, int $service_id, string $start_time, string $end_time): array
    {
        // Formatting and sanitization validation
        if (!$this->validateDates($start_time, $end_time)) {
            return ['success' => false, 'message' => 'Invalid date format or sequence.'];
        }

        try {
            $this->pdo->beginTransaction();

            // Check availability strictly within the transaction
            if (!$this->isAvailable($service_id, $start_time, $end_time)) {
                $this->pdo->rollBack();
                return ['success' => false, 'message' => 'Double Booking Prevented! This time slot is no longer available.'];
            }

            // Insert using raw SQL
            $sql = "INSERT INTO bookings (user_id, service_id, start_time, end_time, status, created_at, updated_at) 
                    VALUES (:user_id, :service_id, :start_time, :end_time, 'confirmed', :created_at, :updated_at)";

            $now = date('Y-m-d H:i:s');

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':service_id' => $service_id,
                ':start_time' => $start_time,
                ':end_time' => $end_time,
                ':created_at' => $now,
                ':updated_at' => $now,
            ]);

            $bookingId = $this->pdo->lastInsertId();
            $this->pdo->commit();

            return ['success' => true, 'message' => 'Booking confirmed!', 'booking_id' => $bookingId];

        }
        catch (Exception $e) {
            $this->pdo->rollBack();
            return ['success' => false, 'message' => 'System error: ' . $e->getMessage()];
        }
    }

    /**
     * Vanilla PHP date validation and sanitization.
     */
    private function validateDates(string $start, string $end): bool
    {
        $format = 'Y-m-d H:i:s';
        $d1 = DateTime::createFromFormat($format, $start);
        $d2 = DateTime::createFromFormat($format, $end);

        if (!$d1 || !$d2 || $d1->format($format) !== $start || $d2->format($format) !== $end) {
            return false;
        }

        return $d1 < $d2;
    }
}
