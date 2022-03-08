<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCancelEmailBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $UserCancelEmailBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($UserCancelEmailBooking)
    {
        $this->UserCancelEmailBooking=$UserCancelEmailBooking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.UserCancelEmailBooking');
    }
}
