<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authAdminLogin(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'phone_number' => 'required|numeric|max:255',
            'password' => 'required'
        ]);

        if ($credentials->fails()) {
            return response()->json([
                'status' => '400',
                'info' => 'Login Failed',
                'data' => $credentials->errors()
            ], 400);
        }

        try {
            if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password, 'role_id' => 1])) {
                return response()->json([
                    'status' => 200,
                    'info' => 'Login Success',
                    'data' => 'success'
                ], 200);
            }
            return response()->json([
                'status' => 400,
                'info' => 'Login Failed',
                'data' => 'Phone Number or password incorrect'
            ], 400);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!',
            ], 500);
        }
    }

    public function authAdminLogout()
    {
    }

    public function authUserLogin(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'phone_number' => 'required|numeric',
            'password' => 'required'
        ]);

        if ($credentials->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $credentials->errors()
            ], 400);
        }

        try {
            if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password, 'role_id' => 2])) {
                $token = $request->user()->createToken('sanctum_token');
                return response()->json([
                    'status' => 200,
                    'info' => 'Login Success',
                    'token' => $token->plainTextToken,
                    'data' => 'success'
                ], 200);
            }
            return response()->json([
                'status' => 400,
                'info' => 'Login Failed',
                'data' => 'Phone Number or password incorrect'
            ], 400);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!'
            ], 500);
        }
    }

    public function authUserLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'info' => 'Logout Success'
        ], 200);
    }
}
