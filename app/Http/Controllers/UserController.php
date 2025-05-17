<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
  public function UserLogin(Request $request){

     try{

        $UserEmail = $request->UserEmail;
        $OTP = rand(100000,999999);
        $details = ['code'=>$OTP];
        Mail::to($UserEmail)->send(new OTPMail($details));
        User::updateOrCreate(['email'=>$UserEmail],['email'=>$UserEmail,'otp'=>$OTP]);
        return ResponseHelper::
     }
  }
}
