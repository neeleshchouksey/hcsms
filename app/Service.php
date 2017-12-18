<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function patRemiService(){

    	return $this->hasMany('App\PatientService','service_id');

    }
    public function smsTypes(){

    	return $this->hasMany('App\ServiceSmsTypes','service_id');
    	
    }
}
