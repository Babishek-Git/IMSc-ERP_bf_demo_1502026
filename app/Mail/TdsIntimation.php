<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TdsIntimation extends Mailable
{
    use Queueable, SerializesModels;
    private $OtpContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($OtpContent)
    {
        //
        $this->OtpContent = $OtpContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $OtpMessage = $this->OtpContent;
        return $this->subject('Notification fron WCMS')->view('mail.TdsIntimation')->with('OtpMessage',$OtpMessage);
    }
}
