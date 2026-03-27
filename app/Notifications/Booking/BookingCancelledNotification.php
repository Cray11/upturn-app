<?php

namespace App\Notifications\Booking;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCancelledNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Booking $booking)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Upturn booking was cancelled')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Your booking reference '.$this->booking->reference_no.' has been marked as cancelled.')
            ->line('If you need a revised schedule, our team can coordinate offline with you.');
    }
}
