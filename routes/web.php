<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth
// Route::middleware('guest-custom')->group(function () {
//     Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/auth/login', [AuthController::class, 'authLogin']);
// });



Route::get('/', function () {
    return redirect('/admin');
});

// Route::middleware('admin')->group(function () {
Route::view('/admin', 'admin.index');
Route::view('/user', 'user.index');
Route::view('/category', 'category.index');
Route::view('/tour', 'tour.index');
// });

Route::view('/auth/login', 'login');
