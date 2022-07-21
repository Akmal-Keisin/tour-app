<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if (request('search')) {
                $users = User::where('name', 'Like', '%' . request('search') . '%')
                    ->where('role_id', 2);
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => $users
                ], 200);
            } else {
                $users = User::where('role_id', 2);
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Obtained Successfully',
                'data' => (request('paginate')) ?  $users->simplePaginate(request('paginate')) : $users->get()
            ], 200);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!'
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
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
            $user = new User();
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);

            if ($request->has('image') && !is_null($request->file('image'))) {
                $user->image = env('APP_URL') . '/' . $request->file('image')->store('image');
            } else {
                $user->image = $request->image;
            }

            $user->save();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::where('role_id', 2)->where('id', $id)->first();
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone_number' => ['required', 'numeric', Rule::unique('users')->ignore($id)],
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
            $user = User::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                if (!is_null($user->image)) {
                    $image = explode('/image/', $user->image);
                    Storage::delete('image/' . $image[1]);
                }
                $user->delete();
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Deleted Successfully'
                ], 200);
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Not Found'
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
