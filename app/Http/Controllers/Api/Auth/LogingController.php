<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Http\Resources\HospitalResource;
use App\Http\Resources\RoleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogingController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('My token')->plainTextToken;
                $success['name'] = $user->email;
                $success['hospital'] = new HospitalResource($user->hospital);
                $success['role'] = new RoleResource($user->role);
                $success['branch'] = new BranchResource($user->branch);
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => 'User login successfull'
                ];

                return response()->json($response);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Email or Password incorrect'
                ];
                return response()->json($response);
            }
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
