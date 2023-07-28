<?php

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

Route::group(['prefix'=>'v1'], function() {

    Route::group(['prefix' =>'user'], function () {
        Route::post('create', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
        Route::get('config',[\App\Http\Controllers\UserConfigController::class, 'getUserConfigDefault'])
        ->middleware('auth:api');
    });

    Route::delete('access/token/{tokenId}',[\App\Http\Controllers\Auth\LogoutController::class, 'logout'])
    ->middleware('auth:api');

});
