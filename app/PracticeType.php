<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeType extends Model
{
    //
    public function services(){
    	$this->hasMany('App\Services','Practice_id');
    }
}
