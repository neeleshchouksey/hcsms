<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageSmsMessage extends Model
{
    //
    public function smsType() {
    	return $this->belongsTo('App\ServiceSmsTypes','sms_type_id');
	}
}
