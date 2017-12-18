<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\User;
class CronJobController extends Controller
{
    //
    function sendMessage(){
        $users      =   User::all();
        foreach ($users as $user) :
            # code...
            $countryCode    =   $user->getCountry->iso_3166_2;
            $timezone   = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $countryCode);
            echo $timezone   = $timezone[0];
            date_default_timezone_set($timezone);
            echo $day    =   strtolower(date('D'));
            echo $time   =   date('H:00');
        	$patients 	= 	$user->patients()->whereHas('reminderService',
        								function($q) use($day,$time){
        									$q->where('status',1);
                                            $q->where('start_date','>=',date('Y-m-d'));
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
                                            $q->where('start_date','>=',date('Y-m-d'));
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
        									}])
        						->get();
        	foreach ($patients as $patient) {
        		//code...
        		foreach ($patient->reminderService as $service) {

                    # code...
                    \Helper::sendSmsMessage($service,'reminder');
                }
        	}
        endforeach;
    }
}
