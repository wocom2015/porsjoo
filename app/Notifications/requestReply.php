<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class requestReply extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $pjName;
    public function __construct($pjName)
    {
        $this->pjName = $pjName;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('requestReply',[$this->pjName]);
    }
}
