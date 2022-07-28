<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Tour;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function add(Request $request)
    {
        $favourite = Favourite::where('user_id', auth()->user()->id)->where('tour_id', $request->tour_id)->first();
        if (!$favourite) {
            Favourite::create([
                'user_id' => auth()->user()->id,
                // 'user_id' => 11,
                'tour_id' => $request->tour_id
            ]);
        } else {
            $favourite->delete();
        }
        // dd($favourite);
        $tour = Tour::find($request->tour_id);
        if ($tour) {
            $tour['like'] = ($favourite) ? false : true;
            return response()->json([
                'status' => 200,
                'info' => ($favourite) ? 'Dislike Success' : 'Like Success',
                'data' => $tour
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'info' => "Data not found",
        ], 400);
    }
}
