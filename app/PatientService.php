<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientService extends Model
{
    //
    public function reminderDays(){
    	return $this->hasMany('App\PatientReminderDays','pat_ser_id');
    }
    public function reminderTime(){

    	return $this->hasMany('App\PatientReminderTime','pat_ser_id');
    }
    public function patient(){
    	return $this->belongsTo('App\Patient','patient_id');
    }
    public function serviceData(){
    	return $this->belongsTo('App\Service','service_id');
    }
}
