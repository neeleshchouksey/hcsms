<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Auth;
use App\PracticeType;
use App\StaffStatus;
use App\Permission;
use App\Service;
use App\ReminderDays;
use App\RemiderTime;
use App\RemindarDuration;
use App\Country;
use App\Language;
use App\ReminderSms;
use Carbon\Carbon;
use App\User;
use App\Patient;
use App\PatientService;
use App\PatientAppointment;


class Helpers
{

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function PracticeTypes(){

        /**
         * { item_description }
         */
        return PracticeType::all();

    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function Status(){

        /**
         * { item_description }
         */
        return StaffStatus::all();

    }
    public static function Permission(){
        return Permission::where('is_parent',0)->get();
    }
    public static function Service(){
        return Service::all();
    }
    public static function serviceBasedOnPracticeType(){
    
        $services = Service::whereIn('practice_id',explode(',',Auth::user()->practice_id))->orWhere('practice_id',0)->get();
        return $services;
    }
    public static function ReminderDays(){
        return ReminderDays::all();
    }
    public static function ReminderTimes(){
        return RemiderTime::all();
    }
    public static function ReminderDuration(){
        return RemindarDuration::all();
    }
    public static function Countries(){
        return Country::all();
     }
    public static function languages(){
        return Language::where('status',1)->orderBy('on_top', 'desc')->orderBy('title', 'asc')->get();
    }
    public static function patientsLanguages(){
        return Language::where('status',1)
                        ->has('patients', '>=', 1)
                        ->orderBy('on_top', 'desc')
                        ->orderBy('title', 'asc')->get();
    }
    public static function practices(){
        return User::all();
    }
    public static function change_message_variables($message,$patientService,$receiveMessage='',$action=''){
   
    
        $bphistoryurl   =     url('/'.$patientService->token);
    
        $site_url       =     url('/');
    
        $timezone       =     Self::getPracticeTimeZone($patientService->patient);

        if($patientService->reminderDays):

            $getDays        =     $patientService->reminderDays()->with('dayData')->orderBy('day_id','asc')->get()->toArray();
    
            $getDays        =     self::customArrayMap(array('day_data','abbr'),$getDays);
    
            $message        =     str_replace('@DAYS', $getDays, $message);

        endif;

        $apptlink = url('/appt/'.$patientService->patient->code);

        $message = str_replace('@apptlink', $apptlink, $message);

        if($patientService->timeData):

            $message = str_replace('@DATE', $patientService->appt_date, $message);

            $message = str_replace('@TIME', date('H:i A',strtotime($patientService->appt_time)), $message);

            $message = str_replace('@WITH', $patientService->with, $message);

            $message = str_replace('@LOCATION', $patientService->location, $message);
      
        endif;
    
        if($patientService->reminderTime):

            $getTime        =     $patientService->reminderTime()->with('timeData')->orderBy('time_id','asc')->get()->toArray();

            $getTime        =     self::customArrayMap(array('time_data','title'),$getTime);

            $message        =     str_replace('@TIMES', $getTime, $message);

        endif;

        $message = str_replace('@NAME', $patientService->patient->name, $message);
        
        $message = str_replace('@DOCTORNAME', $patientService->patient->doctor->name, $message);
        
        $message = str_replace('@DOCNUMBER', $patientService->patient->doctor->contact, $message);
        
        $message = str_replace('@PRACTICENAME', $patientService->patient->doctor->name, $message);
        
        $message = str_replace('@GP', $patientService->patient->doctor->name, $message);
        
        $message = str_replace('@PRACTICENUMBER', $patientService->patient->doctor->contact, $message);
        
        $message = str_replace('@PATIENTBPHISTORYLINK', $bphistoryurl, $message);
        
        $message = str_replace('@PATIENTBSHISTORYLINK', $bphistoryurl, $message);
        
        $message = str_replace('@WEBSITE', $site_url, $message);

        $readings = '';

        switch ($action) {

            case 'bphistory':
     
                foreach ($patientService->receiveMessage()->latest()->take(10)->get() as $receiveM) {
                    # code...
                    $receiveMDate     =   $receiveM->created_at->timezone($timezone)->format('d-m-Y');
                    $receiveMTime     =   $receiveM->created_at->timezone($timezone)->format('H:i');
                    $receiveMReading  =   $receiveM->bg_number.'/'.$receiveM->sm_number;

        
                    $readings       .=  "\r\n".$receiveMDate.' '.$receiveMTime.' '.$receiveMReading;
                }
                $message = str_replace('@last-ten-reading', $readings, $message);
            break;

            case 'bshistory':
             
                foreach ($patientService->receiveMessage()->latest()->take(10)->get() as $receiveM) {
                
                    $receiveMDate     =   $receiveM->created_at->timezone($timezone)->format('d-m-Y');
                    $receiveMTime     =   $receiveM->created_at->timezone($timezone)->format('H:i');
                    $receiveMReading  =   $receiveM->body;

                    $readings       .=  "\r\n".$receiveMDate.' '.$receiveMTime.' '.$receiveMReading;
                }
                $message = str_replace('@last-ten-reading', $readings, $message);

            break;

            case 'bpaverage':
            
                $tenDayBg       =   round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(10))->avg('bg_number'),2);
                $tenDaySm       =   round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(10))->avg('sm_number'),2);
                $readings      .=   "\r\n Last 10 Days :"." ".$tenDayBg."/".$tenDaySm;

                $thirtyDayBg    =   round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(30))->avg('bg_number'),2);
                $thirtyDaySm    =   round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(30))->avg('sm_number'),2);
                $readings      .=   "\r\n Last 30 Days :"." ".$thirtyDayBg."/".$thirtyDaySm;

                $message        =   str_replace('@average-reading', $readings, $message);

            break;

            case 'bsaverage':
            
                $thirtyDayBg    =   round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(30))->avg('body'),2);
              
                $readings      .=   "\r\n Last 30 Days :"." ".$thirtyDayBg;

                $readingcount   =   $patientService->receiveMessage->count();

                $message        =   str_replace('@average-reading', $readings, $message);

                $message        =   str_replace('@readingcount', $readingcount, $message);

            break;

            case 'appointments':
            
                foreach ($patientService->patient->appointments()->where('status',1)->get() as $receiveM) {

                    $date = \DateTime::createFromFormat('d/m/Y', $receiveM->appt_date);

                    $date = $date->format('d/m');     

                    $receiveMDate     =   $date;

                    $receiveMTime     =   $receiveM->timeData->title;

                    $receiveMWith     =   $receiveM->with;

                    $readings       .=  "\r\n".$receiveMDate.' '.$receiveMTime.' '.$receiveMWith;
              
                }
              
                $message = str_replace('@scheduled-appointments', $readings, $message);


            break;

          
            default:
                # code...
            break;
        }

        if($patientService->service_id==2):
            $bsmin          =   $patientService->target-(($patientService->bs_low_alert*$patientService->target)/100);
            $bsmax          =   $patientService->target+(($patientService->bs_high_alert*$patientService->target)/100);

            $message        =   str_replace('@BSMIN', $bsmin, $message);
            $message        =   str_replace('@BSMAX', $bsmax, $message);   
        endif;  


        if(!empty($receiveMessage)):

            $countryCode    =   $patientService->patient->doctor->getCountry->iso_3166_2;
            $timezone       =   \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
            $timezone       =   $timezone[0];

            $message        =   str_replace('@XXX/YY', str_replace(' ', '/', $receiveMessage->body), $message);
            $message        =   str_replace('@DATE', $receiveMessage->created_at->timezone($timezone)->format('d-m-Y'), $message);
            $message        =   str_replace('@TIME', $receiveMessage->created_at->timezone($timezone)->format('H:i'), $message);
            $message        =   str_replace('@BSREADING',  $receiveMessage->body, $message);

      
        endif;

        $message = str_replace('@X', $patientService->perweek, $message);

        return $message;

    }
    public static function customArrayMap($keyvalue,$array){

        foreach ($keyvalue as $key => $value) {

            $array  =   array_column($array,$value);

        }

        return $array    =   implode(',', $array);
 
  }

    public static function  sendSmsMessage($patientService,$action,$day_id='',$time_id=''){
        /**
         * check patient service send has sms types or not
         */
        if($patientService->serviceData->smsTypes()->exists()):

          /**
           *  call try function for send sms api function
           */
            try {

                /***
                * Prepare ClickSend client.
                */
                $client = new \ClickSendLib\ClickSendClient(env('CLICK_SEND_USER'),env('CLICK_SEND_KEY'));

                // Get SMS instance.
                $sms = $client->getSMS();

                /**
                * find patient selected language
                *
                * @var        <type>
                */
                $language_id          =   $patientService->patient->language_id;

                /**
                * Check sms message is exist in selected language or not
                *
                * @var        <type>
                */
                $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();

                /**
                * if sms message is not exists in 
                * patient preffered language
                * then find english language message
                * for send sms
                */
                if(empty($smsTypesMessage)){
                  /**
                   * Initialize ennglish language id for 
                   * language_id variable
                   *
                   * @var        integer
                   */
                  $language_id  =1;
                  /**
                   * get english langeuage sms type object for database
                   *
                   * @var        <type>
                   */
                  $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();

                }
                /**
                * get message object of preferred language
                *
                * @var        <type>
                */
               
                $smsMessage  = $smsTypesMessage->languageMessage()->where('language_id',$language_id)->first();

                /**
                * Chack reminder type of service sms type
                * if reminder type 2 then pass 
                * language message, patientService,receive sms and action
                * in change message variable function
                * day_id = recieve_sms object
                */
                if($smsTypesMessage->is_reminder==2):

                    /**
                     * call change message variables function
                     * to change dyanamic values of messages
                     * @var        <type>
                     */
                    $textMessage = self::change_message_variables($smsMessage->message,$patientService,$day_id,$action);
                /**
                * if message reminder type of servics sms type 
                * is not equal to 2  then pass
                * language message, patient service and action
                * in change msssage variable function
                * 
                */
                else:

                     /**
                     * call change message variables function
                     * to change dyanamic values of messages
                     * @var        <type>
                     */
                    $textMessage = self::change_message_variables($smsMessage->message,$patientService,'',$action);

                endif;

                /**
                 * initialize empty sender id
                 *
                 * @var        string
                 */
                $senderId='';
                /**
                * check  if reminder for appointment 
                * then find docton apppointment sender id
                */
                if($day_id=='appointment'):
                    /**
                     * find appointment sender id of doctor
                     *
                     * @var        <type>
                     */

                    $senderId    = $patientService->patient->doctor->appt_sender_id;

                else:
                    /**
                    * find  sender id of doctor
                    *
                    * @var        <type>
                    */

                    $senderId    = $patientService->patient->doctor->sender_id;

                endif;
           
                /**
                * if sender id is empty then
                * assign default sender id
                * to sender id varible
                */
                if (empty($senderId)) {
                    /**
                    * assign defualt id
                    *
                    * @var        string
                    */
                    $senderId   =   '+447520619101';

                } 

                /**
                * set message variable
                * to send sms to patient
                * mobile number
                *
                * @var        array
                */
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
                  
                /**
                * Call Api function to send
                * sms and get sms response
                * and store in response variable
                *
                * @var        <type>
                */
                $response   =   $sms->sendSms(['messages' => $messages]);

                /**
                * Get Send message data from api response
                *
                * @var        <type>
                */
                $message    =   $response->data->messages[0];

                /**
                * Initialize send reminder object
                *
                * @var        ReminderSms
                */
                $reminderSms                         =       new ReminderSms;

                /**
                * assign sms date for ReminderSms sms_time
                */
                $reminderSms->sms_time               =       $message->date;

                /**
                * assign sms to for ReminderSms to
                */
                $reminderSms->to                     =       $message->to;

                /**
                * assign sms from for ReminderSms from
                */
                $reminderSms->from                   =       $message->from;

                /**
                * assign sms body for ReminderSms body
                */ 
                $reminderSms->body                   =       $message->body;

                /**
                * assign sms message_id for ReminderSms message_id
                */
                $reminderSms->message_id             =       $message->message_id;

                /**
                * assign sms type id for ReminderSms sms_type_id
                */
                $reminderSms->sms_type_id            =       $smsTypesMessage->id;

                /**
                * check is reminder type 1
                * then save day and time id 
                * in reminder sms table
                */
                if($smsTypesMessage->is_reminder==1):
                /**
                 * assign day_id for ReminderSms day_id
                 */
                $reminderSms->day_id               =       $day_id;

                /**
                 * assign time_id for ReminderSms time_id
                 */
                $reminderSms->time_id              =       $time_id;

                endif;

                /**
                * assign custom_string for ReminderSms custom_string
                */
                $reminderSms->custom_string          =       $message->custom_string;

                /**
                * Check if action equals to test
                * then save is live equals to 
                * zero in database
                */
                if($action=='test')
                /**
                 * assign zero for ReminderSms islive
                 */
                $reminderSms->islive                 =       0;

                /**
                * assign user_id for ReminderSms user_id
                */
                $reminderSms->user_id                =       $message->user_id;

                /**
                * check day id equals to appointment
                * then save patientService id in
                * patient_appt_id 
                */
                if($day_id=='appointment')

                 /**
                 * assign patientService id for ReminderSms patient_appt_id
                 */
                $reminderSms->patient_appt_id      =       $patientService->id;
                /**
                * other wise
                * save patientService id in
                * patient_service_id 
                */
                else
                $reminderSms->patient_service_id   =       $patientService->id;

                /**
                * Save reminder sms object
                */
                $reminderSms->save();
                  
            } catch(\ClickSendLib\APIException $e) {
                /**
                * print exception if any issue 
                * in sending sms
                */
                print_r($e->getResponseBody());

            }
        endif;
    }

    /**
     * 
     * Gets the original message.
     *
     * @param      <type>  $message_id  The message identifier
     *
     * @return     <type>  The original message.
     */
    public static function getOriginalMessage($message_id){
      /**
       * find reminder sms based on message_id
       * and return reminder sms object
       */
      return ReminderSms::where('message_id',$message_id)->first();
    }
    
    /**
     * Gets the practice time zone.
     * take patient object and return 
     * time zone of country selected by doctor
     */
    public static function getPracticeTimeZone($patient){
        /**
        * find doctors country code
        *
        * @var        <type>
        */
        $countryCode    =   $patient->doctor->getCountry->iso_3166_2;

        /**
        * find time zone based on country code
        *
        * @var        <type>
        */
        $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);

        /**
        * take first index of return array as time zone
        *
        * @var        <type>
        */
        $timezone   = $timezone[0];

        /**
        * returns time zone
        */
        return $timezone;

    }

    /**
     * 
     * Pass receive message as argument for this function
     * then check it match with reply of which service format
     */

    public static function checkReceiveMessageFormat($message){

        /**
        * check message match with 
        * blood pressure reading format
        * or not
        */
        if(preg_match('/^\d{1,3}\/\d{1,2}$/', $message)==1 || preg_match('/^\d{1,3}\ \d{1,2}$/', $message)==1){

        /**
         * if receive message format match with 
         * blood pressure reading message format
         * then return one
         */
        return 1;


        }
        /**
        * check message match with blood sugar 
        * reading format or not
        */
        elseif(preg_match('/^[+-]?([0-9]*[.])?[0-9]+$/', $message)==1 ){
        /**
         * if receive message format match
         * with blood sugar reading message 
         * format then return two
         */
        return 2;
        }

        /**
        * return zero if receive message doesn't
        * match with any service reading format
        */
        return 0;

    }
    /**
     * Gets the service history.
     *
     * @param      <type>  $patientService  The patient service
     *
     * @return     <type>  The service history.
     */
    public static function getServiceHistory($patientService){
        /**
         * get patient recieve messages 
         * for remider services
         *
         * @var        <type>
         */
        $receiveMessage =   $patientService->receiveMessage()->where('included',1)->orderBy('created_at','DESC')->get();

        /**
         * Define emptry averages object type array
         * 
         * @var        <type>
         */
        $averages                     =     (object) array();

        if($patientService->service_id==1):
          
            /**
            * Get all time averages of bp readings
            */
            $averages->allTimeAverage     =     round($receiveMessage->avg('bg_number')).'/'.round($receiveMessage->avg('sm_number'));

            /**
            * Inialiatize offset value for get averages of 
            * last 5 days and last 5 records of bp readings
            *
            * @var        integer
            */
            $offset                       =     5;

            /**
            * Get average of last 5 records of 
            * received bp readings
            * 
            */
            $averages->lastFiveReading    =     round($receiveMessage->take($offset)->avg('bg_number')).'/'.round($receiveMessage->take($offset)->avg('sm_number'));

            /**
            * Get 5 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get avarage of last 5 days rececived readings
            */
            $averages->lastFiveDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('bg_number')).'/'.round($receiveMessage->where('created_at','>=',$getdays)->avg('sm_number'));

            /**
            * Inialiatize offset value for get averages of 
            * last 10 days and last 10 records of bp readings
            *
            * @var        integer
            */
            $offset                       =     10;

            /**
            * Get average of last 10 records  
            * received bp readings
            * 
            */
            $averages->lastTenReading     =     round($receiveMessage->take($offset)->avg('bg_number')).'/'.round($receiveMessage->take($offset)->avg('sm_number'));

            /**
            * Get 10 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get avarage of last 10 days rececived readings
            */
            $averages->lastTenDays        =     round($receiveMessage->where('created_at','>=',$getdays)->avg('bg_number')).'/'.round($receiveMessage->where('created_at','>=',$getdays)->avg('sm_number'));

            /**
            * Initialize offset for get avarages of 
            * last 20 records and last 20 days records
            *
            * @var        integer
            */
            $offset                       =     20;

            /**
            * Get averages of last 20 days bp readings
            */
            $averages->lastTwenReading    =     round($receiveMessage->take($offset)->avg('bg_number')).'/'.round($receiveMessage->take($offset)->avg('sm_number'));

            /**
            * get   20 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get averages of last 20 days bp readings
            */
            $averages->lastTwenDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('bg_number')).'/'.round($receiveMessage->where('created_at','>=',$getdays)->avg('sm_number'));

            /**
            * Initialize for get averages of
            * last 30 and last 30 days bp readings
            *
            * @var        integer
            */
            $offset                       =     30;

            /**
            * Get averages of last 30  bp readings
            */
            $averages->lastThirReading    =     round($receiveMessage->take($offset)->avg('bg_number')).'/'.round($receiveMessage->take($offset)->avg('sm_number'));

            /**
            * get 30 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get average of last 30 days average reading
            */
            $averages->lastThirDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('bg_number')).'/'.round($receiveMessage->where('created_at','>=',$getdays)->avg('sm_number'));

            /**
            * { var_description }
            *
            * @var        <type>
            */
            $latestReading                =     $receiveMessage->first();
            $averages->latestReading      =     $latestReading->bg_number.'/'.$latestReading->sm_number;
        else:
            /**
            * Get all time averages of bs readings
            */
            $averages->allTimeAverage     =     round($receiveMessage->avg('body'),2);

            /**
            * Inialiatize offset value for get averages of 
            * last 5 days and last 5 records of bs readings
            *
            * @var        integer
            */
            $offset                       =     5;

            /**
            * Get average of last 5 records of 
            * received bs readings
            * 
            */
            $averages->lastFiveReading    =     round($receiveMessage->take($offset)->avg('body'),2);

            /**
            * Get 5 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get avarage of last 5 days rececived readings
            */
            $averages->lastFiveDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('body'),2);

            /**
            * Inialiatize offset value for get averages of 
            * last 10 days and last 10 records of bs readings
            *
            * @var        integer
            */
            $offset                       =     10;

            /**
            * Get average of last 10 records  
            * received bs readings
            * 
            */
            $averages->lastTenReading     =     round($receiveMessage->take($offset)->avg('body'),2);

            /**
            * Get 10 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get avarage of last 10 days rececived readings
            */
            $averages->lastTenDays        =     round($receiveMessage->where('created_at','>=',$getdays)->avg('body'),2);

            /**
            * Initialize offset for get avarages of 
            * last 20 records and last 20 days records
            *
            * @var        integer
            */
            $offset                       =     20;

            /**
            * Get averages of last 20 days bs readings
            */
            $averages->lastTwenReading    =     round($receiveMessage->take($offset)->avg('body'),2);

            /**
            * get   20 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get averages of last 20 days bs readings
            */
            $averages->lastTwenDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('body'),2);

            /**
            * Initialize for get averages of
            * last 30 and last 30 days bs readings
            *
            * @var        integer
            */
            $offset                       =     30;

            /**
            * Get averages of last 30  bs readings
            */
            $averages->lastThirReading    =     round($receiveMessage->take($offset)->avg('body'),2);

            /**
            * get 30 days before date
            *
            * @var        <type>
            */
            $getdays                      =     Carbon::now()->subDay($offset);

            /**
            * get average of last 30 days average reading
            */
            $averages->lastThirDays       =     round($receiveMessage->where('created_at','>=',$getdays)->avg('body'),2);

            /**
            * { var_description }
            *
            * @var        <type>
            */
            $latestReading                =     $receiveMessage->first();
            $averages->latestReading      =     $latestReading->body;
        endif;

       /**
        * Pass receive messages and all averages 
        * of bp service to view and return view 
        * data for ajax response
        */

        return view('partials.ajax.serviceHistory',compact('patientService','averages','latestReading'));
    }
    /**
     * Sends appointment reminders.
     *
     * @param      <type>  $user      The user
     * @param      <type>  $dayvalue  The dayvalue
     */
    public static function sendAppointmentReminders($user,$dayvalue,$time,$timezone){

        /**
        * Get the date based on dayvalue from now
        *
        * @var        <type>
        */
        $reminderDate = \Carbon\Carbon::now()->addDay($dayvalue)->timezone($timezone)->format('d/m/Y');
        $currentTime=\Carbon\Carbon::now()->timezone($timezone)->format('G');

        if($dayvalue==0){
            if($currentTime<10)
                $time  = \Carbon\Carbon::parse($time)->addHours(1)->timezone($timezone)->format('H:i');
            else
                $time  = \Carbon\Carbon::parse($time)->addHours(2)->timezone($timezone)->format('H:i');
        }

        /**
        * Get all patient appointment those are
        * in reminder date
        *
        * @var        <type>
        */
        $patients  = $user->patients()
                  ->whereHas('appointments',
                    function($q) use($reminderDate,$dayvalue,$time){ 
                        $q->where('appt_date',$reminderDate);
                        $q->where('status',1);
                        $q->whereHas('apptReminders',function($q3) use($dayvalue){
                          $q3->where('status',1);
                          $q3->whereHas('smsTypeData',function($q4) use($dayvalue){
                            $smsTypesName ='reminder'.$dayvalue;
                            $q4->where('name',$smsTypesName);
                          });
                        });
                        // $q->whereHas('timeData',function($q3) use($time){
                        //   $q3->where('abbr',$time);
                        // });
                        $q->where('appt_time',$time);
                      }
                    )
                  ->with(['appointments'=>function($q2) use($reminderDate,$dayvalue,$time){
                        $q2->where('appt_date',$reminderDate);
                        $q2->where('status',1);
                        $q2->whereHas('apptReminders',function($q3) use($dayvalue){
                          $q3->where('status',1);
                          $q3->whereHas('smsTypeData',function($q4) use($dayvalue){
                            $smsTypesName ='reminder'.$dayvalue;
                            $q4->where('name',$smsTypesName);
                          });
                        });
                        $q2->whereHas('timeData',function($q3) use($time){
                          $q3->where('abbr',$time);
                        });
                  },'appointments.apptReminders'=>function($q3) use($dayvalue){
                          $q3->where('status',1);
                          $q3->whereHas('smsTypeData',function($q4) use($dayvalue){
                            $smsTypesName ='reminder'.$dayvalue;
                            $q4->where('name',$smsTypesName);
                          });
                        }])
                  ->get()
                  ;
                 
        /**
         * use for each loop to send to appointment reminder
         * messaage
         */
        foreach ($patients as $patient) {
            
            /**
             * Get patient appointment
             *
             * @var        <type>
             */
            $patientAppointment     = $patient->appointments->first();
            
            /**
             * get patient appointment reminder
             *
             * @var        <type>
             */
            $patientReminder        = $patientAppointment->apptReminders->first();

            /**
             * Assign reminder name which is need to be sent 
             * to action varible
             *
             * @var        <type>
             */
            $action                 = $patientReminder->smsTypeData->name;
            
            /**
             * call helper fuction to send reminder message
             */
            self::sendSmsMessage($patientAppointment,$action,'appointment');

            /**
             * Set patient appointement reminder status as sent
             */
            $patientReminder->status     =   3;

            /**
             * save patient appointment reminder status
             */
            $patientReminder->save();
        }
    }
    public static function getSmsActuallMessage($patientService,$type,$action,$language_id){

        /**
        * Check sms message is exist in selected language or not
        *
        * @var        <type>
        */
        $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();

        /**
        * if sms message is not exists in 
        * patient preffered language
        * then find english language message
        * for send sms
        */
        if(empty($smsTypesMessage)){
            /**
            * Initialize ennglish language id for 
            * language_id variable
            *
            * @var        integer
            */
            $language_id  =1;
            /**
            * get english langeuage sms type object for database
            *
            * @var        <type>
            */
            $smsTypesMessage    =   $patientService->serviceData->smsTypes()->where('name',$action)->whereHas('languageMessage',function($q) use($language_id){ $q->where('language_id',$language_id);})->first();

        }
        /**
        * get message object of preferred language
        *
        * @var        <type>
        */
       
        $smsMessage  = $smsTypesMessage->languageMessage()->where('language_id',$language_id)->first();

        /**
        * Chack reminder type of service sms type
        * if reminder type 2 then pass 
        * language message, patientService,receive sms and action
        * in change message variable function
        * day_id = recieve_sms object
        */
        if($smsTypesMessage->is_reminder==2):

        /**
         * call change message variables function
         * to change dyanamic values of messages
         * @var        <type>
         */
        $textMessage = self::change_message_variables($smsMessage->message,$patientService,$type,$action);
        /**
        * if message reminder type of servics sms type 
        * is not equal to 2  then pass
        * language message, patient service and action
        * in change msssage variable function
        * 
        */
        else:

         /**
         * call change message variables function
         * to change dyanamic values of messages
         * @var        <type>
         */
        $textMessage = self::change_message_variables($smsMessage->message,$patientService,'',$action);

        endif;

        return $textMessage;
    }
    /**
     * function get user object and return last message send
     *
     * @param      <type>  $user   The user
     *
     * @return     <type>  return last message
     */
    public static function lastMessageSend($user){
        $lastMessageSend    =   ReminderSms::whereHas('parentService',
                                                    function($q) use($user){
                                                        $q->whereHas('patient',
                                                            function($q2) use($user){
                                                                if($user instanceof User):
                                                                    $q2->where('user_id',$user->id);
                                                                else:
                                                                    $q2->where('id',$user->id);
                                                                endif;
                                                            });
                                                    })
                                        ->orWhereHas('parentAppt',
                                                    function($q) use($user){
                                                        $q->whereHas('patient',
                                                            function($q2) use($user){
                                                                if($user instanceof User):
                                                                    $q2->where('user_id',$user->id);
                                                                else:
                                                                    $q2->where('id',$user->id);
                                                                endif;
                                                            });
                                                    })->latest()->first();
        return $lastMessageSend;
    }

    /**
     * function get user object and return total message send
     *
     * @param      <type>  $user   The user
     *
     * @return     <type>  return total message sent
     */
    public static function totalMessageSent($user)
    {
         
         $totalreminderSms     =   ReminderSms::whereHas('parentService',
                                                            function($q) use($user){
                                                                $q->whereHas('patient',
                                                                    function($q2) use($user){
                                                                        if($user instanceof User):
                                                                            $q2->where('user_id',$user->id);
                                                                        else:
                                                                            $q2->where('id',$user->id);
                                                                        endif;
                                                                    });
                                                            })
                                                ->orWhereHas('parentAppt',
                                                            function($q) use($user){
                                                                $q->whereHas('patient',
                                                                    function($q2) use($user){
                                                                        if($user instanceof User):
                                                                            $q2->where('user_id',$user->id);
                                                                        else:
                                                                            $q2->where('id',$user->id);
                                                                        endif;
                                                                    });
                                                            })->count();
         
        return $totalreminderSms;
        
    }
    /**
     * Gets all message logs.
     *
     * @param      string  $id     The identifier
     *
     * @return     <type>  All message logs.
     */
    public static function getAllMessageLogs($query=''){

        /**
         * Get all receive messages
         * and add temporary column type
         * for find it's type
         *
         * @var        <type>
         */
       if(request()->query('received')!=null && request()->query('sent')!=null || request()->query('received')==null && request()->query('sent')==null):
        $ReceiveSms        =      \App\ReceiveSms::select('created_at','to','from','body','original_message_id as message_id',\DB::raw('"receive" AS type'))
                                         ->where(function($que) use($query){
                                                if(!empty($query)):
                                                    $que->whereHas('remindMessage',function($q) use($query){
                                                    $q->whereHas('parentService',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                    if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);

                                                                    if(!empty($query['practices']) )   
                                                                        $q2->where('user_id',$query['practices']);
                                                                });
                                                        });
                                                    $q->orWhereHas('parentAppt',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                  if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                });
                                                        });
                                                    }
                                                    );
                                                endif;
                                            });

        /**
         * Get all records of send messsage
         * and add temporary column type
         * for find it's type and union
         * with receive messages
         * @var        <type>
         */
        $reminderSms        =       ReminderSms::select('created_at','to','from','body','message_id',\DB::raw('"send" AS type'))
                                         ->where(function($que) use($query){
                                                if(!empty($query)):
                                                    $que->whereHas('parentService',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                    if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))   
                                                                        $q2->where('user_id',$query['practices']);
                                                                });

                                                        }
                                                    )
                                                    ->orWhereHas('parentAppt',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                    if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                });

                                                        }
                                                    );
                                                endif;
                                            })
                                        ->union($ReceiveSms)
                                        ->orderBy('created_at', 'DESC')->latest();

        elseif(isset($query['received'])):
            $reminderSms        =      \App\ReceiveSms::select('created_at','to','from','body','original_message_id as message_id',\DB::raw('"receive" AS type'))
                                            ->where(function ($que)use($query){
                                                if(!empty($query)):
                                                    $que->whereHas('remindMessage',function($q) use($query){
                                                        $q->whereHas('parentService',
                                                            function($q1) use($query){
                                                                $q1->whereHas('patient',
                                                                    function($q2) use($query){
                                                                     if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                    });
                                                            });
                                                        $q->orWhereHas('parentAppt',
                                                            function($q1) use($query){
                                                                $q1->whereHas('patient',
                                                                    function($q2) use($query){
                                                                         if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                    });
                                                            });
                                                        }
                                                    );
                                                endif;
                                            })
                                            ->orderBy('created_at', 'DESC')->latest();
        elseif(isset($query['sent'])):
            $reminderSms        =      \App\ReminderSms::select('created_at','to','from','body','message_id',\DB::raw('"send" AS type'))
                                             ->where(function($que) use($query){
                                                if(!empty($query)):
                                                        $que->whereHas('parentService',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                     if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                });

                                                        }
                                                    )
                                                    ->orWhereHas('parentAppt',
                                                        function($q1) use($query){
                                                            $q1->whereHas('patient',
                                                                function($q2) use($query){
                                                                    if(!empty($query['languages']))
                                                                        $q2->where('language_id',$query['languages']);
                                                                        
                                                                    if(!empty($query['practices']))    
                                                                        $q2->where('user_id',$query['practices']);
                                                                });

                                                        }
                                                    );
                                                endif;
                                            })

                                            ->orderBy('created_at', 'DESC')->latest();
        endif;

        /**
         * return all send and receive messages
         */
        return  $reminderSms->get();
    }
    /**
     * Gets the active reminders.
     *
     * @param      <type>   $user   The user
     *
     * @return     integer  The active reminders.
     */
    public static function getActiveReminders($user){

        /**
         * get service reminder count
         *
         * @var        <type>
         */
        $serviceReminderCount        =          PatientService::where('status',1)
                                                    ->whereHas('patient',
                                                        function($q) use($user){ 
                                                            if($user instanceof User):
                                                                $q->where('user_id',$user->id);
                                                            else:
                                                                $q->where('id',$user->id);
                                                            endif;

                                                        })
                                                    ->count();
       /**
        * get appoinmeent reminder count
        *
        * @var        <type>
        */
        $appointmentReminderCount    =          PatientAppointment::where('status',1)
                                                    ->whereHas('patient',
                                                        function($q) use($user){ 
                                                            if($user instanceof User):
                                                                $q->where('user_id',$user->id);
                                                            else:
                                                                $q->where('id',$user->id);
                                                            endif;

                                                        })
                                                    ->count();

      

        $getActiveReminders             =       $serviceReminderCount+$appointmentReminderCount;

        return $getActiveReminders;

    }
    /**
     * Gets the patient scheduled messages.
     *
     * @param      <type>  $patient  The patient
     */
    public static function getPatientScheduledMessages($patient,$serviceId){
        $messages   =   array();
        $i=0;

        

        if(empty($serviceId)):
            $messages[$i]  = array();
            echo $response = json_encode($messages);
        
        else:
            $patientServices    =   $patient->reminderService()->where('status',1)->whereIn('service_id',$serviceId)->get();
            $appointments    =   $patient->appointments()->where('status',1)->whereIn('service_id',$serviceId)->get();
        foreach ($patientServices as $service) {
            # code...
            $day    =  $service->reminderDays()->pluck('day_id')->toArray();

            $ranges     =   array();

            $startDate      =   Carbon::parse($service->start_date)->format('Y-m-d');

            if($service->ongoing==0):

                

                $period         =   $service->period;

                if($service->duration==1)
                
                    $endDate   =   Carbon::parse($startDate)->addDay($period)->format('Y-m-d');

                elseif($service->duration==2)

                    $endDate   =   Carbon::parse($startDate)->addWeek($period)->format('Y-m-d');
                
                else

                    $endDate   =   Carbon::parse($startDate)->addMonth($period)->format('Y-m-d');

                $ranges[0] =   array(
                                    'start' =>  $startDate,
                                    'end'   =>  $endDate,
                            );
            else:
                $endDate    =   '2039-01-01';
                $ranges[0] =   array(
                                    'start' =>  $startDate,
                                    'end'   => $endDate
                            );

            endif;

            $exception      =   array(
                                        'weeks' =>  2
                                );
            foreach ($service->reminderTime as $time) {
                # code...
                $messages[$i]   =    array(
                                            'title' => $service->serviceData->name,
                                            'id'    =>$service->id,
                                            'start'=>$time->timeData->abbr,
                                            'startDate'=>$startDate,
                                            'end'=> Carbon::parse($time->timeData->abbr)->addHour(1)->format('H:i'),
                                            'dow'=>$day,
                                            'ranges'=>$ranges,
                                            'repeats' => 1,
                                            'className' => 'scheduler_basic_event',
                                            'repeat_freq' => $service->perweek,
                                            'duration' => $exception
                                            );
                 $i++;
            }
            
           
        }
        foreach ($appointments as $appointment) {
            # code...
            $reminders    =  $appointment->apptReminders;

            foreach($reminders as $reminder):

                /***
                * numeric digit from reminder name
                */
                $day  =     (int) preg_replace('/\D/', '',$reminder->smsTypeData->name);

                /***
                * change appointment date format
                */
                $date = \DateTime::createFromFormat('d/m/Y', $appointment->appt_date);

                $date = $date->format('Y-m-d');

                /***
                * substract reminder name numeric digit
                * day from appointment date and find 
                * remider sent date
                */
                $reminderDate = \Carbon\Carbon::parse($date)->subDay($day)->format('Y-m-d');

                /***
                * check reminder status 
                * if status is 3 then find
                * find reminder send date form
                * reminder sent log
                */
                if($reminder->status==3){

                    /***
                    * find latest message of send reminder
                    * in send reminder log
                    */
                    $reminderMessage = $appointment->reminderMessage()->where('sms_type_id',$reminder->reminder_id)->latest()->first();
                
                    /***
                    * if reminder sms log is not emty
                    * then set reminder sms log created date
                    * reminder date
                    */
                    if(!empty($reminderMessage))
                        $reminderDate = $reminderMessage->created_at->format('Y-m-d');
                }
                /***
                * else check if reminder id equals to 34 and
                * status is equal to not active then set reminder
                * create date as reminder sent date
                */
                elseif($reminder->status==2 && $reminder->reminder_id==34)
                    $reminderDate = $reminder->created_at->format('Y-m-d');

                $startDate      =    $reminderDate.'T'.Carbon::parse($appointment->timeData->abbr)->format('H:i:s');
                $endDate        =    $reminderDate.'T'.Carbon::parse($appointment->timeData->abbr)->addHour(1)->format('H:i');
                $messages[$i]   =    array(
                                            'title' => $reminder->smsTypeData->parentService->name,
                                            'id'    => $reminder->id,
                                            'start' => $startDate,
                                            'startDate'=>$startDate,
                                            'end'=>  $endDate  ,
                                            'repeats' => 0,
                                            );
                 $i++;
            
            endforeach;

         
            
            
           
        }

        
        echo $response = json_encode($messages);endif;
    }
    function recurringEvents($type, $interval, $date) {

     $startdate = date('Y-m-d', strtotime($date));
     $day = explode('-', $startdate);
     $datetotime = mktime(0,0,0,$day[1], $day[2], $day[0]);

     $dates = array();
     
     //If interval type is daily
     if($type == 'D') {
          for($i=1;$i<$interval-1;$i++) {
               $newdate = '+ '. $i .' day';
               $dates[] = date('Y-m-d', strtotime($newdate, $datetotime));
          }
     }
     
     //If interval type is weekly
     if($type == 'W') {
          for($i=1;$i<$interval;$i++) {
               $newdate = '+ '. $i .' week';               
               $dates[] = date('Y-m-d', strtotime($newdate, $datetotime));
          }          
     }
     
     //If interval type is monthly
     if($type == 'M') {
          for($i=1;$i<$interval;$i++) {
               $newdate = '+ '. $i .' month';               
               $dates[] = date('Y-m-d', strtotime($newdate, $datetotime));
          }
     }
     
     //If interval type is yearly
     if($type == 'Y') {
          for($i=1;$i<$interval;$i++) {
               $newdate = '+ '. $i .' year';               
               $dates[] = date('Y-m-d', strtotime($newdate, $datetotime));
          }          
     }
     return $dates;     
}
}
