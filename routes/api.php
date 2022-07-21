<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileCategoryController;
use App\Http\Controllers\MobileTourController;
use App\Http\Controllers\MobileUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// User
Route::post('auth-login', [AuthController::class, 'authUserLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tour-list', [MobileTourController::class, 'index']);
    Route::get('tour-detail/{id}', [MobileTourController::class, 'show']);
    Route::get('tour-img-slider', [MobileTourController::class, 'imgSlider']);

    Route::get('category-list', [MobileCategoryController::class, 'index']);
    Route::get('category-detail/{id}', [MobileCategoryController::class, 'show']);

    Route::get('user-profile', [MobileUserController::class, 'show']);
    Route::put('user-edit', [MobileUserController::class, 'update']);

    Route::post('auth-logout', [AuthController::class, 'authUserLogout']);
});
