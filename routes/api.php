<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookingController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('/spaces', [BookingController::class, 'spaces'])->name('spaces');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/bookings',                   [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/{booking}',          [BookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    });
});
