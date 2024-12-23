<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{

    function LoginPage():View{
        return view('pages.auth.login-page');
    }

    function RegistrationPage():View{
        return view('pages.auth.registration-page');
    }
    function SendOtpPage():View{
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage():View{
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage():View{
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage():View{
        return view('pages.dashboard.profile-page');
    }



    function UserRegistration(Request $request)
    {

        try {
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:6', // 'confirmed' requires a password_confirmation field
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // Return validation errors with a 422 status code
            }

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
                'ipaddress' => $request->ip(),
            ]);

            return redirect('/login');
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registered Failed',
            ], 200);
        }

    }

    function UserLogin(Request $request){
       $count = User::where('email','=',$request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->select('id')->first();

       if ($count!==null) {
            // User Login-> JWT Token Issue
           $token=JWTToken::CreateToken($request->input('email'),$count->id);
           return redirect('/dashboard')->cookie('token',$token,time()+60*24*30);


       } else{
           return response()->json([
               'status' => 'failed',
               'message' => 'unauthorized',
           ], 200);
       }
    }

    function SendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000,9999);

        $count = User::where('email', '=', $email)->count();

        if ($count==1) {

            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', '=', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => '4 Digit OTP Code has been send to your email !',
            ],200);

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Not Found',
            ], 200);
        }
    }

    function VerifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->count();

        if ($count==1) {
            // Database OTP Update
            User::where('email', '=', $email)->update(['otp' => '0']);

            // Password Reset Token Issue
            $token =JWTToken::CreateTokenForResetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification Successful',
            ],200)->cookie('token',$token,60*24*30);


        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'OTP Not Matched',
            ],200);
        }
    }

    function ResetPassword(Request $request)
    {
        try {
            $email = JWTToken::VerifyToken($request->input('token'));
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successfully',
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something Went Wrong',
            ], 200);
        }

    }


    function UserLogout(){
        return redirect('/')->cookie('token','',-1);
    }

    function index(Request $request)
    {
        $data = User::all();
        return response()->json(['status'=>'success','data'=>$data],200);
    }

}

