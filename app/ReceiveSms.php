<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveSms extends Model
{
    //
    public function remindMessage(){
        return $this->belongsTo('App\ReminderSms','original_message_id','message_id');
    }
}
