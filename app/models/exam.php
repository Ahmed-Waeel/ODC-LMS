<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    protected $table='exams';

    protected $fillable = [
        'id','course_id'
    ];


    protected $hidden = [
    ];
}
