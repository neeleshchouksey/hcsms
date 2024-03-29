<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\PatientService;
use Helper;
use Carbon\Carbon;
use App\SmsCostCharges;
use App\ClickSendCurrency;

class CronJobController extends Controller
{
    //
    function sendMessage(){
        $users      =   User::all();
        foreach ($users as $user) :
            # code...
            $countryCode    =   $user->getCountry->iso_3166_2;
            $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
            $timezone   = $timezone[0];
            date_default_timezone_set($timezone);
            $day    =   date('D');
            $time   =   date('H:00');
        	$patients   =   $user->patients()->whereHas('reminderService',
                                        function($q) use($day,$time){
                                            $q->where('status',1);
                                            $q->where('start_date','<=',date('Y-m-d H:i:s'));
                                            $q->whereNotNull('start_date');
                                            $q->whereHas('reminderDays',
                                                function($q2) use($day){
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                                });
                                            $q->whereHas('reminderTime',
                                                function($q4) use($time){
                                                    $q4->whereHas('timeData',
                                                        function($q5) use($time){
                                                            $q5->where('abbr',$time);
                                                        });

                                                });


                                        })->with(['reminderService' => function($q) use($day,$time){
                                            $q->where('status',1);
                                            $q->where('start_date','<=',date('Y-m-d H:i:s'));
                                            $q->whereNotNull('start_date');
                                            $q->whereHas('reminderDays',
                                                function($q2) use($day){
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                                });
                                            $q->whereHas('reminderTime',
                                                function($q4) use($time){
                                                    $q4->whereHas('timeData',
                                                        function($q5) use($time){
                                                            $q5->where('abbr',$time);
                                                        });

                                                });
                                            },
                                            'reminderService.reminderDays'=> function($q2) use($day,$time){
                                            
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                               
                                            },
                                            'reminderService.reminderTime'=> function($q2) use($day,$time){
                                            
                                                    $q2->whereHas('timeData',
                                                        function($q3) use ($time){
                                                            $q3->where('abbr',$time);
                                                        });
                                               
                                            }])
                                ->get();
                                
        	foreach ($patients as $patient) {
        		//code...
        		foreach ($patient->reminderService as $service) {
                    $dayData    =   $service->reminderDays->first();
                    $timeData   =   $service->reminderTime->first();
                    # code...
                    $messageCount   =   $service->reminderMessage()->whereHas('parentSmsType',function($q){$q->where('name','first-reminder');})->count();
                    if($service->ongoing==0): 
                        $duration   =   $service->period;
                       
                        $service->duration;
                       

                        if($service->duration==1)
                            $enddate = Carbon::parse($service->start_date)->addDay($duration);
                        elseif($service->duration==2)
                            $enddate = Carbon::parse($service->start_date)->addWeek($duration);
                        else
                            $enddate = Carbon::parse($service->start_date)->addMonth($duration);
                        $enddate;
                        
                        $cdate      =   Carbon::now();
                        $to         =   Carbon::createFromFormat('Y-m-d H:i:s', $cdate);
                        $from       =   Carbon::createFromFormat('Y-m-d H:i:s', $enddate);
                                       
                        //$daydiff = $to->diffInDays($from);
                        $date1      =   date_create($cdate);
                        $date2      =   date_create($enddate);
                        $diff       =   date_diff($date1,$date2);
                        $daydiff    =   $diff->format("%R%a days");
                        
                        if($daydiff<=0){
                            $service->status=0;
                            $service->save();
                            Helper::sendSmsMessage($service,'end');
                            continue;
                        }
                    endif;     
                    /* if($service->reminderMessage):
                    
                        $cdate     =   Carbon::now();
                      
                        $cmessageCount   =   $service->reminderMessage()
                                                                ->whereHas('parentDay',
                                                                    function($q) use($day){
                                                                        $q->where('abbr',$day);
                                                                    })
                                                                ->whereHas('parentTime',
                                                                    function($q) use($time){
                                                                        $q->where('abbr',$time);
                                                                    }
                                                                    )->latest()->first();
                        if(!empty($cmessageCount)):
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cdate);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cmessageCount->created_at);
                            
                            $diff_in_hours = $to->diffInWeeks($from);
                            $diff_in_hours;
                            if($diff_in_hours<$service->perweek)
                                continue;
                        endif;
                    
                    endif;*/

                    $cdate      =   Carbon::now();
                    $to         =   \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cdate);
                    $from       =   \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $service->start_date);
                    
                    $diff_in_hours = $to->diffInWeeks($from);
                    $diff_in_hours;
                    if($diff_in_hours%$service->perweek!=0)
                        continue;

                    if($service->service_id==1 && $messageCount==0)
                   
                    # code...
                        \Helper::sendSmsMessage($service,'first-reminder',$dayData['day_id'],$timeData['time_id']);
                    else
                    \Helper::sendSmsMessage($service,'reminder',$dayData['day_id'],$timeData['time_id']);
                }
        	}
        endforeach;
    }
    function sendMessageTest(){
        $users      =   User::all();
        foreach ($users as $user) :
            # code...
            $countryCode    =   $user->getCountry->iso_3166_2;
            $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
            echo $timezone   = $timezone[0];
            date_default_timezone_set($timezone);
            echo $day    =   date('D');
            //die;
            echo "<br>";
            echo $time   =   date('H:00');
            echo "<br>";
            echo $user->id;
            echo "<br>";
            $patients   =   $user->patients()->whereHas('reminderService',
                                        function($q) use($day,$time){
                                            $q->where('status',1);
                                            $q->where('start_date','<=',date('Y-m-d H:i:s'));
                                            $q->whereNotNull('start_date');
                                            $q->whereHas('reminderDays',
                                                function($q2) use($day){
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                                });
                                            $q->whereHas('reminderTime',
                                                function($q4) use($time){
                                                    $q4->whereHas('timeData',
                                                        function($q5) use($time){
                                                            $q5->where('abbr',$time);
                                                        });

                                                });


                                        })->with(['reminderService' => function($q) use($day,$time){
                                            $q->where('status',1);
                                            $q->where('start_date','<=',date('Y-m-d H:i:s'));
                                            $q->whereNotNull('start_date');
                                            $q->whereHas('reminderDays',
                                                function($q2) use($day){
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                                });
                                            $q->whereHas('reminderTime',
                                                function($q4) use($time){
                                                    $q4->whereHas('timeData',
                                                        function($q5) use($time){
                                                            $q5->where('abbr',$time);
                                                        });

                                                });
                                            },
                                            'reminderService.reminderDays'=> function($q2) use($day,$time){
                                            
                                                    $q2->whereHas('dayData',
                                                        function($q3) use ($day){
                                                            $q3->where('abbr',$day);
                                                        });
                                               
                                            },
                                            'reminderService.reminderTime'=> function($q2) use($day,$time){
                                            
                                                    $q2->whereHas('timeData',
                                                        function($q3) use ($time){
                                                            $q3->where('abbr',$time);
                                                        });
                                               
                                            }])
                                ->get();
            foreach ($patients as $patient) {
                //code...
                foreach ($patient->reminderService as $service) {
                    $dayData    =   $service->reminderDays->first();
                    $timeData   =   $service->reminderTime->first();
                     echo "<pre>";
                    // echo $dayData['day_id'];
                    // echo "<br>";
                    // echo $timeData['time_id'];
                     echo "<br>";
                    echo $service->perweek;
                    echo "<br>";
                    
                    $messageCount   =   $service->reminderMessage()->whereHas('parentSmsType',function($q){$q->where('name','first-reminder');})->count();
                    if($service->reminderMessage):
                        if($service->ongoing==0):  
                            $cdate     =   Carbon::now();
                          
                            echo $cmessageCount   =   $service->reminderMessage()
                                                                    ->whereHas('parentDay',
                                                                        function($q) use($day){
                                                                            $q->where('abbr',$day);
                                                                        })
                                                                    ->whereHas('parentTime',
                                                                        function($q) use($time){
                                                                            $q->where('abbr',$time);
                                                                        }
                                                                        )->first();
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cdate);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cmessageCount->created_at);
                            
                            $diff_in_hours = $to->diffInWeeks($from);
                            $diff_in_hours;
                            if($diff_in_hours<$service->perweek)
                                continue;
                        endif;
                    endif;
                    echo "<br>";
                    print_r($service);
                    if($service->service_id==1 && $messageCount==0)
                        echo "first-reminder";
                    # code...
                       // \Helper::sendSmsMessage($service,'first-reminder',$dayData['day_id'],$timeData['time_id']);
                    else
                        echo "reminder";
                    //\Helper::sendSmsMessage($service,'reminder',$dayData['day_id'],$timeData['time_id']);
                }
            }
            // echo "<pre>";
            // print_r($patients);
        endforeach;
    }
    public function endServiceReminder(){

        $patientServices         =       PatientService::where('ongoing',0)->where('status',1)->get();
        foreach ($patientServices as $patientService) {
            if($patientService->patient):
                $timezone       =   Helper::getPracticeTimeZone($patientService->patient);
                date_default_timezone_set($timezone);
                $time=date('H:i');
                
                if($time=='10:00'):
                
                    $duration   =   $patientService->period;
                     
                    $patientService->duration;
                    

                    if($patientService->duration==1)
                        $enddate = Carbon::parse($patientService->start_date)->addDay($duration);
                    elseif($patientService->duration==2)
                        $enddate = Carbon::parse($patientService->start_date)->addWeek($duration);
                    else
                        $enddate = Carbon::parse($patientService->start_date)->addMonth($duration);
                    $enddate;
                     
                    $cdate      =   Carbon::now();
                    $to         =   Carbon::createFromFormat('Y-m-d H:i:s', $cdate);
                    $from       =   Carbon::createFromFormat('Y-m-d H:i:s', $enddate);
                                 
                   // $daydiff = $to->diffInDays($from);
                    $date1      =   date_create($cdate);
                    $date2      =   date_create($enddate);
                    $diff       =   date_diff($date1,$date2);
                    $daydiff    =   $diff->format("%R%a days");

                    if($daydiff<=0){

                        $patientService->status=0;
                        $patientService->save();
                        Helper::sendSmsMessage($patientService,'end');

                    }
                endif;
            endif;
        }
        

    }
    public function checkUpdateservice(){
        /**
         * Find patient services those are active and changed 
         * and check they services has changed reminder in database or not
         *
         * @var        <type>
         */
        $patientServices    =   PatientService::where('ischanged',1)
                                    ->where('status',1)
                                    ->whereHas('serviceData',
                                            function($q){
                                                $q->where('id',2);
                                                $q->whereHas('smsTypes',
                                                    function($q2){
                                                        $q2->where('label','Changed');
                                                    }
                                                    );
                                                }
                                            )->with(['serviceData.smsTypes'=>function($q3){
                                                $q3->where('label','Changed');
                                            }])->get();
        
        foreach ($patientServices as $service) {
            /**
             * find service sms type action
             *
             * @var        <type>
             */
            $smsTypes   =   $service->serviceData->smsTypes->first();
            
            /**
             * Assign service sms type name to action name
             *
             * @var        <type>
             */
            $action     =   $smsTypes->name;
            
            /**
             * Call helper function to send changed
             * message
             */
            \Helper::sendSmsMessage($service,$action);
            $service->ischanged    =   0   ;   
            $service->save();
        }
    }
    public function sendAppointmentReminders(){
        
        /**
         * Get all user from database
         *
         * @var        <type>
         */
        $users      =   User::all();

        /**
         * Use for each loop to retrive users
         * one by one
         */
        foreach ($users as $user) :

            /**
             * Get users Country code
             *
             * @var        <type>
             */
            $countryCode    =   $user->getCountry->iso_3166_2;
            
            /**
             * { var_description }
             *
             * @var        <type>
             */
            $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
            $timezone   = $timezone[0];
            date_default_timezone_set($timezone);

            /**
             * Intialize day value array for
             * send  appointment reminders
             * @var        array
             */
            $dayvalue   =   array(7,3,1,0);
            
            /**
             * Find current time
             */
            $time   =   date('H:i');

            foreach ($dayvalue as $day) {
                /**
                 * Call helper function for send appointment reminders
                 */
                Helper::sendAppointmentReminders($user,$day,$time,$timezone);
            }
            

        endforeach;
    }
    /**
     * Saves a click send sms price.
     */
    public function saveClickSendSmsPrice(){

        $countries      =   SmsCostCharges::whereDate('updated_at','<',Carbon::today())->get();

         foreach ($countries as $country) {

                $ch2 = curl_init();

                curl_setopt($ch2, CURLOPT_URL, "https://rest.clicksend.com/v3/pricing/".$country->country_code."?currency=".$country->getCurrency->code);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch2, CURLOPT_HEADER, FALSE);

                $response2 = curl_exec($ch2);
                curl_close($ch2);
                $response2 = json_decode($response2);

                if(isset($response2->data) && !empty($response2->data)):

                    $country->cost  =   $response2->data->sms->price_rate_0;

                    $country->save();     

                endif;

               
            }
       
    }
    /**
     * Saves click send countries.
     */
    public function saveClickSendCountries(){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://rest.clicksend.com/v3/countries");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        $response = curl_exec($ch);
        
        curl_close($ch);
      
        $response = json_decode($response);

        $currencies     =   ClickSendCurrency::all();

        foreach ($currencies as $currency) {

        
            foreach ($response->data as $country) {

                $costCharges                =       new SmsCostCharges;

                $costCharges->country       =       $country->value;

                $costCharges->country_code  =       $country->code;

                $costCharges->currency      =       $currency->id;

                $costCharges->save();     


               
            }

        }
    }
    public function updateMessagePrice(){

        $messagesLogs       =   \App\ReminderSms::all();

        foreach ($messagesLogs as $message) {

            if($message->parentAppt){

                $patient    =   $message->parentAppt->patient;

            }

            elseif($message->parentService){

                $patient    = $message->parentService->patient;

            }
            else{

                $patient    =   $message->patient;

            }
            if(!empty($patient)):
            $messageCost              =   \App\SmsCostCharges::where('country_code',$patient->doctor->getCountry->iso_3166_2)->where('currency',2)->first();

            $parts                    =   \Helper::getSmsLength($message->body);
           
            if(!empty($messageCost) && isset($messageCost->cost)):

               $cost                     =   $parts['parts'] * $messageCost->cost;

                $fees                     =   $cost * 2;
                
                $message->message_cost    =   $cost;

                $message->message_fee     =   $fees;

                $message->save();

            endif;
        endif;
        }
    }
}
