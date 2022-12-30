<?php

namespace App\Http\Controllers\studentApi;

use App\Http\Controllers\Controller;
use App\models\course;
use App\models\student;
use Illuminate\Http\Request;
use App\Http\Controllers\adminApi\Response;

class CourseController extends Controller
{
    use Response;


    public function show(){
        $courses=course::select('id' , 'name')->get();

        return $this->apiResponse($courses , "Success" , 200);

    }





}
