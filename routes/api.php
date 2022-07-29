<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileCategoryController;
use App\Http\Controllers\MobileTourController;
use App\Http\Controllers\MobileUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BulkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\TourController;
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
Route::post('auth-admin', [AuthController::class, 'authAdminLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tour-list', [MobileTourController::class, 'index']);
    Route::get('tour-detail/{id}', [MobileTourController::class, 'show']);
    Route::get('tour-img-slider', [MobileTourController::class, 'imgSlider']);

    Route::get('category-list', [MobileCategoryController::class, 'index']);
    Route::get('category-detail/{id}', [MobileCategoryController::class, 'show']);

    Route::get('user-profile', [MobileUserController::class, 'show']);
    Route::put('user-edit', [MobileUserController::class, 'update']);
    Route::post('add-favourite', [FavouriteController::class, 'add']);


    Route::post('auth-logout', [AuthController::class, 'authUserLogout']);
});

Route::group(['middleware' => 'admin'], function () {
    // Admin
    Route::resource('user', UserController::class)->except(['create', 'edit']);
    Route::resource('admin', AdminController::class)->except(['create', 'edit']);
    Route::resource('category', CategoryController::class)->except(['create', 'edit']);
    Route::resource('tour', TourController::class)->except(['create', 'edit']);

    // Bulk delete
    Route::post('bulk-admin', [BulkController::class, 'admin']);
    Route::post('bulk-user', [BulkController::class, 'user']);
    Route::post('bulk-category', [BulkController::class, 'category']);
    Route::post('bulk-tour', [BulkController::class, 'tour']);

    Route::post('auth-admin-logout', [AuthController::class, 'authAdminLoout']);
});
