<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class TourController extends Controller
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
                $tours = Tour::where('name', 'Like', '%' . request('search') . '%');
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => $tours
                ], 200);
            } else {
                $tours = Tour::all();
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Obtained Successfully',
                'data' => (request('paginate')) ?  $tours->simplePaginate(request('paginate')) : $tours
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
            'category_id' => 'required|numeric',
            'image' => 'nullable|image',
            'information' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $validatedData->errors()
            ], 400);
        }

        try {
            $tour = new Tour();
            $tour->name = $request->name;
            $tour->category_id = $request->category_id;

            if ($request->has('image') && !is_null($request->file('image'))) {
                $tour->image = env('APP_URL') . '/' . $request->file('image')->store('image');
            } else {
                $tour->image = $request->image;
            }

            $tour->information = $request->information;
            $tour->address = $request->address;
            $tour->latitude = $request->latitude;
            $tour->longitude = $request->longitude;

            $tour->save();

            return response()->json([
                'status' => 200,
                'info' => 'Data Created Successfully',
                'data' => $tour
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
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        try {
            # code...
            if ($tour) {
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Created Successfully',
                    'data' => $tour
                ], 200);
            }
            return response()->json([
                'status' => 400,
                'info' => 'Data Not Found'
            ], 400);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin'
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required|numeric',
            'image' => 'nullable|image',
            'information' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $validatedData->errors()
            ], 400);
        }

        try {
            if ($tour) {
                $tour->name = $request->name;
                $tour->category_id = $request->category_id;

                if ($request->has('image') && !is_null($request->file('image')) && !is_null($tour->image)) {
                    $image = explode('/image/', $tour->image);
                    Storage::delete('image/' . $image[1]);
                    $tour->image = env('APP_URL') . '/' . $request->file('image')->store('image');
                } elseif (!is_null($request->image) && is_null($tour->image)) {
                    $tour->image = env('APP_URL') . '/' . $request->file('image')->store('image');
                } elseif (!is_null($tour->image) && is_null($request->image)) {
                    $image = explode('/image/', $tour->image);
                    Storage::delete('image/' . $image[1]);
                    $tour->image = $request->image;
                } else {
                    $tour->image = env('APP_URL') . '/' . $request->file('image')->store('image');
                }

                $tour->information = $request->information;
                $tour->address = $request->address;
                $tour->latitude = $request->latitude;
                $tour->longitude = $request->longitude;

                $tour->update();

                return response()->json([
                    'status' => 200,
                    'info' => 'Data Created Successfully',
                    'data' => $tour
                ], 200);
            }
            return response()->json([
                'status' => 400,
                'info' => 'Data Not Found'
            ], 400);
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
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        try {
            if ($tour) {
                if (!is_null($tour->image)) {
                    $image = explode('/image/', $tour->image);
                    Storage::delete('image/' . $image[1]);
                }
                $tour->delete();
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Deleted Successfully'
                ], 200);
            }
            return response()->json([
                'status' => 200,
                'info' => 'User Not Found'
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
