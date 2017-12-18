<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    public function patients(){

    	return $this->hasMany('App\Patient','language_id');
    	
    }
}
