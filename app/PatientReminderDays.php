<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReminderDays extends Model
{
    //
    public function dayData(){
    	return $this->belongsTo('App\ReminderDays','day_id');
    }
    public function parentService(){
    	return $this->belongsTo('App\PatientService','pat_ser_id');
    }
}
