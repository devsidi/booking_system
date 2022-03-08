<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class doctorEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $doctorEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doctorEmail)
    {
        return $this->doctorEmail=$doctorEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->view('emails.doctorEmail');
    }
}
