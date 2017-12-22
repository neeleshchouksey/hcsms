<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderDays extends Model
{
    //
    public function getMessages(){
    	$this->hasMany('App\ReminderSms','day_id');
    }
}
