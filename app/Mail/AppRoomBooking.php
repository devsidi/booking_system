<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppRoomBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $AppRoomBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($AppRoomBooking)
    {
        $this->AppRoomBooking=$AppRoomBooking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.AppRoomBooking');
    }
}
