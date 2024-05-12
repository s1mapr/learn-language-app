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

    Route::get('/', 'getAllWords')->name('getAllWords');

});


Route::prefix('/v1/users')->name('users.')->controller(Controllers\UserController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/words', 'getUserWords')->name('getUserWords')->middleware('auth:user');
    Route::get('/collections', 'userCollections')->name('userCollections')->middleware('auth:user');
    Route::get('/{id}', 'getUserById')->name('getUserById');
    Route::patch('/{id}', 'update')->name('update')->middleware(['auth:user,admin']);
    Route::patch('/{id}/blockOrUnblock', 'blockOrUnblockUser')->name('blockOrUnblockUser');
    Route::patch('/like/{id}', 'likeOrUnlikeCollection')->name('likeOrUnlikeCollection');
    Route::post('/startCollection/{collectionId}', 'startCollection')->name('startCollection')->middleware(['auth:user']);
});

Route::prefix('/v1/collections')->name('collection.')->controller(Controllers\WordCollectionController::class)->group(function () {

    Route::post('/', 'store')->name('store')->middleware(['auth:user']);
    Route::post('/{id}/comment', 'createComment')->name('comment')->middleware(['auth:user']);
    Route::get('/', 'getAllWordCollections')->name('getAllWordCollections');
    Route::get('/requests', 'getRequestsForPublish')->name('getRequestsForPublish');
    Route::get('/public', 'getPublicCollections')->name('getPublicCollections')->middleware('auth:user');
    Route::get('/public/search', 'searchPublicCollections')->name('searchPublicCollections')->middleware('auth:user');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:user');
    Route::get('/{id}/text', 'getTextForCollection')->name('getTextForCollection')->middleware('auth:user');
    Route::get('/{id}/quiz', 'getQuizForCollection')->name('getQuizForCollection');
    Route::get('/{id}/flashCards', 'getFlashCardsForCollection')->name('getFlashCardsForCollection');
    Route::patch('/{id}', 'changeCollection')->name('changeCollection');
});
