<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function patRemiService(){
    	return $this->hasOne('App\PatientService','service_id');
    }
}
