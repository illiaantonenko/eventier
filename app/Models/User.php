<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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

//    protected $attributes = ['fullName'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function news(){
        return $this->hasMany(News::class);
    }
    public function absence(){
        return $this->hasMany(Absence::class);
    }

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function getFullNameAttribute(){
        return $this->profile->firstname." ".$this->profile->lastname;
    }
}
