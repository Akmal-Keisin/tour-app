<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $validatedData->errors()
            ], 400);
        }

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'status' => 200,
                'info' => 'Data Created Successfully',
                'data' => $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 400,
                'info' => 'Validation Error',
                'data' => $validatedData->errors()
            ], 400);
        }

        try {
            $category->name = $request->name;
            $category->update();

            return response()->json([
                'status' => 200,
                'info' => 'Data Created Successfully',
                'data' => $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'status' => 200,
                'info' => 'Data Deleted Successfuly'
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
