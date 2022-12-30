<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\models\course;
use App\models\student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    use Response;

    public function index(){
        $students=student::select('id', 'name' , 'email' ,'password','phone','address','college'	)->get();

        return $this->apiResponse($students , "Success" , 200);

    }
    public function indexById($id){

        $students=student::where('id',$id)->first();

        if($students) {
            return $this->apiResponse($students, "Success", 200);
        }else{
            return $this->apiResponse(null, "This Stident isn't Found", 404);
        }
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required | max:100 |alpha_dash',
            'email'=>'required |max:50 | unique:students |email |alpha_dash',
            'password'=>'required |min:8 |max:50 |alpha_dash',
            'phone'=>'required |max:11 |numeric',
            'address'=>'required ',
            'college'=>'required ',
        ];
        $messages=[
            'name.required'=>'You Must Enter Student name',
            'name.max'=>'The Name should be maximum 200 character',
            'password.required'=>'You Must Enter a Password ',
            'password.min'=>'The password should be minimum 8 character',
            'password.max'=>'The password should be maximum 50 character',
            'phone.required'=>'The Phone is required',
            'phone.max'=>'The Phone should be maximum 11 Number',
            'address.required'=>'The address is required ',
            'college.required'=>'The college is required',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $students=student::create($request->all());

        if ($students) {
            return $this->apiResponse($students, "The Students Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Students Hasn't Saved", 400);
        }
    }

    public function update(Request $request , $id)
    {

        $students = student::where('id', $id)->first();
        if (!$students) {
            return $this->apiResponse(null, "This Students isn't Found", 404);
        }

        $rules=[
            'name'=>'required | max:100 |alpha_dash',
            'email'=>'required |max:50 | unique:students |email |alpha_dash',
            'password'=>'required |min:8 |max:50 |alpha_dash',
            'phone'=>'required |max:11 |numeric',
            'address'=>'required ',
            'college'=>'required ',
        ];
        $messages=[
            'name.required'=>'You Must Enter Student name',
            'name.max'=>'The Name should be maximum 200 character',
            'password.required'=>'You Must Enter a Password ',
            'password.min'=>'The password should be minimum 8 character',
            'password.max'=>'The password should be maximum 50 character',
            'phone.required'=>'The Phone is required',
            'phone.max'=>'The Phone should be maximum 11 Number',
            'address.required'=>'The address is required ',
            'college.required'=>'The college is required',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return $this->apiResponse(null, $validator->errors(), 400);
        }


         $students->update($request->all());

        if ($students) {
            return $this->apiResponse($students, "The Student Info Has Been Updated", 201);
        }
    }

    public function delete($id){
        $students=student::where('id',$id)->first();

        if(! $students){
            return $this->apiResponse(null, "This Student isn't Found", 404);
        }

        $delete= $students->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Student Has Been Deleted", 201);
        }
    }

    public function enroll( $courseId){
        $id=auth()->id();
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
        $id=auth()->id();
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
//    public function requestCode( ){
//        $id=auth()->id();
//        $courseId=auth()->course_id();
//        $student = student::find($id);
//        $course = course::find($courseId);
//
//        if (!$course) {
//            return $this->apiResponse(null , 'Course Not Found' , 404);
//        }
//        if (!$student) {
//            return $this->apiResponse(null , 'Student Not Found' , 404);
//        }
//
//        $code= Str::random(20);
//        $deleted_at=now()->addHours('2');
//        if(stringValue(now()) === stringValue($deleted_at)){
//            $student = student::findOrFail($id);
//            $student->code =null;
//        }

//    }
}
