<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReminderTime extends Model
{
    //
     public function timeData(){
    	return $this->belongsTo('App\RemiderTime','time_id');
    }
}
