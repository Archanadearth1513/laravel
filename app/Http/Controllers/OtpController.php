<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    
    public function showOtpForm()
    {
        return view('auth.otp_verify'); 
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string']);

        // Check if the OTP matches
        if ($request->otp === session('otp')) {
            $user = User::find(session('user_id'));
            Auth::login($user);
            session()->forget(['otp', 'user_id']); 
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }
}

