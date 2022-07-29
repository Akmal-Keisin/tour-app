<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulkController extends Controller
{
    public function admin(Request $request)
    {
        $admins = User::where('role_id', 1)->whereIn('id', $request->id);
        if ($admins) {
            $admins->delete();
            return response()->json([
                'status' => 200,
                'info' => 'Data Deleted Successfully'
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'info' => 'Data Not Found'
        ], 400);
    }

    public function user(Request $request)
    {
        $users = User::where('role_id', 2)->whereIn('id', $request->id);
        if ($users) {
            $users->delete();
            return response()->json([
                'status' => 200,
                'info' => 'Data Deleted Successfully'
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'info' => 'Data Not Found'
        ], 400);
    }
    public function category(Request $request)
    {
        $categories = Category::whereIn('id', $request->id);
        Tour::where('category_id', $request->id)->delete();
        if ($categories) {
            $categories->delete();
            return response()->json([
                'status' => 200,
                'info' => 'Data Deleted Successfully'
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'info' => 'Data Not Found'
        ], 400);
    }

    public function tour(Request $request)
    {
        // Delete like
        $tours = Tour::whereIn('id', $request->id);
        if ($tours) {
            $likes = Favourite::whereIn('tour_id', $request->id);
            if ($likes) {
                $likes->delete();
            }
            foreach ($tours as $tour) {
                if ($tour->image !== null) {
                    $image = explode('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/', $tour->image);
                    Storage::delete($image);
                }
            }
            $tours->delete();
            return response()->json([
                'status' => 200,
                'info' => 'Data Deleted Successfully'
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'info' => 'Success'
        ], 400);
    }
}
