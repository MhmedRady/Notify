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

Route::post('users/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::group(['middleware'=>['api', 'userApiAuth:api-user']], function (){
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

Route::get('/transFile/{fileName?}', [\App\Http\Controllers\HomeController::class, 'transFile']);
