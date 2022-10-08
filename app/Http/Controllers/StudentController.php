<?php

namespace App\Http\Controllers;

use App\models\course;
use App\models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class StudentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.students');
    }


    public function create()
    {
        //
    }


    public function store(Request $request){
        $rules=[
            'name'=>'required | max:30 |min:5 |string',
            'email'=>'required |max:30 |min:10 |unique:students | email ',
            'password'=>'required |min:8 |max:50 |confirmed ',
            'phone'=>'required |max:11  | min:11 |numeric',
            'address'=>'required ',
            'college'=>'required ',
        ];
        $messages=[
            'name.required'=>'You Must Enter Student name',
            'name.string'=>'The Name Must Be String',
            'name.max'=>'The Name should be maximum 30 character',
            'name.min'=>'The Name should be minimum 5 character',
            'email.required'=>'Your Email Is Required',
            'email.email'=>'Please Enter a valid Email',
            'email.min'=>'email Must Be At Least 10 characters',
            'email.max'=>'email Must Be At Most 30 characters',
            'password.required'=>'You Must Enter a Password ',
            'password.min'=>'The password should be minimum 8 character',
            'password.max'=>'The password should be maximum 50 character',
            'password.confirmed'=>'Please Confirm Your Password',
            'phone.required'=>'The Phone is required',
            'phone.max'=>'The Phone should be  11 Numbers',
            'phone.min'=>'The Phone should be  11 Numbers',
            'address.required'=>'The address is required ',
            'college.required'=>'The college is required',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }


        student::create([
            'name'=>$request -> name,
            'email'=>$request -> email,
            'password'=>Hash::make($request -> password) ,
            'phone'=>$request -> phone,
            'address'=>$request -> address,
            'college'=>$request -> college	,
        ]);
        return redirect()->back()->with(['success' => 'DONE']);
    }



    public function show(student $student)
    {
        $students=student::select('id', 'name' , 'email' ,'password','phone','address','college'	)->get();
        return view('admin.students' , compact('students'));
    }


    public function edit(student $student)
    {
        //
    }


    public function update(Request $request, student $student)
    {
        //
    }


    public function delete($id)
    {
        $students = student::where('id',$id)->first();
        if (! $students){
            return redirect()->back()->with(['error' => 'This Student Does Not exist']);
        }

        $students-> delete();

        return redirect()-> back( )->with(['deleted','Student Deleted Successfully']);
    }
}
