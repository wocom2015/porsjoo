<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class planBought extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $planName;
    private $planExpire;
    public function __construct($planName , $planExpire)
    {
        $this->planName = $planName;
        $this->planExpire = $planExpire;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('planBought',[$this->planName , $this->planExpire]);
    }
}
