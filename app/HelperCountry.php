<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelperCountry extends Model
{
    //
    public function chCurrencies(){
    	
    	return $this->hasMany('App\ClickSendCurrency','code','currency_code');
    
    }
}
