<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    protected $dates = [
        'email_verified_at',
        'birth'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'datetime:Y-m-d',
    ];



    public function isAdmin(){
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isBasicAdmin(){
        return $this->role == 'admin';
    }

    public function isSuperAdmin(){
        return $this->role == 'superadmin';
    }


    /*
    public function setBirthAttribute($date)
    {
        $this->attributes['birth'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
    */
}
