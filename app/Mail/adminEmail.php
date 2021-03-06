<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class adminEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $adminEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminEmail)
    {
        return $this->adminEmail=$adminEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.AdminBooking');
    }
}
