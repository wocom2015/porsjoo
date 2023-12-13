<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class changePass extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $newPass;
    public function __construct($newPass)
    {
        $this->newPass = $newPass;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('newPass',[$this->newPass]);
    }
}
