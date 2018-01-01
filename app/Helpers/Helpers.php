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
    
    $bphistoryurl   =   url($patientService->token);
    
    $getDays   =    $patientService->reminderDays()->with('dayData')->orderBy('day_id','asc')->get()->toArray();
    $getDays   =    self::customArrayMap(array('day_data','abbr'),$getDays);
      
    $getTime   =   $patientService->reminderTime()->with('timeData')->orderBy('time_id','asc')->get()->toArray();
    $getTime   =    self::customArrayMap(array('time_data','title'),$getTime);
   
    $message = str_replace('@NAME', $patientService->patient->name, $message);
    $message = str_replace('@DOCTORNAME', $patientService->patient->doctor->name, $message);
    
    $message = str_replace('@DOCNUMBER', $patientService->patient->doctor->contact, $message);
    $message = str_replace('@PRACTICENAME', $patientService->patient->doctor->name, $message);
    $message = str_replace('@GP', $patientService->patient->doctor->name, $message);
    $message = str_replace('@PRACTICENUMBER', $patientService->patient->doctor->contact, $message);
    $message = str_replace('@PATIENTBPHISTORYLINK', $bphistoryurl, $message);


    if($patientService->service_id==1 && $action=='bphistory'):
      $readings = '';
      $countryCode    =   $patientService->patient->doctor->getCountry->iso_3166_2;
      $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
      $timezone   = $timezone[0];

      foreach ($patientService->receiveMessage as $receiveM) {
        # code...
        $receiveMDate     =   $receiveM->created_at->timezone($timezone)->format('d-m-Y');
        $receiveMTime     =   $receiveM->created_at->timezone($timezone)->format('H:i');
        $receiveMReading  =   $receiveM->bg_number.'/'.$receiveM->sm_number;

        $readings  .= "\r\n".$receiveMDate.' '.$receiveMTime.' '.$receiveMReading;
      }
      $message = str_replace('@last-ten-reading', $readings, $message);

    endif;
    
    if($patientService->service_id==1 && $action=='bpaverage'):

      $readings = '';

      $countryCode    =   $patientService->patient->doctor->getCountry->iso_3166_2;
      $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
      $timezone   = $timezone[0];
      // echo Carbon::now()->subDay(30);
      // die;
      $tenDayBg   = round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(10))->avg('bg_number'),2);
      $tenDaySm   = round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(10))->avg('sm_number'),2);
      $readings  .= "\r\n Last 10 Days :"." ".$tenDayBg."/".$tenDaySm;

      $thirtyDayBg   =  round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(30))->avg('bg_number'),2);
      $thirtyDaySm   =  round($patientService->receiveMessage()->where('created_at', '>=', Carbon::now()->subDay(30))->avg('sm_number'),2);
      $readings     .= "\r\n Last 30 Days :"." ".$thirtyDayBg."/".$thirtyDaySm;

      $message      =   str_replace('@average-reading', $readings, $message);

    endif;


    $message = str_replace('@DAYS', $getDays, $message);
    $message = str_replace('@TIMES', $getTime, $message);

    if(!empty($receiveMessage)):

      $countryCode    =   $patientService->patient->doctor->getCountry->iso_3166_2;
      $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
      $timezone   = $timezone[0];

      $message = str_replace('@XXX/YY', str_replace(' ', '/', $receiveMessage->body), $message);
      $message = str_replace('@DATE', str_replace(' ', '/', $receiveMessage->created_at->timezone($timezone)->format('d-m-Y')), $message);
      $message = str_replace('@TIME', str_replace(' ', '/', $receiveMessage->created_at->timezone($timezone)->format('H:i')), $message);
      
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
            
            $smsMessage  = $smsTypesMessage->languageMessage()->where('language_id',$language_id)->first();
            if($smsTypesMessage->is_reminder==2):
              $textMessage = self::change_message_variables($smsMessage->message,$patientService,$day_id,$action);
            else:
              $textMessage = self::change_message_variables($smsMessage->message,$patientService,'',$action);
            endif;

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
            $reminderSms->sms_type_id            =       $smsTypesMessage->id;

            if($smsTypesMessage->is_reminder==1):
              $reminderSms->day_id               =       $day_id;
              $reminderSms->time_id              =       $time_id;
            endif;

            $reminderSms->custom_string          =       $message->custom_string;
            if($action=='test')
            $reminderSms->islive                 =       0;
            $reminderSms->user_id                =       $message->user_id;
            $reminderSms->patient_service_id     =       $patientService->id;

            $reminderSms->save();
            
        } catch(\ClickSendLib\APIException $e) {

            print_r($e->getResponseBody());

        }
        endif;
    }
    public static function getOriginalMessage($message_id){
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
       /**
        * Pass receive messages and all averages 
        * of bp service to view and return view 
        * data for ajax response
        */

        return view('partials.ajax.serviceHistory',compact('patientService','averages','latestReading'));
    }

}