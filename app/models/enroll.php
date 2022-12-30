<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class enroll extends Model
{
    protected $table='enroll';

    protected $fillable = [
       'id', 'student_id','course_id','date'
    ];


    protected $hidden = [
    ];
}
