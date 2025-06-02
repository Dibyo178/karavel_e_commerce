<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Jobs\SendEmailJob;
use App\Mail\OTPEmail;
use App\Models\User;
use App\Models\UserOtp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function UserLogin(Request $request)
    {

        try {

    $UserEmail = $request->UserEmail;

        $OTP = rand(100000, 999999);
        $details = ['code' => $OTP];

        //   Mail::to($UserEmail)->send(new OTPEmail($details));


        SendEmailJob::dispatch($UserEmail, new OTPEmail($details));

        User::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);
            return ResponseHelper::Out('success', "A 6 digit otp send your email", 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('fail',$e,401);
        }


    }

     public function VerifyLogin(Request $request){

         $UserEmail = $request->UserEmail;
         $OTP = $request->OTP;

         $verification = User::where('email',$UserEmail)->where('otp',$OTP)->first();

         if($verification){

         User::where('email',$UserEmail)->where('otp',$OTP)->update(['otp'=>'0']);

          $token =JWTToken::CreateToken($UserEmail,$verification->id);
          return ResponseHelper::Out('success',"",200)->cookie('token',$token,60*24*60);
         }
         else{

            return ResponseHelper::Out('fail',null,401);
         }

        //  function UserLogout(){

        //      return redirect('/userLoginPage')->cookie('token',-1);
        //  }
     }



    public function SendOtp(Request $request)
    {

        $UserEmail = $request->UserEmail;

        $OTP = rand(100000, 999999);
        $details = ['code' => $OTP];
        Mail::to($UserEmail)->send(new OTPEmail($details));
        UserOtp::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);
        return response()->json(['success' => 'OTP send to your email']);
    }
    public function SendOtpLater(Request $request)
    {

        $UserEmail = $request->UserEmail;

        $OTP = rand(100000, 999999);
        $details = ['code' => $OTP];

        //   Mail::to($UserEmail)->send(new OTPEmail($details));


        SendEmailJob::dispatch($UserEmail, new OTPEmail($details));

        UserOtp::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);
        return response()->json(['success' => 'OTP send to your email']);
    }
}
