<?php

namespace App\Notifications\Inquiry;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Inquiry $inquiry)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New website inquiry received')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('A new inquiry has been submitted through the public website.')
            ->line('Client: '.$this->inquiry->name)
            ->line('Service interest: '.($this->inquiry->service_interest ?: 'Not specified'))
            ->line('Please review it in the admin panel.');
    }
}
