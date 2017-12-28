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
        // initalizin where array for check condition 
        $where              =    array('patient_id'=>$request->patient,'service_id'=>$request->service);

        // get patient servive data from database
        $patientService     =   PatientService::where($where)->first(); 

        // get all default values of  days from database
        $defaultDays        =   ReminderDays::where('isdefault',1)->pluck('id');

        // get all defualt values of time from database
        $defaultTime        =   RemiderTime::where('isdefault',1)->pluck('id');

        /**
        * check if service is exists in patient service database if not exists
        * in database then insert service in patient service database
        */
        if(count($patientService)==0):

            // get default duration from database
            $duration           =   RemindarDuration::where('isdefault',1)->first();

            /**
             * Insert Service in patient service table
             * 
             * @var        PatientService
             */

            $patientService                 =       new PatientService;
            $patientService->service_id     =       $request->service;
            $patientService->patient_id     =       $request->patient;
            $patientService->status         =       $request->status;
            $patientService->period         =       6;
            $patientService->duration       =       $duration->id;
            $patientService->save();

            /**
             * insert default reminder days in patient reminder days table
             */

            foreach ($defaultDays as $key => $value) {
                # code...
                $patientReminderDays                =       new PatientReminderDays;
                $patientReminderDays->service_id    =       $request->service;
                $patientReminderDays->patient_id    =       $request->patient;
                $patientReminderDays->pat_ser_id    =       $patientService->id;
                $patientReminderDays->day_id        =       $value;
                $patientReminderDays->save();

            }

            /**
             * insert default reminder times in patient reminder times table
             */
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

        /**
         * Check current action 
         * if action edit then get patient remider service ,days ,times 
         * and previously selected or inserted values in reminder popup
         */

        if($request->action=='edit'):
            
            /* get patient reminder days  in array form*/   
            $patientGetServiceDays = PatientReminderDays::where($where)->pluck('day_id')->toArray();

            /* get patient reminder times in array form*/           
            $patientGetServicetime = PatientReminderTime::where($where)->pluck('time_id')->toArray();

            /* define empty array for store for get last receive test message */
            $receiveMessage = array();

            /**
             * check  reminder  messages are exists in database or not
             */
           if($patientService->reminderMessage()->exists()):

                /**
                 * if reminder messages  exists in database
                 * then find test message is exists in database or not
                 *
                 * @var        <type>
                 */

                $remindMessage     = $patientService->reminderMessage()->where('islive',0)->whereHas('receiveMessage',function($q){ $q->whereNotNull('original_message_id');})->latest()->first();
                
                /**
                 * if reminder test message is exists them check it reply is exist in database or not
                 * if reply exist then assign receive test message value to receive message variable
                 */
                if(!empty($remindMessage))
                    $receiveMessage     =   $remindMessage->receiveMessage;

            endif;
            
            /**
             * Pass patient service , patient service days and patient service time and receive message in view 
             * and return view for ajax response
             */
            return \Response::view('partials.ajax.reminder',compact('patientService','patientGetServiceDays','patientGetServicetime','receiveMessage'));

        /**
         * Check curent action 
         * if current action is update then
         * update patient sevice column base on post keys 
         */
        elseif($request->action=='update'):

            /**
             * update duration if duration set in post value
             */
            if(isset($request->duration)):
                $patientService->duration       =   $request->duration;

            /**
             * update period if period set in post value
             */
            elseif(isset($request->period)):
                $patientService->period         =   $request->period;

            /**
             * update perweek if perweek set in post value
             */
            elseif(isset($request->perweek)):
                $patientService->perweek        =   $request->perweek;

            /**
             * update bg_number if maxbp set in post value
             */
            elseif(isset($request->maxbp)):
                $patientService->bg_number      =   $request->maxbp;

            /**
             * update sm_number if minbp set in post value
             */
            elseif(isset($request->minbp)):
                $patientService->sm_number       =   $request->minbp;

            /**
             * update low_alert if lowalert set in post value
             */
            elseif(isset($request->lowalert)):
                $patientService->low_alert        =   $request->lowalert;

            /**
             * update high_alert if highalert set in post value
             */
            elseif(isset($request->highalert)):
                $patientService->high_alert        =   $request->highalert;

            /**
             * update very_low_alert if verylowalert set in post value
             */
            elseif(isset($request->verylowalert)):
                $patientService->very_low_alert        =   $request->verylowalert;

            /**
             * update very_high_alert if veryhighalert set in post value
             */
            elseif(isset($request->veryhighalert)):
                $patientService->very_high_alert        =   $request->veryhighalert;

            /**
             * update start date if start date set in post value
             */
            elseif(isset($request->start)):
                
                /**
                 * check if start date value is zero
                 * then set current time as start date and time
                 */


                if($request->start==0)
                    $patientService->start_date     =   date('Y-m-d H:i:s');

                /**
                 * else set post start time as start date
                 */
                else    
                    $patientService->start_date     =   date('Y-m-d H:i:s',strtotime($request->start));
                /**
                 * call helper fuction for sent service start message
                 */
                Helper::sendSmsMessage($patientService,'start');

             /**
              * if stop is set then set start date value null
              */
            elseif(isset($request->stop)):

                $patientService->start_date     =   null;

                /**
                 * call helper function for send end service message 
                 */
                Helper::sendSmsMessage($patientService,'end');

            endif;

            /**
             * Check if status is set then updte status
             */
            if(isset($request->status))
                $patientService->status         =   $request->status;

            /**
             * Check if ongoing is set then updte ongoing
             */
            if(isset($request->ongoing)):
                
                $patientService->ongoing         =   $request->ongoing;
            endif;

            /**
             * save patient service data in database
             */
            $patientService->save(); 
            
            /**
             * assign patient to patient variable
             *
             * @var        <type>
             */
            $patient =  $patientService->patient;

            /**
             * find original service
             *
             * @var        <type>
             */

            $service =  Service::find($request->service);

            /**
             * Pass patient and service data in view 
             * and return view data to ajax response
             */
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
