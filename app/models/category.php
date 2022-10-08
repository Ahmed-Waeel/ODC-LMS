<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
     protected $table='categories';

    protected $fillable = [
        'id' ,'name', 'create_at', 'update_at'
    ];


    protected $hidden = [
         'remember_token', 'create_at', 'update_at'
    ];
}
