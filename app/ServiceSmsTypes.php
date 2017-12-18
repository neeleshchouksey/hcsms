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


}
