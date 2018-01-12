<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderDays extends Model
{
    //
    public function getMessages(){
    	return $this->hasMany('App\ReminderSms','day_id');
    }
    public function patientDays(){
    	return $this->hasMany('App\PatientReminderDays','day_id');
    }
}
