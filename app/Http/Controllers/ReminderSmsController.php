<?php

namespace App\Http\Controllers;

use App\ReminderSms;
use App\PatientService;
use Illuminate\Http\Request;

class ReminderSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            // Prepare ClickSend client.
            $client = new \ClickSendLib\ClickSendClient(env('CLICK_SEND_USER'),env('CLICK_SEND_KEY'));

            // Get SMS instance.
            $sms = $client->getSMS();

            $patientService     =   PatientService::find($request->patient_service_id);
            /*echo "<pre>";
            print_r($patientService->patient->mobile);
            die;*/
            // The payload.
            $textMessage = "Dear ".$patientService->patient->name.", this is a demonstration of how to send your Blood Pressure reading.  Please reply with your reading, simply enter First Number then a space then the Second Number.";
            $messages =  [
                [
                    "source" => "php",
                    //"from" => "sendmobile",
                    "body" => $textMessage,
                    "to" => $patientService->patient->mobile,
                    //"schedule" => 1536874701,
                    "custom_string" => "this is a test"
                ]
                
            ];


            // Send SMS.
            $response   =   $sms->sendSms(['messages' => $messages]);
            $message    =   $response->data->messages[0];
            $reminderSms                         =       new ReminderSms;
            $reminderSms->sms_time               =       $message->date;
            $reminderSms->to                     =       $message->to;
            $reminderSms->from                   =       $message->from;
            $reminderSms->body                   =       $message->body;
            $reminderSms->message_id             =       $message->message_id;
            $reminderSms->custom_string          =       $message->custom_string;
            $reminderSms->islive                 =       0;
            $reminderSms->user_id                =       $message->user_id;
            $reminderSms->patient_service_id     =       $request->patient_service_id;

            $reminderSms->save();
        } catch(\ClickSendLib\APIException $e) {

            print_r($e->getResponseBody());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function show(ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function edit(ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReminderSms $reminderSms)
    {
        //
    }
}
