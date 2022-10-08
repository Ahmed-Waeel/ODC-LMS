<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class sub_admins extends Model
{
    use HasApiTokens;

    protected $table='sub_admins';
    protected $fillable=[
        'id','name','email','password','created_at','updated_at'
    ];
    protected $hidden=[];

}
