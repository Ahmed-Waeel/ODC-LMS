<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class requested_codes extends Model
{
    protected $table='requested_codes';
    protected $fillable=[
        'id','course_id','student_id','code','created_at','updated_at'
    ];
    protected $hidden=[];
}
