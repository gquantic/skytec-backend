<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
    Route::get('/', 'App\Http\Controllers\Api\User\UserController@data')->middleware('auth:sanctum');
    Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
    Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
});

Route::middleware('auth:sanctum')->group(function () {

});

Route::middleware(\App\Http\Middleware\ApiAccessToken::class)->group(function () {
    Route::resource('news', 'App\Http\Controllers\Api\Content\NewsController');
    Route::get('emoji', 'App\Http\Controllers\Api\Content\EmojiController@index');

    Route::resource('news/comments', 'App\Http\Controllers\Api\Content\NewsCommentController');
});
