<?php

use App\Http\Controllers\Api\V1\TextController;
use App\Http\Controllers\Api\V1\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1 as Controllers;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1'],function (){
   Route::apiResource('words', WordController::class);
   Route::apiResource('texts', TextController::class);
});

Route::prefix('/v1/auth')->name('auth.')->controller(Controllers\AuthController::class)->group(function() {

    Route::post('/register', 'register')->name('register');

    Route::post('/login', 'login')->name('login');

});

Route::prefix('/v1/words')->name('words.')->controller(Controllers\WordController::class)->group(function() {

    Route::get('/', 'index')->name('words.index');

    Route::post('/', 'store')->name('words.store')->middleware('auth:api');
});

Route::prefix('/v1/users')->name('users.')->controller(Controllers\UserController::class)->group(function() {

    Route::patch('/{id}', 'update')->name('user.update')->middleware('auth:api');
});
