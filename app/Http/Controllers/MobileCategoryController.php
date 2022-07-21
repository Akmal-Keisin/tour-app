<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tour;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MobileCategoryController extends Controller
{
    public function index()
    {
        try {

            if (request('search')) {
                $categories = Category::where('name', 'Like', '%' . request('search') . '%');
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => $categories
                ], 200);
            } else {
                $categories = Category::all();
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Obtained Successfully',
                'data' => (request('paginate')) ?  $categories->simplePaginate(request('paginate')) : $categories
            ], 200);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json([
                'status' => 500,
                'info' => 'Internal Server Error, please contact the admin!'
            ], 500);
        }
    }
    public function show(Category $category)
    {
        try {
            $data = Tour::with('categories')->where('category_id', $category->id);
            if ($data) {
                if (request('search')) {
                    $data->where('name', 'LIKE', '%' . request('search') . '%');
                }
                return response()->json([
                    'status' => 200,
                    'info' => 'Data Obtained Successfully',
                    'data' => (request('paginate')) ? $data->simplePaginate(request('paginate')) : $data->get()
                ], 200);
            }
            return response()->json([
                'status' => 200,
                'info' => 'Data Not Found',
                'data' => $data
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
