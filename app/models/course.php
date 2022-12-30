<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $table='course';

    protected $fillable = [
        'id','name', 'description', 'img', 'level' , 'category_id', 'trainer_id','create_at', 'update_at'
    ];


    protected $hidden = [
        'remember_token', 'create_at', 'update_at'
    ];

    public function students(){
        return $this->hasMany('App\models\student','course_id','id');
    }
}
