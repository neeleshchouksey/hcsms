<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    //
    public function apptTimeData(){
    	return $this->belongsTo('App\RemiderTime','appt_time');
    }
    public function patientData(){
    	return $this->belongsTo('App\Patient','patient_id');
    }
    public function serviceData(){
    	return $this->belongsTo('App\Service','service_id');
    }
}
