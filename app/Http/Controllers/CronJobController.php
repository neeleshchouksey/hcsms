<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
class CronJobController extends Controller
{
    //
    function sendMessage(){
    	echo $day 	=	strtolower(date('D'));
    	echo $time 	=	date('H:00');
    	$patients 	= 	Patient::whereHas('reminderService',
    								function($q) use($day,$time){
    									$q->where('status',1);
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
    	//foreach ($patients as $patient) {
    		# code...
    	//	$patient
    	//}
    	echo "<pre>";
    	print_r($patients);
    }
}
