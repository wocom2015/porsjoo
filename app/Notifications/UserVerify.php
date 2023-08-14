<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class UserVerify extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $active_code = '';
    public function __construct($token)
    {
        $this->active_code = $token;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('verification',[$this->active_code]);
    }
}
