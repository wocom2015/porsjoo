<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Kavenegar\Laravel\Notification\KavenegarBaseNotification;

class NewPJ extends KavenegarBaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $category;
    public function __construct($category)
    {
        $this->category = $category;
    }

    public function toKavenegar($notifiable)
    {
        return (new KavenegarMessage())
            ->verifyLookup('newPJ', ["درخواست"]);
    }
}
