<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MobileUserController extends Controller
{
    public function show()
    {
        try {
            $user = User::where('role_id', 2)->where('id', Auth::user()->id)->first();
            if ($user) {
                # code...
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => $user
                ], 200);
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Not Found',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!'
            ], 500);
        }
    }
    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone_number' => ['required', 'numeric', Rule::unique('users')->ignore(Auth::user()->id)],
            'password' => 'nullable',
            'password_confirm' => 'nullable|same:password',
            'image' => 'nullable|image'
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $validatedData->errors()
            ], 400);
        }
        try {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;

            if (!is_null($request->password)) {
                $user->password = Hash::make($request->password);
            }

            if ($request->has('image') && !is_null($request->file('image')) && !is_null($user->image)) {
                $image = explode('/image/', $user->image);
                Storage::delete('image/' . $image[1]);
                $user->image = env('APP_URL') . '/' . $request->file('image')->store('image');
            } elseif (!is_null($request->image) && is_null($user->image)) {
                $user->image = env('APP_URL') . '/' . $request->file('image')->store('image');
            } elseif (!is_null($user->image) && is_null($request->image)) {
                $image = explode('/image/', $user->image);
                Storage::delete('image/' . $image[1]);
                $user->image = $request->image;
            } else {
                $user->image = $request->image;
            }

            $user->update();

            return response()->json([
                'status' => 200,
                'info' => 'Data Created Successfully',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!'
            ], 500);
        }
    }
}
