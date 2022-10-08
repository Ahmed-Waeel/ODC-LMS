<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class revision extends Model
{
    protected $table='revision';

    protected $fillable = [
        'id','degree','total_right_degree','total_wrong_degree','exam_id','student_id'
    ];


    protected $hidden = [

    ];
}
