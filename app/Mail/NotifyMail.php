<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;
    private $OtpContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($OtpContent, $Subject = NULL, $Attachment = NULL)
    {
        $this->Subject = $Subject;
        $this->Attachment = $Attachment;
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
        $Subject = $this->Subject;
        $Attachment = $this->Attachment;
        if(isset($Subject)||isset($Attachment)){
            $Email = $this->subject($Subject)->view('mail.NewsNotification')->with('OtpMessage',$OtpMessage);
            if(isset($Attachment)){
                $Email->attach($Attachment);
            }
            return $Email;
        }else{
            return $this->subject('Notification from WCMS')->view('mail.WorkFlowNotification')->with('OtpMessage',$OtpMessage);
        }     
        //return $this->subject('Notification from WCMS')->view('mail.WorkFlowNotification')->with('OtpMessage',$OtpMessage);
    }
}
