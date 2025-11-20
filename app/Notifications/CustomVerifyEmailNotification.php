<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class CustomVerifyEmailNotification extends VerifyEmailNotification
{
    /**
     * Get the notification's mail representation.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Seu link de verificação chegou!!!!')
            ->view('emails.verify-email', [
                'name' => $notifiable->name,
                'verificationUrl' => $url,
            ]);
    }
}