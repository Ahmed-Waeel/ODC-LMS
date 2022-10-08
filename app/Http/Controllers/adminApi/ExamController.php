<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\adminApi\Response;
use App\Http\Controllers\Controller;
use App\models\exam;
use App\models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class ExamController extends Controller
{
    use Response;



    public function makeExam($courseId){
        $numberOfQuestions = question::where('course_id',$courseId)->get()->random(10);
        return $this->apiResponse($numberOfQuestions,'Exam Created Successfully' , 201);



    }
}
