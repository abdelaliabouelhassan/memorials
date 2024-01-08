<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProfilesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/google/callback',[LoginController::class,'handleGoogleCallback']);
Route::get('/twitter/callback',[LoginController::class,'handleTwitterCallback']);
Route::get('/facebook/callback',[LoginController::class,'handleFacebookCallback']);

Route::get('/social-login/{token}',function($token){
    return view('auth.sociallogin',compact('token'));
})->name('social-login');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth'])->name('verification.verify');


Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/auth/register',[RegisterController::class,'Register']);
Route::post('/auth/login',[LoginController::class,'Login']);
Route::post('/logout',[LoginController::class,'Logout']);
Route::get('/google/auth',[LoginController::class,'redirectToGoogle']);
Route::get('/twitter/auth',[LoginController::class,'redirectToTwitter']);
Route::get('/facebook/auth',[LoginController::class,'redirectToFacebook']);


Route::group(['middleware' => 'auth'], function () {
    // Your routes go here
    Route::get('/get-profiles', [ProfilesController::class,'getProfiles']);
    Route::post('/profile/details/{id}/store', [ProfilesController::class,'ProfileDetailsStore']);
    Route::post('/profile/details/{id}/media', [ProfilesController::class,'ProfileMediaStore']);
    Route::post('/profile/{id}/media/delete', [ProfilesController::class,'ProfileMediaDelete']);
    Route::post('/profile/{id}/access/store', [ProfilesController::class,'ProfileAccsessStore']);
    Route::get('/profile/{id}/details', [ProfilesController::class,'ProfileDetails']);
    Route::get('/profile/{id}/media', [ProfilesController::class,'ProfileMedia']);
    Route::get('/profile/{id}/comments/{status}', [ProfilesController::class,'GetProfileComments']);
    Route::post('/profile/{id}/comments/approve', [ProfilesController::class,'ApproveComment']);
    Route::post('/profile/{id}/comments/delete', [ProfilesController::class,'DeleteComment']);
    Route::post('/send-email', [RegisterController::class,'SendEmail']);
});

Route::get('/profile/{code}/show', [ProfilesController::class,'ShowProfile']);
Route::post('/profile/comment/{id}/create', [ProfilesController::class,'CreateComment']);
Route::get('/profile/{code}/comments', [ProfilesController::class,'GetComments']);


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!admin).*$');


Route::auth();




