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

class Helpers
{
  public static function PracticeTypes(){
    return PracticeType::all();
  }
  public static function Status(){
    return StaffStatus::all();
  }
  public static function Permission(){
    return Permission::where('is_parent',0)->get();
  }
  public static function Service(){
    return Service::all();
  }
  public static function serviceBasedOnPracticeType(){
    
    $services = Service::whereIn('practice_id',explode(',',Auth::user()->practice_id))->get();
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
  public static function change_message_variables($message,$patientService,$receiveMessage='',$action=''){
    // echo $action;
    // die('checkhisory');
    
    
    $bphistoryurl   =     url('/'.$patientService->token);
    
    $site_url       =     url('/');
    
    $timezone       =     Self::getPracticeTimeZone($patientService->patient);

    if($patientService->reminderDays):

      $getDays        =     $patientService->reminderDays()->with('dayData')->orderBy('day_id','asc')->get()->toArray();
    
      $getDays        =     self::customArrayMap(array('day_data','abbr'),$getDays);
    
      $message        =     str_replace('@DAYS', $getDays, $message);

    endif;

    if($patientService->timeData):

        $apptlink = url('/appt/'.$patientService->patient->code);
        
        $message = str_replace('@DATE', $patientService->appt_date, $message);

        $message = str_replace('@TIME', $patientService->timeData->title, $message);

        $message = str_replace('@WITH', $patientService->with, $message);

        $message = str_replace('@apptlink', $apptlink, $message);
    
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
            
            $receiveMDate     =   $receiveM->appt_date;

            $receiveMTime     =   $receiveM->timeData->title;

            $readings       .=  "\r\n".$receiveMDate.' '.$receiveMTime;
          
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
               * find sender id of doctor
               *
               * @var        <type>
               */
              $senderId    = $patientService->patient->doctor->sender_id;
              
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
    public static function sendAppointmentReminders($user,$dayvalue,$time){

      /**
       * Get the date based on dayvalue from now
       *
       * @var        <type>
       */
      $reminderDate = \Carbon\Carbon::now()->addDay($dayvalue)->format('d/m/Y');

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
                        $q->whereHas('timeData',function($q3) use($time){
                          $q3->where('abbr',$time);
                        });
                      }
                    )
                  ->with(['appointments'=>function($q2) use($reminderDate,$dayvalue){
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
}