<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderSms extends Model
{
    //
    public function receiveMessage(){
        return $this->hasOne('App\ReceiveSms','original_message_id','message_id');
    }
    public function parentService(){
    	return $this->belongsTo('App\PatientService','patient_service_id');
    }
    public function parentAppt(){
        return $this->belongsTo('App\PatientAppointment','patient_appt_id');
    }
    public function parentSmsType() {
    	return $this->belongsTo('App\ServiceSmsTypes','sms_type_id');
	}
    public function parentDay() {
        return $this->belongsTo('App\ReminderDays','day_id');
    }
    public function parentTime() {
        return $this->belongsTo('App\RemiderTime','time_id');
    }
    public function patient() {
        return $this->belongsTo('App\Patient','patient_id');
    }
}
