<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function (){

    Route::middleware('guest')->group(function (){
        Route::post('register' , [\App\Http\Controllers\V1\Auth\RegisterController::class , 'register'])->name('register');
        Route::post('login' , [\App\Http\Controllers\V1\Auth\LoginController::class , 'Login'])->name('Login');
    });

    Route::resource('articles',\App\Http\Controllers\V1\Article\ArticleController::class)->except('create' , 'edit');

});
