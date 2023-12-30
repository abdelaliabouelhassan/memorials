<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/register',[RegisterController::class,'Register']);
Route::post('/login',[LoginController::class,'Login']);
Route::post('/logout',[LoginController::class,'Logout']);
Route::get('/google/auth',[LoginController::class,'redirectToGoogle']);
Route::get('/twitter/auth',[LoginController::class,'redirectToTwitter']);
Route::get('/facebook/auth',[LoginController::class,'redirectToFacebook']);