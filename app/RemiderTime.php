<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemiderTime extends Model
{
    //
    public function getMessages(){
    	$this->hasMany('App\ReminderSms','time_id');
    }
    public function appointments(){

    	return $this->hasMany('App\PatientAppointment','appt_time');
    	
    }
    public function patientTimes(){
    	$this->hasMany('App\PatientReminderTime','time_id');
    }
}
