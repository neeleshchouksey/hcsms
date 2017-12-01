<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReminderDays extends Model
{
    //
    public function dayData(){
    	return $this->belongsTo('App\ReminderDays','day_id');
    }
}
