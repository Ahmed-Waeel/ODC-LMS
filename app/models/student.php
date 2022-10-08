<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class student extends Model
{
    use HasApiTokens;

    protected $table='students';

    protected $fillable = [
        'id','name', 'email', 'password', 'phone' , 'address' , 'college','course_id'
    ];


    protected $hidden = [
        'password','remember_token', 'create_at', 'update_at'
    ];


    public function course(){
        return $this->belongsTo('app\models\course','course_id','id');
    }



}
