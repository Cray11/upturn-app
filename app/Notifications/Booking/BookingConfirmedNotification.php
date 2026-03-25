<?php

namespace App\Notifications\Booking;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmedNotification extends Notification
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
            ->subject('Your Upturn booking is confirmed')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Your booking reference '.$this->booking->reference_no.' has been confirmed.')
            ->line('Booking date: '.$this->booking->booking_date?->format('F j, Y'))
            ->line('Thank you for choosing Upturn Business Solutions.');
    }
}
