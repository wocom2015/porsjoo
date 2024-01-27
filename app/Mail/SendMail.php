<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    //php artisan make:email SendMail

    use Queueable, SerializesModels;

    public $name, $email, $emailMessage, $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $title, $emailMessage)
    {
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->emailMessage = $emailMessage;


    }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->email, $this->name),
            subject: $this->title,
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact');
    }
}
