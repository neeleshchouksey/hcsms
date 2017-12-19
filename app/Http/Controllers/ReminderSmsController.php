<?php

namespace App\Http\Controllers;

use App\ReminderSms;
use App\PatientService;
use Illuminate\Http\Request;
use Helper;

class ReminderSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        echo $id;
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

            $language_id        =   $patientService->patient->language_id;

            $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name','test')->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();
            
            if(empty($smsTypesMessage)){
                $language_id  =1;
                $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name','test')->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();
            }
            // The payload.
          
            $textMessage = $smsTypesMessage->languageMessage()->where('language_id',$language_id)->first();

            $textMessage = Helper::change_message_variables($textMessage->message,$patientService);

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
    public function ajaxLoad($id){
        //echo $id;
        $reminderSms        =       ReminderSms::whereHas('parentService',
                                        function($q1) use($id){
                                            $q1->whereHas('patient',
                                                function($q2) use($id){
                                                    $q2->where('id',$id);
                                                });

                                        }
                                    )->get();

        $records            =       array();

        $i = 0;

        foreach ($reminderSms as $sms) {
            
            // $records[$i]['day']         =       date('Y-m-d',strtotime($sms->sms_time));
            // $records[$i]['time']        =       date('H:i:s',strtotime($sms->sms_time));
            $records[$i]['day']         =       $sms->created_at->format('Y-m-d');
            $records[$i]['time']        =       $sms->created_at->format('H:i:s');
            $records[$i]['to']          =       $sms->to;
            $records[$i]['from']        =       $sms->from;
            $records[$i]['message']     =       $sms->body;
            $records[$i]['service']     =       $sms->parentService->serviceData->name;
            $records[$i]['action']      =       '<a href="javascript:void(0);" class="messageReply" id="'.$sms->message_id.'">View Reply</a>';
            $i++;
        }
        return \Response::json(compact('records','columns'));
    }
}
