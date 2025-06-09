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

            // Debug: Check if email is present
            if (empty($UserEmail)) {
                return ResponseHelper::Out('fail', 'No email provided in request', 400);
            }

            $OTP = rand(100000, 999999);
            $details = ['code' => $OTP];

            // Debug point: Before sending mail
            // dd('Before sending mail', $UserEmail, $OTP);

            Mail::to($UserEmail)->send(new OTPEmail($details));

            // Debug point: Before DB update
            // dd('Before DB update', $UserEmail, $OTP);

            User::updateOrCreate(
                ['email' => $UserEmail],
                ['email' => $UserEmail, 'otp' => $OTP]
            );

            // Debug point: After DB update
            // dd('After DB update');

            return ResponseHelper::Out('success', "A 6 digit OTP sent to your email", 200);

        } catch (Exception $e) {
            // Return the actual error message for debugging
            return ResponseHelper::Out('fail', $e->getMessage(), 401);
        }
    }


    public function VerifyLogin(Request $request)
    {

        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;

        $verification = User::where('email', $UserEmail)->where('otp', $OTP)->first();

        if ($verification) {

            User::where('email', $UserEmail)->where('otp', $OTP)->update(['otp' => '0']);

            $token = JWTToken::CreateToken($UserEmail, $verification->id);
            return ResponseHelper::Out('success', "", 200)->cookie('token', $token, 60 * 24 * 60);
        } else {

            return ResponseHelper::Out('fail', null, 401);
        }

    }



         function UserLogout(){

             return redirect('/userLoginPage')->cookie('token',-1);
         }

    // public function SendOtp(Request $request)
    // {

    //     $UserEmail = $request->UserEmail;

    //     $OTP = rand(100000, 999999);
    //     $details = ['code' => $OTP];
    //     Mail::to($UserEmail)->send(new OTPEmail($details));
    //     UserOtp::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);
    //     return response()->json(['success' => 'OTP send to your email']);
    // }
    // public function SendOtpLater(Request $request)
    // {

    //     $UserEmail = $request->UserEmail;

    //     $OTP = rand(100000, 999999);
    //     $details = ['code' => $OTP];

    //     //   Mail::to($UserEmail)->send(new OTPEmail($details));


    //     SendEmailJob::dispatch($UserEmail, new OTPEmail($details));

    //     UserOtp::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);
    //     return response()->json(['success' => 'OTP send to your email']);
    // }
}
