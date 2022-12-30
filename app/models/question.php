<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $table='questions';

    protected $fillable = [
        'id','question','answer','wrong_answer1' , 'wrong_answer2' , 'wrong_answer3','course_id'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];
}
