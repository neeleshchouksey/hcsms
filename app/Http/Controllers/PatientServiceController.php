<?php

namespace App\Http\Controllers;
use Helper;
use App\ReminderSms;
use App\ReminderDays;
use App\RemiderTime;
use App\RemindarDuration;
use App\Service;
use App\Patient;
use App\PatientService;
use App\PatientReminderDays;
use App\PatientReminderTime;
use Illuminate\Http\Request;

class PatientServiceController extends Controller
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
        // echo $request->service;
        // echo $request->patient;
        $where              =    array('patient_id'=>$request->patient,'service_id'=>$request->service);
        $patientService     =   PatientService::where($where)->first(); 
        $defaultDays        =   ReminderDays::where('isdefault',1)->pluck('id');
        $defaultTime        =   RemiderTime::where('isdefault',1)->pluck('id');

        if(count($patientService)==0):
            $duration           =   RemindarDuration::where('isdefault',1)->first();

            $patientService                 =       new PatientService;
            $patientService->service_id     =       $request->service;
            $patientService->patient_id     =       $request->patient;
            $patientService->status         =       $request->status;
            $patientService->period         =       6;
            $patientService->duration       =       $duration->id;
            $patientService->save();
            foreach ($defaultDays as $key => $value) {
                # code...
                $patientReminderDays                =       new PatientReminderDays;
                $patientReminderDays->service_id    =       $request->service;
                $patientReminderDays->patient_id    =       $request->patient;
                $patientReminderDays->pat_ser_id    =       $patientService->id;
                $patientReminderDays->day_id        =       $value;
                $patientReminderDays->save();

            }

            foreach ($defaultTime as $key => $value) {
                # code...
                $patientReminderTime                =       new PatientReminderTime;
                $patientReminderTime->service_id    =       $request->service;
                $patientReminderTime->patient_id    =       $request->patient;
                $patientReminderTime->pat_ser_id    =       $patientService->id;
                $patientReminderTime->time_id       =       $value;
                $patientReminderTime->save();

            }
        endif;
        if($request->action=='edit'):
           
            $patientGetServiceDays = PatientReminderDays::where($where)->pluck('day_id')->toArray();
           
            $patientGetServicetime = PatientReminderTime::where($where)->pluck('time_id')->toArray();

            $receiveMessage = array();
           
           if($patientService->reminderMessage()->exists()):

                $remindMessage     = $patientService->reminderMessage()->where('islive',0)->whereHas('receiveMessage',function($q){ $q->whereNotNull('original_message_id');})->latest()->first();
                if(!empty($remindMessage))
                    $receiveMessage     =   $remindMessage->receiveMessage;
            endif;
            // echo "<pre>";
            // print_r($receiveMessage);
            
            return \Response::view('partials.ajax.reminder',compact('patientService','patientGetServiceDays','patientGetServicetime','receiveMessage'));

        elseif($request->action=='update'):
          //  echo "$request->start";
        //echo date('Y-m-d H:i:s',strtotime($request->start));die;
            if(isset($request->duration)):
                $patientService->duration       =   $request->duration;
            elseif(isset($request->period)):
                $patientService->period         =   $request->period;
            elseif(isset($request->perweek)):
                $patientService->perweek        =   $request->perweek;
            elseif(isset($request->start)):
                if($request->start==0)
                    $patientService->start_date     =   date('Y-m-d H:i:s');
                else    
                    $patientService->start_date     =   date('Y-m-d H:i:s',strtotime($request->start));
                $this->sendSmsMessage($patientService,'start');
            elseif(isset($request->stop)):
                $patientService->start_date     =   null;
                $this->sendSmsMessage($patientService,'end');
            endif;
            if(isset($request->status))
                $patientService->status         =   $request->status;
            if(isset($request->ongoing)):
                
                $patientService->ongoing         =   $request->ongoing;
            endif;
            $patientService->save(); 
            $patient =  $patientService->patient;
            $service =  Service::find($request->service);
            return \Response::view('partials.ajax.service',compact('patient','service'));
        else:
            return "add";
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function show(PatientService $patientService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientService $patientService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientService $patientService)
    {
        //
        if(isset($request->duration)):
            $patientService->duration       =   $request->duration;
        elseif(isset($request->period)):
            $patientService->period         =   $request->period;
        elseif(isset($request->start)):
            $patientService->start_date     =   date('Y-m-d H:i:s');
        endif;
        $patientService->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientService $patientService)
    {
        //
    }
    public function sendSmsMessage($patientService,$action){
        if($patientService->serviceData->smsTypes()->exists()):
        try {

            // Prepare ClickSend client.
            $client = new \ClickSendLib\ClickSendClient(env('CLICK_SEND_USER'),env('CLICK_SEND_KEY'));

            // Get SMS instance.
            $sms = $client->getSMS();

            $language_id        =   $patientService->patient->language_id;

            $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();
            
            if(empty($smsTypesMessage)){

                $language_id  =1;
                $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();
            
            }
            // The payload.
            
            $textMessage = $smsTypesMessage->languageMessage()->where('language_id',$language_id)->first();

            $textMessage = Helper::change_message_variables($textMessage->message,$patientService);

            $senderId    = $patientService->patient->doctor->sender_id;

            if (empty($senderId)) {
                
                $senderId   =   '+447520619101';

            } 

            $messages =  [
                [
                    "source" => "php",
                    "from" => $senderId,
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
            $reminderSms->patient_service_id     =       $patientService->id;

            $reminderSms->save();
            
        } catch(\ClickSendLib\APIException $e) {

            print_r($e->getResponseBody());

        }
        endif;
    }
}
