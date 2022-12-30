<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class trainer extends Model
{
    protected $table='trainers';

    protected $fillable = [
        'id','name'
    ];


    protected $hidden = [

    ];
}
