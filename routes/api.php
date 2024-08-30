<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PesananKurirController;
use App\Http\Controllers\UpdateLocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KurirRegisterController;
use App\Http\Controllers\KurirLoginController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
Route::match(['post', 'get', 'options'], '/pesanan', [PesananController::class, 'pesanan']);
Route::post('/location', [LocationController::class, 'updateLocation']);

Route::match(['post', 'get', 'put', 'options'], '/pesanankurir', [PesananKurirController::class, 'pesanankurir']);

Route::group(['prefix' => 'api'], function () {
    Route::post('/pesanankurir', [PesananKurirController::class, 'pesanankurir']);
    Route::get('/pesanankurir', [PesananKurirController::class, 'pesanankurir']);
});
Route::post('/kurirregister', [KurirRegisterController::class, 'kurirregister']);
Route::post('/kurirlogin', [KurirLoginController::class, 'kurirlogin']);

Route::post('/updatelocation', [UpdateLocationController::class, 'updateLocation']);
