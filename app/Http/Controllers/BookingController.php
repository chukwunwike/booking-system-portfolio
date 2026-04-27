<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CorePHP\BookingEngine;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->with('service')->latest()->get();

        return view('bookings.index', compact('services', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Integrate with the Core PHP Module
        // We pass the raw PDO connection from Laravel to the raw PHP module.
        $pdo = DB::connection()->getPdo();
        $engine = new BookingEngine($pdo);

        $startTime = \Carbon\Carbon::parse($request->start_time)->format('Y-m-d H:i:s');
        $endTime = \Carbon\Carbon::parse($request->end_time)->format('Y-m-d H:i:s');

        $result = $engine->createBooking(
            auth()->id(),
            $request->service_id,
            $startTime,
            $endTime
        );

        if ($result['success']) {
            // Mock Email Notification
            \Illuminate\Support\Facades\Log::info("EMAIL SENT: Booking confirmation for Booking ID {$result['booking_id']} to " . auth()->user()->email);
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
