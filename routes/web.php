<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'guest'],function(){
Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('throttle:2,1');
Route::post('user_login', [AuthController::class, 'user_login']);
Route::get('register', [AuthController::class, 'register_view'])->name('register');
Route::post('user_reg', [AuthController::class, 'user_reg']);
});



Route::group(['middleware'=>'auth'],function(){
Route::get('home',[AuthController::class, 'home'])->name('home');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');
});

