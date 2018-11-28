<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SharedHistory extends Mailable
{
    use Queueable, SerializesModels;
    public $textMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textMessage)
    {
        //
        $this->textMessage  =    $textMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.shared')->from('info@whitebrains.in','admin')->subject('Shared History');;
    }
}
