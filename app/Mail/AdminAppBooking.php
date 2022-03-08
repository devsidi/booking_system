<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAppBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $AdminAppBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($AdminAppBooking)
    {
        $this->AdminAppBooking=$AdminAppBooking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.AdminAppBooking');
    }
}
