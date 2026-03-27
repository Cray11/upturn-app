<?php
namespace App\Services\Booking;

use App\Models\Booking;
use App\Notifications\Booking\BookingConfirmedNotification;
use App\Notifications\Booking\BookingCancelledNotification;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Create a new booking manually (entered by admin/staff after a deal
     * is closed via call by the marketing department).
     */
    public function create(array $data): Booking
    {
        $booking = Booking::create([
            ...$data,
            'reference_no' => $this->generateReference(),
            'status'       => 'confirmed',
        ]);

        if (!empty($data['addons'])) {
            $this->attachAddons($booking, $data['addons']);
        }

        return $booking;
    }

    /** Confirm a pending booking and notify the client. */
    public function confirm(Booking $booking): Booking
    {
        $booking->update(['status' => 'confirmed']);
        $booking->user?->notify(new BookingConfirmedNotification($booking));
        return $booking->fresh();
    }

    /** Cancel a booking and notify the client. */
    public function cancel(Booking $booking, string $reason = ''): Booking
    {
        $booking->update(['status' => 'cancelled', 'notes' => $reason]);
        $booking->user?->notify(new BookingCancelledNotification($booking));
        return $booking->fresh();
    }

    /** Mark a booking as completed. */
    public function complete(Booking $booking): Booking
    {
        $booking->update(['status' => 'completed']);
        return $booking->fresh();
    }

    /** Attach add-ons to a booking. */
    public function attachAddons(Booking $booking, array $addons): void
    {
        foreach ($addons as $addon) {
            $booking->addons()->create([
                'addon_name' => $addon['name'],
                'price'      => $addon['price'],
            ]);
        }
    }

    private function generateReference(): string
    {
        return 'UPT-' . strtoupper(Str::random(8));
    }
}
