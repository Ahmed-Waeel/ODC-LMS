<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class teaching extends Model
{
    protected $table='teaching';

    protected $fillable = [
        'id', 'course_id','trainer_id'
    ];


    protected $hidden = [

    ];
}
