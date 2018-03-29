<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPages extends Model
{
    //
    public function permissions(){
    	return $this->belongsTo('App\AdminPermissions','permission_id');
    }
}
