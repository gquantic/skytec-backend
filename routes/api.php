<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::get('/', 'App\Http\Controllers\Api\User\UserController@data')->middleware('auth:sanctum');
    Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
    Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::put('/user', 'App\Http\Controllers\Api\User\UserController@update');

    Route::prefix('birthdays')->group(function () {
        Route::get('/', 'App\Http\Controllers\Api\User\UserBirthdayController@index');
    });

    Route::prefix('user')->group(function () {
        Route::get('articles', 'App\Http\Controllers\Api\User\UserController@articles');
    });


    Route::get('application', 'App\Http\Controllers\Api\Applications\ApplicationController@index');

    Route::resources([
        'news/comments' => 'App\Http\Controllers\Api\Content\NewsCommentController',
        'news' => 'App\Http\Controllers\Api\Content\NewsController',
        'articles/categories' => 'App\Http\Controllers\Api\Article\ArticleCategoryController',
    ]);

    Route::get('emoji', 'App\Http\Controllers\Api\Content\EmojiController@index');

    Route::resources([
        'education' => \App\Http\Controllers\Api\EducationController::class,
        'articles' => App\Http\Controllers\Api\Article\ArticleController::class,
    ]);

    Route::prefix('application')->group(function () {
        Route::resources([
            'business-trip' => \App\Http\Controllers\Api\Applications\BusinessTripApplicationController::class,
            'vacation' => \App\Http\Controllers\Api\Applications\VacationApplicationController::class,
            'education' => \App\Http\Controllers\Api\Applications\EducationApplicationController::class,
        ]);
    });
});
