<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\PatientService;
use Helper;

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
            die;
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
                    echo $dayData['day_id'];
                    echo "<br>";
                    echo $timeData['time_id'];
                    echo "<br>";
                    echo $messageCount   =   $service->reminderMessage()->whereHas('parentSmsType',function($q){$q->where('name','first-reminder');})->count();
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

        $patientServices         =       PatientService::where(function($q){$q->where('ongoing',0);})->get();
        foreach ($patientServices as $patientService) {
            echo \Carbon\Carbon::parse($patientService->start_date)->addMonth('3')->format('d-m-Y');

        }
        echo "<pre>";
        print_r($patientServices);
        die;

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
}
