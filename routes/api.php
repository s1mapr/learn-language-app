<?php

use App\Http\Controllers\Api\V1 as Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/v1/auth')->name('auth.')->controller(Controllers\AuthController::class)->group(function () {

    Route::post('/register', 'register')->name('register');

    Route::post('/login', 'userLogin')->name('userLogin');

    Route::post('/admin-login', 'adminLogin')->name('adminLogin');

});

Route::prefix('/v1/words')->name('words.')->controller(Controllers\WordController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::post('/', 'store')->name('store')->middleware('auth:user');
});

Route::prefix('/v1/texts')->name('texts.')->controller(Controllers\TextController::class)->group(function () {

    Route::get('/{id}', 'show')->name('show');

});

Route::prefix('/v1/users')->name('users.')->controller(Controllers\UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('words', 'getUserWords')->name('getUserWords')->middleware('auth:user');
    Route::patch('/{id}', 'update')->name('update')->middleware(['auth:user,admin']);
    Route::get('/collections', 'userCollections')->name('userCollections')->middleware('auth:user');
    Route::post('/startCollection/{collectionId}', 'startCollection')->name('startCollection')->middleware(['auth:user']);
});

Route::prefix('/v1/collections')->name('collection.')->controller(Controllers\WordCollectionController::class)->group(function () {

    Route::post('/', 'store')->name('store');
    Route::post('/{id}/comment', 'createComment')->name('comment');
    Route::get('/', 'index')->name('index');
    Route::get('/requests', 'getRequestsForPublish')->name('getRequestsForPublish');
    Route::get('/public', 'getPublicCollections')->name('getPublicCollections')->middleware('auth:user');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:user');
    Route::get('/{id}/quiz', 'getQuizForCollection')->name('getQuizForCollection');
    Route::patch('/changeStatus/{id}', 'changeStatusOfCollection')->name('changeStatusOfCollection');
});
