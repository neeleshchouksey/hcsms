<?php

namespace App\Http\Controllers;
use Auth;
use Helper;
use App\ReminderSms;
use App\LanguageSmsMessage;
use App\ReminderDays;
use App\RemiderTime;
use App\RemindarDuration;
use App\Service;
use App\Patient;
use App\ServiceSmsTypes;
use App\Language;
use App\PatientService;
use App\PatientReminderDays;
use App\PatientReminderTime;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
        // initalizing where array for check condition 
        $where              =    array('patient_id'=>$request->patient,'service_id'=>$request->service);

        // get patient servive data from database
        $patientService     =   PatientService::where($where)->first(); 

        // get all default values of  days from database
        $defaultDays        =   ReminderDays::where('isdefault',1)->pluck('id');

        // get all defualt values of time from database
        $defaultTime        =   RemiderTime::where('isdefault',1)->pluck('id');


        /**
         * find original service
         *
         * @var        <type>
         */

        $service =  Service::find($request->service);

        /**
        * check if service is exists in patient service database if not exists
        * in database then insert service in patient service database
        */
        if(empty($patientService)):

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
            $patientService->token          =       uniqid();
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
         * check current action is serviceHistory
         * if action is history then return its receive messages history
         */
        elseif ($request->action=='serviceHistory'):

            /**
             * Call Helper function which takes
             * Patient service and return its history
             */
           return Helper::getServiceHistory($patientService);
        /**
         * check current action is serviceHistory
         * if action is history then return its receive messages history
         */
        elseif ($request->action=='getSmsMessage'):
            
            $language       =   Language::find($request->language);
            $smsTypes       =   ServiceSmsTypes::all();

            /**
             * Call Helper function which takes
             * Patient service and return its history
             */
            return \Response::view('partials.ajax.viewLanguageMessage',compact('language','smsTypes'));

         /**
         * check current action is serviceHistory
         * if action is history then return its receive messages history
         */
        elseif ($request->action=='getServiceSmsMessage'):
            
            $language       =   Language::find($request->language);
            $smsTypes       =   ServiceSmsTypes::where('service_id',$request->service)->get();

            /**
             * Call Helper function which takes
             * Patient service and return its history
             */
            return \Response::view('partials.ajax.viewLanguageMessage',compact('language','smsTypes'));
        
        elseif ($request->action=='getScheduledSmsMessage'):
    
            /**
             * Call Helper function which takes
             * Patient service and return its history
             */
            $requestType = 2;
            
            $patient    =   Patient::find($request->patient);

            $services   =   $request->services;

            return \Response::view('partials.ajax.viewScheduledMessage',compact('patientService','requestType','services'));  
           

         /**
         * check current action is serviceHistory
         * if action is history then return its receive messages history
         */
        elseif ($request->action=='addLanguage'):
            
            $language       =   Language::where('title',$request->language)->first();

            if(empty($language)):
                
                $language           =   new Language;

                $language->title    =   $request->language;

                $language->user_id  =   Auth::user()->id;

                $language->role     =   Auth::user()->role;

                $language->status   =   2;

                $language->save();

                $smsTypes           =   ServiceSmsTypes::all();

                /**
                 * Call Helper function which takes
                 * Patient service and return its history
                 */
                return \Response::view('partials.ajax.addLanguageMessage',compact('language','smsTypes'));   
            else:
                echo "We already have this language,click <a herf='javascript:void(0);' class='showLanguageMessages' value='".$language->id."'>here</a> to view it";   
            endif;
        elseif($request->action=='addLanguageMessage'):
            $smsTypes               =   new LanguageSmsMessage;
            $smsTypes->service_id   =   $request->service_id;
            $smsTypes->language_id  =   $request->language_id;
            $smsTypes->sms_type_id  =   $request->sms_type_id;
            $smsTypes->message      =   $request->message;
            $smsTypes->status       =   0;
            $smsTypes->verified_by  =   0;
            $smsTypes->user_id      =   Auth::user()->id;
            $smsTypes->role         =   Auth::user()->role;
            $smsTypes->save();
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
             * update target if target set in post value
             */
            elseif(isset($request->target)):
                $patientService->target       =   $request->target;
             /**
             * update wheight if wheight set in post value
             */
            elseif(isset($request->wheight)):
                $patientService->wheight       =   $request->wheight;
             /**
             * update wtarget if wtarget set in post value
             */
            elseif(isset($request->wtarget)):
                $patientService->wtarget       =   $request->wtarget;

            /**
             * update bs_low_alert if bslowalert set in post value
             */
            elseif(isset($request->bslowalert)):
                $patientService->bs_low_alert        =   $request->bslowalert;

            /**
             * update bs_high_alert if bshighalert set in post value
             */
            elseif(isset($request->bshighalert)):
                $patientService->bs_high_alert        =   $request->bshighalert;

            /**
             * update bs_very_low_alert if bsverylowalert set in post value
             */
            elseif(isset($request->bsverylowalert)):
                $patientService->bs_very_low_alert        =   $request->bsverylowalert;

            /**
             * update bs_very_high_alert if bsveryhighalert set in post value
             */
            elseif(isset($request->bsveryhighalert)):
                $patientService->bs_very_high_alert        =   $request->bsveryhighalert;


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
             * Pass patient and service data in view 
             * and return view data to ajax response
             */
            return \Response::view('partials.ajax.service',compact('patient','service'));
        elseif($request->action=='appointment'):
            $times          =    RemiderTime::all();
            $patient        =    Patient::find($request->patient);
            $appointments   =   $service->appointments()->where('patient_id',$patient->id)->get();
            return \Response::view('partials.ajax.appointment',compact('service','times','patient','appointments'));
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

    /**
     * generate unique id for existing patient services
     */
    public function generateUniqueId(){
        
        $patients   = PatientService::all();
        foreach ($patients as $patient) {
            $patient->token     =   uniqid();
            $patient->save();
        }
    }
    public function getPatientHistory($id){
        $patientService     =   PatientService::where('token',$id)->first();
        if(empty($patientService))
            return redirect('/');
        $getHistory         =   Helper::getServiceHistory($patientService);
        return view('history.index',compact('getHistory'));
    }
}
