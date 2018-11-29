<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\PatientService;
class SharedHistory extends Mailable
{
    use Queueable, SerializesModels;
    public $textMessage;
    public $subject;
    public $patientService;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textMessage, PatientService $patientService)
    {
        //
        $this->textMessage      =    $textMessage;
        $this->subject          =    'Medical History for '. $patientService->patient->name;
        $this->patientService   =     $patientService;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.shared')->from('share@mediccomms.com','admin')->subject($this->subject);;
    }
}
