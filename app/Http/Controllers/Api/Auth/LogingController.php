<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogingController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user=Auth::user();
            $success['token']=$user->createToken('My token')->plainTextToken;
            $success['name']=$user->email;

            $response=[
                'success'=>true,
                'data'=>$success,
                'message'=>'User login successfull'
            ];

            return response()->json($response);
        }else{
            $response=[
                'success'=>false,
                'message'=>'Email or Password incorrect'
            ];
            return response()->json($response);
        }
    }
}
