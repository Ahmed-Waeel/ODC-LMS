<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request) {
        $validator = $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|min:6|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'=>$validator['name'],
            'email'=>$validator['email'],
            'password'=>bcrypt($validator['password'])
        ]);
        $token=$user->createToken("myToken")->plainTextToken;

        $response=[
            'data' => $user,
            'Token'=>$token,
        ];
        return response($response ,'Registered Successfully', 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return[
            'message'=>'Logged Out Successfully'
        ];
    }

    public function login(Request $request) {
        $validator = $request->validate([
            'email' => 'required|string|email|max:100 |min:6',
            'password' => 'required|string|min:6',

        ]);

        $user= User::where('email' ,$validator['email'])->first();

        if (!$user || !Hash::check($validator['password'] , $user->password)){
            return response( [
                'message'=>"Your Email Or Password Does Not Match",
            ],401);
        }

        $token=$user->createToken("myToken")->plainTextToken;

        $response=[
            'data' => $user,
            'Token'=>$token,
        ];
        return response($response , 201);
    }
}
