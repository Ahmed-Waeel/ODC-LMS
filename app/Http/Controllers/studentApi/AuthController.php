<?php

namespace App\Http\Controllers\studentApi;

use App\Http\Controllers\Controller;
use App\models\student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    public function register(Request $request) {
        $validator = $request->validate([
            'name'=>'required | max:100 |alpha_dash |string',
            'email'=>'required |max:50 | unique:students |email |alpha_dash |string',
            'password'=>'required |min:8 |max:50 |alpha_dash |confirmed',
            'phone'=>'required |max:11 |numeric',
            'address'=>'required ',
            'college'=>'required ',
        ]);

        $student = student::create([
            'name'=>$validator['name'],
            'email'=>$validator['email'],
            'password'=>$validator['role'],
            'phone'=>bcrypt($validator['password']),
            'address'=>$validator['address'],
            'college'=>$validator['college']
        ]);
        $token= $student->createToken("myToken")->plainTextToken;

        $response=[
            'data' => $student,
            'Token'=>$token,
        ];
        return response($response , 201);
    }

    public function logout(Request $request){
        auth('student')->user()->tokens()->delete();
        return[
            'message'=>'Logged Out Successfully'
        ];
    }

    public function login(Request $request) {
        $validator = $request->validate([
            'email'=>'required |max:50  |email |alpha_dash |string',
            'password'=>'required |min:8 |max:50 |alpha_dash',

        ]);

        $student= student::where('email' ,$validator['email'])->first();

        if (!$student || !Hash::check($validator['password'] , $student->password)){
            return response( [
                'message'=>"Your Email Or Password Does Not Match",
            ],401);
        }

        $token=$student->createToken("myToken")->plainTextToken;

        $response=[
            'data' => $student,
            'Token'=>$token,
        ];
        return response($response , 201);
    }
}
