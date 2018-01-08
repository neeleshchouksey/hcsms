<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAppointmentReminders extends Model
{
    //
    public function apptData(){
    	return $this->belongsTo('App\PatientAppointment','appointment_id');
    }
    public function smsTypeData(){
    	return $this->belongsTo('App\ServiceSmsTypes','reminder_id');
    }
    public function statusData(){
    	return $this->hasOne('App\AppointmentReminderStatus','id','status');
    }
}
