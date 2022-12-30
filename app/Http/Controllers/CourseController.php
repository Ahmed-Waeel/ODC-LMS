<?php

namespace App\Http\Controllers;

use App\models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class CourseController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.courses');
    }


    public function create()
    {
        //
    }


    public function store(Request $request){
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

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        course::create([
            'name'=>$request ->name,
            'description'=>$request ->description,
            'level'=>$request -> level,
            'category_id'=>$request -> category_id,
        ]);
        return redirect()->back()->with(['success' => 'DONE']);
    }


    public function show()
    {
        $courses= course::select( 'id', 'name' , 'description' , 'level' , 'category_id')->get();
        return view('admin.courses' , compact('courses'));
    }


    public function edit($id)
    {
        $course =course::findOrFail($id);
        return view('admin.edit.courses-edit' , compact('course'));
    }


    public function update(Request $request, $id)
    {
        $course =course::findOrFail($id);

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

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        $course->update($request->all());

        return redirect()->back()->with( ['success'=>'Updated']);
    }


    public function delete($id)
    {
        $course = course::where('id',$id)->first();
        if (! $course){
            return redirect()->back()->with(['error' => 'This Course Does Not exist']);
        }

        $course-> delete();

        return redirect()-> back( )->with(['deleted','Course Deleted Successfully']);
    }
}
