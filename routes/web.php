<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::get('/social-login/{token}',function(){
    return view('welcome');
})->name('social-login');



Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!admin).*$');


Route::auth();


