<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($user_id)
    {
          return view("verifyotp")->with(["user_id"=> $user_id]);

    }

    public function otplogin(Request $request)
    {
        $userOtp   = Verification::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
  
        $now = now();
        if (!$userOtp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }else if($userOtp && $now->isAfter($userOtp->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }
    
        $user = Register::whereId($request->user_id)->first();
  
        if($user){
              
            $userOtp->update([
                'expire_at' => now()
            ]);
  
           return redirect()->back()->with('success','you have being registered');
        }
  
        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
    }

