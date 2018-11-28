<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    //
    public function apptTimeData(){
    	return $this->belongsTo('App\RemiderTime','appt_time');
    }
    public function patient(){
    	return $this->belongsTo('App\Patient','patient_id');
    }
    public function serviceData(){
    	return $this->belongsTo('App\Service','service_id');
    }
    
    public function apptReminders(){
        return $this->hasMany('App\PatientAppointmentReminders','appointment_id');
    }
    public function timeData(){
        return $this->belongsTo('App\RemiderTime','appt_time');
    }
    public function reminderMessage(){
        return $this->hasMany('App\ReminderSms','patient_appt_id');
    }
    public function getNewApptDateAttribute() {
           $date = \DateTime::createFromFormat('d/m/Y', $this->appt_date);
            return $date->format('Y-m-d');
    }   
}
