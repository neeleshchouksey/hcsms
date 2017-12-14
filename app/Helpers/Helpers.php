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
   

}