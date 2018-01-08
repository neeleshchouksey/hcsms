<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSmsTypes extends Model
{
    //
    public function languageMessage() {
    	return $this->hasMany('App\LanguageSmsMessage','sms_type_id');
	}
	 public function parentService() {
    	return $this->belongsTo('App\Service','service_id');
	}
	public function remindMessage() {
    	return $this->hasMany('App\ReminderSms','sms_type_id');
	}
	public function apptReminders(){
        return $this->hasMany('App\PatientAppointmentReminders','reminder_id');
    }



}
