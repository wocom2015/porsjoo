<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class requestComment extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $inquiryName;
    public function __construct($inquiryName)
    {
        $this->inquiryName = $inquiryName;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('requestComment',[$this->inquiryName]);
    }
}
