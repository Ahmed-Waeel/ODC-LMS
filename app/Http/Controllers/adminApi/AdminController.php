<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use Response;

    public function index()
    {
        $admins = User::select('id', 'name', 'email')->get();

        return $this->apiResponse($admins, "Success", 200);

    }

    public function indexById($id)
    {

        $admins = User::where('id', $id)->first();

        if ($admins) {
            return $this->apiResponse($admins, "Success", 200);
        } else {
            return $this->apiResponse(null, "This Admin isn't Found", 404);
        }
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

        $validator = validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $admins = User::create($request->all());


        if ($admins) {
            return $this->apiResponse($admins, "The Admin Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Admin Hasn't Saved", 400);
        }
    }

    public function update(Request $request, $id)
    {

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
            return $this->apiResponse(null, $validator->errors(), 400);
        }


         $admins->update($request->all());

        if ($admins) {
            return $this->apiResponse($admins, "The Admin Has Been Updated", 201);
        }
    }

    public function delete($id){
        $admins=User::where('id',$id)->first();

        if(! $admins){
            return $this->apiResponse(null, "This Admin isn't Found", 404);
        }

        $delete= $admins->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Admin Has Been Deleted", 201);
        }
    }
}
