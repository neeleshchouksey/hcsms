<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageSmsMessage extends Model
{
    //
    public function smsType() {
    	return $this->belongsTo('App\ServiceSmsTypes','sms_type_id');
	}
	public function smsUser() {
    	return $this->belongsTo('App\User','user_id');
	}
	public function adminUser() {
    	return $this->belongsTo('App\Admin','user_id');
	}
}
