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
    return Language::where('status',1)->get();
  }
  public static function change_message_variables($message,$patientService){
    //echo "<pre>";
    $getDays   =    $patientService->reminderDays()->with('dayData')->get()->toArray();
    $getDays   =    self::customArrayMap(array('day_data','abbr'),$getDays);
    // $getDays  =   array_column($getDays->toArray(),'day_data');
    // $getDays  =   array_column($getDays,'abbr');
   
    $getTime   =   $patientService->reminderTime()->with('timeData')->get()->toArray();
    $getTime   =    self::customArrayMap(array('time_data','title'),$getTime);
   
    $message = str_replace('@NAME', $patientService->patient->name, $message);
    $message = str_replace('@DOCTORNAME', $patientService->patient->doctor->name, $message);
    $message = str_replace('@X', $patientService->perweek, $message);
    $message = str_replace('@DOCNUMBER', $patientService->patient->doctor->contact, $message);
    $message = str_replace('@PRACTICENAME', $patientService->patient->doctor->name, $message);
    $message = str_replace('@PRACTICENUMBER', $patientService->patient->doctor->contact, $message);
    $message = str_replace('@DAYS', $getDays, $message);
    $message = str_replace('@TIMES', $getTime, $message);
    return $message;

  }
  public static function customArrayMap($keyvalue,$array){
        foreach ($keyvalue as $key => $value) {
          $array  =   array_column($array,$value);
        }
        return $array    =   implode(',', $array);
        
        

  }
  public static function  sendSmsMessage($patientService,$action){
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

            $textMessage = self::change_message_variables($textMessage->message,$patientService);

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