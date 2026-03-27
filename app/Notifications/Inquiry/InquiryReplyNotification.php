<?php

namespace App\Notifications\Inquiry;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryReplyNotification extends Notification
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
            ->subject('Upturn inquiry update')
            ->greeting('Hello '.$this->inquiry->name.',')
            ->line('Your inquiry has been updated by the Upturn team.')
            ->line('You can continue coordinating with the team through the contact details they provided.');
    }
}
