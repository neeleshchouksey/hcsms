<?php

namespace App\Mail;

use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMailStaff extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff)
    {
        //
        $this->staff    =   $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcomeStaff')->from('info@whitebrains.in','admin')->subject('WELCOME EMAIL  FROM  HEALTHCHECK SMS');
    }
}
