<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderSms extends Model
{
    //
    public function receiveMessage(){
        return $this->hasOne('App\ReceiveSms','original_message_id','message_id');
    }
}
