<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Tour;
use Exception;
use Illuminate\Support\Facades\Log;

class MobileTourController extends Controller
{
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
            foreach ($tours as $tour) {
                $likes = Favourite::where('user_id', auth()->user()->id)->where('tour_id', $tour->id)->first();
                $tour['like'] = ($likes) ? true : false;
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

    public function show($id)
    {
        try {
            $tour = Tour::find($id);
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
    public function imgSlider()
    {
        try {

            if (request('limit')) {
                $tours = Tour::select('image')->limit(request('limit'))->get();
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => $tours
                ], 200);
            } else {
                $tours = Tour::select('image')->get();
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
}
