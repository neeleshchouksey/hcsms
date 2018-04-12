<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsCostCharges extends Model
{
    //
    public function getCurrency(){
        return $this->belongsTo('App\ClickSendCurrency','currency');
    }
}
