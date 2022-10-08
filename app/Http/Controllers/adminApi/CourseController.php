<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use Response;

    public function index(){
        $courses=course::select('id' , 'name')->get();

        return $this->apiResponse($courses , "Success" , 200);

    }

    public function indexById($id)
    {

        $courses = course::where('id', $id)->first();

        if ($courses) {
            return $this->apiResponse($courses, "Success", 200);
        } else {
            return $this->apiResponse(null, "This courses isn't Found", 404);
        }
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required | max:50 ',
            'description'=>'required | max:500 ',
            'level'=>'required ',
            'category_id'=>'required ' ,
            'trainer_id'=>'required'
        ];
        $messages=[
            'name.required'=>'You Must Enter The Course Name',
            'name.max'=>'The Course Name should be maximum 50 character',
            'description.required'=>'You Must Enter Description',
            'description.max'=>'The Description should be maximum 500 character',
            'level.required'=>'You Must Choose level',
            'category_id.required'=>'You Must Choose Category',
            'trainer_id.required'=>'You must Enter the trainer id'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $courses = course::create($request->all());

        if ($courses) {
            return $this->apiResponse($courses, "The Category Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Category Hasn't Saved", 400);
        }
    }


    public function update(Request $request, $id)
    {
        $courses = course::where('id', $id)->first();

        if (!$courses) {
            return $this->apiResponse(null, "This Course isn't Found", 404);
        }

        $rules=[
            'name'=>'required | max:50 ',
            'description'=>'required | max:500 ',
            'level'=>'required ',
            'category_id'=>'required ' ,
            'trainer_id'=>'required'
        ];
        $messages=[
            'name.required'=>'You Must Enter The Course Name',
            'name.max'=>'The Course Name should be maximum 50 character',
            'description.required'=>'You Must Enter Description',
            'description.max'=>'The Description should be maximum 500 character',
            'level.required'=>'You Must Choose level',
            'category_id.required'=>'You Must Choose Category',
            'trainer_id.required'=>'You must Enter the trainer id'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


         $courses->update($request->all());

        if ($courses) {
            return $this->apiResponse($courses, "The Course Has Been Updated", 201);
        }
    }

    public function delete($id){
        $courses=course::where('id',$id)->first();

        if(!$courses){
            return $this->apiResponse(null, "This Course isn't Found", 404);
        }

        $delete= $courses->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Course Has Been Deleted", 201);
        }
    }
}
