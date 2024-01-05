<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    function RegistrationPage(){
            return view('pages.auth.registration-page');
        }
        
    function LoginPage(){
        return view('pages.auth.login-page');
    }
    function SendOTPPage(){
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(){
        return view('pages.auth.verify-otp-page');
    }
    function PasswordResetPage(){
        return view('pages.auth.reset-pass-page');
    }

    function UserRegistration(Request $request)
    {
        // dd($request->input());

        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Registration is successfully'
            ],200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'message' => $exception->getMessage(),
            ],401);
        }

    }


    function UserLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();
        // dd($count);
        if ($count == 1) {
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'Login success'
            ],200)->cookie('token', $token, 60*24*30);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => "Unauthorized"
            ]);
        }
    }


    function SendOTPCODE(Request $request)
    {
        $email = $request->input('email'); //catch email
        $otp = rand(1000, 9999); // make 4 digit random OTP

        // find user matching request email
        $count = User::where('email', '=', $email)->count();

        if ($count != 1) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        } else {
            // OTP send
            Mail::to($email)->send(new OTPMail($otp));
            // OTP Update on Database by User Model
            User::where('email', '=', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => '4 digit OTP send your email successfully'
            ],200);
        }

    }

    function VerifyOTP(Request $request)
    {
        $email=$request->input('email');
        $otp=$request->input('otp');

        $count=User::where('email','=', $email)
        ->where('otp', '=', $otp)
        ->count();

        if($count !=1){
            return response()->json([
                'status'=>'failed',
                'message'=>'unauthorized'
            ]);
        }else{
            // OTP Update
            User::where('email', '=', $email)->update(['otp'=>'0']);
            // Password Issue and Token Issue
            $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status'=>'success',
                'message'=>'OTP verification successfully'
            ],200)->cookie('token', $token, 60*24*30);
        }
    }

    function ResetPassword(Request $request){
        try{
            $email=$request->header('email');
            $password=$request->input('password');

            User::where('email', '=', $email)->update(['password'=>$password]);
            return response()->json([
                'status'=>'success',
                'message'=>'User password reset successfully'
            ],200);            
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e
            ],200);
        }
    }

    function UserLogout(){
        return redirect('/login-page')->cookie('token','',-1);
    }


}
