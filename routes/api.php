<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProfilesController;
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


Route::group(['middleware' => 'auth:sanctum'], function () {
    // Your routes go here
    Route::get('/get-profiles', [ProfilesController::class,'getProfiles']);
    Route::post('/profile/details/{id}/store', [ProfilesController::class,'ProfileDetailsStore']);
    Route::post('/profile/details/{id}/media', [ProfilesController::class,'ProfileMediaStore']);
    Route::post('/profile/{id}/media/delete', [ProfilesController::class,'ProfileMediaDelete']);
    Route::post('/profile/{id}/access/store', [ProfilesController::class,'ProfileAccsessStore']);
    Route::get('/profile/{id}/details', [ProfilesController::class,'ProfileDetails']);
    Route::get('/profile/{id}/media', [ProfilesController::class,'ProfileMedia']);
});

Route::get('/profile/{code}/show', [ProfilesController::class,'ShowProfile']);
Route::post('/profile/comment/{id}/create', [ProfilesController::class,'CreateComment']);
Route::get('/profile/{code}/comments', [ProfilesController::class,'GetComments']);