<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAppBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $UserAppBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($UserAppBooking)
    {
        $this->UserAppBooking=$UserAppBooking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.UserAppBooking');
    }
}
