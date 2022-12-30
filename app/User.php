<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'id','name', 'email', 'password' , 'created_at','updated_at'
    ];


    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
