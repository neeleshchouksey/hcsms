<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Patient extends Model
{
    //
    public function reminderService(){
    	return $this->hasMany('App\PatientService','patient_id');
    }
    public function doctor(){
    	return $this->belongsTO('App\User','user_id');
    }
    public function language(){
    	return $this->belongsTO('App\Language','language_id');
    }
}
