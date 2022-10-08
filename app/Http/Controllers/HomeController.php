<?php

namespace App\Http\Controllers;

use App\models\course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getAdmins(){
        $admins = User::select('id' , 'name' ,'email' )-> get();
        return view('admin.admins',compact('admins'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | max:50 |alpha_dash',
            'email' => 'required | max:100 |unique:users |alpha_dash ',
            'password' => 'required |min:8 |max:50 |alpha_dash',
        ];
        $messages = [
            'name.required' => 'You Must Enter The Admin Name',
            'name.max' => 'The Admin Name should be maximum 50 character',
            'email.required' => 'You Must Enter The Admin email',
            'email.max' => 'The Admin E-mail should be maximum 100 character',
            'email.unique' => 'This E-mail is Already Exists',
            'password.required' => 'You Must Enter The Admin Password',
            'password.min' => 'The Password Should be at Least 8 Characters',
            'password.max' => 'The Password Shouldn\'t be more Than 50 characters ',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }


        $admins = User::create($request->all());

        if($admins)
        return redirect()->back()->with(['success' => 'DONE']);
    }

    public function edit($id)
    {

        $admin =User::findOrFail($id);
        return view('admin.edit.Admin-edit' , compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin =User::findOrFail($id);
        $admins = User::where('id', $id)->first();

        if (!$admins) {
            return $this->apiResponse(null, "This Admin isn't Found", 404);
        }

        $rules = [
            'name' => 'required | max:50 |alpha_dash ',
            'email' => 'required | max:100 |unique:users |alpha_dash',
            'password' => 'required |min:8 |max:50 |alpha_dash',
        ];
        $messages = [
            'name.required' => 'You Must Enter The Admin Name',
            'name.max' => 'The Admin Name should be maximum 50 character',
            'email.required' => 'You Must Enter The Admin email',
            'email.max' => 'The Admin E-mail should be maximum 100 character',
            'email.unique' => 'This E-mail is Already Exists',
            'password.required' => 'You Must Enter The Admin Password',
            'password.min' => 'The Password Should be at Least 8 Characters',
            'password.max' => 'The Password Shouldn\'t be more Than 50 characters ',
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator)->with(['failed' => 'There\'s Something Wrong']);
        }


        $admins = User::update($request->all());


        if ($admins) {
            return redirect()->back()->with( ['success'=>'Updated']);
        }
    }

    public function delete($id){
        $admins=User::where('id',$id)->first();

        if (! $admins){
            return redirect()->back()->with(['error' => 'This Course Does Not exist']);
        }

        $admins-> delete();

        return redirect()-> back( )->with(['deleted','Course Deleted Successfully']);
        }
    
}
