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
    public function parentSmsType() {
    	return $this->belongsTo('App\ServiceSmsTypes','sms_type_id');
	}
}
