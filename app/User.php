<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
    public function keyContacts(){
        return $this->hasMany('App\KeyContacts','user_id');
    }
    public function staffs(){
        return $this->hasMany('App\Staff','user_id');
    }
    public function patients(){
        return $this->hasMany('App\Patient','user_id');
    }
    public function getCountry(){
        return $this->belongsTo('App\Country','country');
    }
}
