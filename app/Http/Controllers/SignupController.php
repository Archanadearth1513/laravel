<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class SignupController extends Controller
{
    public function showSignupForm()
    {
    return view('auth.signup');
    }

    public function signup(Request $request){

        //validate data
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|unique:users',
            'password' => 'nullable'      
             ] );

       if($validator->fails()){
        return response()->json($validator->errors(),422);
       }

       // Generate random password if not provided
       $password = $request->password ?: Str::random(10);

       //create user
       $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password' => Hash::make($password)
    ]);

       return response()->json(['message'=>'User created successfully!','user'=>$user,'generated_password' => $request->password ? null : $password],201);
    }
}
