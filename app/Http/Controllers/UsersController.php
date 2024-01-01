<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
                'status' => 'Success',
                'message' => 'Registration is successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'message' => $exception->getMessage(),
            ]);
        }

    }

    function UserLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();
// dd($count);
            if($count==1){
                $token=JWTToken::CreateToken($request->input('email'));
                return response()->json([
                    'status'=>'success',
                    'message'=>'Login success',
                    'token'=>$token
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>"Unauthorized"
                ]);
            }
    }

}
