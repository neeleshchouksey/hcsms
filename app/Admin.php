<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function parentUser(){
        return $this->hasOne(self::class,'id', 'added_by');

    }
    public function userStatus(){
        return $this->belongsTo('App\AdminStatus','status');

    }
    public function userPages(){
        return $this->hasMany('App\AdminPages','user_id');
    }
    public function checkPer($perm = null)
    {
        if(is_null($perm)) return false;
        $perms = $this->userPages()->whereHas('permissions' , function($query) use($perm)
        {
            $query->select('slug');
            $query->where('slug',$perm);
        })->get()->toArray();
       
        if(!empty($perms)){
            return true;
        }
        else{
            return false;
        }
    }
}
