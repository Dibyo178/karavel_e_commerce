<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\OTPEmail;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{




        public function SendOtp(Request $request){

      $UserEmail = $request->UserEmail;

      $OTP = rand(100000,999999);
      $details = ['code'=>$OTP];
      Mail::to($UserEmail)->send(new OTPEmail($details));
      UserOtp::updateOrCreate(['email'=>$UserEmail],['email'=>$UserEmail,'otp'=>$OTP]);
      return response()->json(['success'=>'OTP send to your email']);
    }
    public function SendOtpLater(Request $request){

      $UserEmail = $request->UserEmail;

      $OTP = rand(100000,999999);
      $details = ['code'=>$OTP];

    //   Mail::to($UserEmail)->send(new OTPEmail($details));


      SendEmailJob::dispatch($UserEmail,new OTPEmail($details));

      UserOtp::updateOrCreate(['email'=>$UserEmail],['email'=>$UserEmail,'otp'=>$OTP]);
      return response()->json(['success'=>'OTP send to your email']);
    }
}
