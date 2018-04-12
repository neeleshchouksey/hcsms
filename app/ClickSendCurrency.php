<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClickSendCurrency extends Model
{
    //
    public function costCharges(){
    	
    	return $this->hasMany('App\SmsCostCharges','currency');
    
    }
    public function actCurrency(){
    	return $this->belongsTo('App\HelperCountry','code','currency_code');
    }
}
