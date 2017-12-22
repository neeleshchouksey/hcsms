<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemiderTime extends Model
{
    //
    public function getMessages(){
    	$this->hasMany('App\ReminderSms','time_id');
    }
}
