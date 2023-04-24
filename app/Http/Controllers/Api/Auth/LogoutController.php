<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        try {
            $user=auth()->user();
            $user->tokens()->delete();
            $response = [
                'success' => true,
                'message' => 'Now your are lougout to system'
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
