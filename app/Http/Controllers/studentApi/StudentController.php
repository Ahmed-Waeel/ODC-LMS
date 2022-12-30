<?php

namespace App\Http\Controllers\studentApi;

use App\Http\Controllers\adminApi\Response;
use App\Http\Controllers\Controller;
use App\models\course;
use App\models\student;
use Illuminate\Http\Request;
use phpseclib\Crypt\Random;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    use Response;

    public function enroll( $courseId){
        $id=auth('api')->user()->id();
        $student = student::find($id);
        $course = course::find($courseId);

        if (!$course) {
            return $this->apiResponse(null , 'Course Not Found' , 404);
        }
        if (!$student) {
            return $this->apiResponse(null , 'Student Not Found' , 404);
        }


        $student->course_id = $courseId;
        $student->save();
        return $this->apiResponse($student , 'Enrolled Successfully' , 201);
    }

    public function status( $courseId){
        $id=auth('api')->user()->id();
        $student = student::find($id);
        $course = course::find($courseId);

        if (!$course) {
            return $this->apiResponse(null , 'Course Not Found' , 404);
        }
        if (!$student) {
            return $this->apiResponse(null , 'Student Not Found' , 404);
        }
        switch ($student->status){
            case 0:return 'Not Applied';
            break;
            case 1:return 'Waiting';
                break;
            case 2:return 'Accepted';
                break;
            case 3:return 'Rejected';
                break;
        }
    }
     public function requestCode( ){
         $id=auth('api')->user()->id();
         $courseId=auth()->user()->course_id();
        $student = student::find($id);
         $course = course::find($courseId);

         if (!$course) {
             return $this->apiResponse(null , 'Course Not Found' , 404);
         }
         if (!$student) {
             return $this->apiResponse(null , 'Student Not Found' , 404);
         }

         $code= Str::random(20);
         $deleted_at=now()->addHours('2');
         if(stringValue(now()) === stringValue($deleted_at)){
             $student = student::findOrFail($id);
             $student->code =null;
         }

     }

}
