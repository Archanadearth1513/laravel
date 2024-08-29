<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'auth_type' => 'required|in:password,otp',
            'password' => 'nullable',
        ]);

        // Handle Password Login
        if ($request->auth_type === 'password') {
            // Since the password is nullable, ensure that it's required when the auth_type is password
            if (empty($request->password)) {
                return response()->json(['error' => 'Password is required for password login'], 422);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ], 200);
            }

            return response()->json(['error' => 'Incorrect credentials'], 401);
        }

        // Handle OTP Login
        if ($request->auth_type === 'otp') {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $otp = rand(100000, 999999);
                session(['otp' => $otp, 'user_id' => $user->id]);

                // Send OTP to the user's email
                Mail::to($user->email)->send(new SendOtpMail($otp));

                return response()->json([
                    'message' => 'OTP sent to your email',
                    'otp' => $otp // For development purposes, remove in production
                ], 200);
            }

            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
