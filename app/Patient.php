<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Patient extends Model
{
    //
    public function getServices()
    {
    	  return Service::whereIn('id', explode(',',$this->patient->services))->pluck('name')->toArray();
    }
}
