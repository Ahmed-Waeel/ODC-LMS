<?php

namespace App\Http\Controllers\subAdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function logout(Request $request){
        auth('subAdmin')->user()->tokens()->delete();
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
