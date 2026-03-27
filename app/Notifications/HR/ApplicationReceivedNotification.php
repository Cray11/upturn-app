<?php

namespace App\Notifications\HR;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Application $application)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New job application received')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('A new application has been submitted for '.$this->application->jobPosting?->title.'.')
            ->line('Applicant: '.$this->application->applicant_name)
            ->line('Please review the application in the HR panel.');
    }
}
