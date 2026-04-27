<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
});

Route::get('/dashboard', function () {
    return redirect()->route('bookings.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');

    // Hybrid Booking Routes
    Route::get('/bookings', [\App\Http\Controllers\BookingController::class , 'index'])->name('bookings.index');
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class , 'store'])->name('bookings.store');
});

require __DIR__ . '/auth.php';
