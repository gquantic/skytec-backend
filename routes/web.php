<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    dd(app_config()->get('vacation_maild', 's', 'gapurovich05@mail.ru'));
});

//Route::get('/admin', 'App\Http\Controllers\Admin\AuthController@login');
Route::post('/admin/login', 'App\Http\Controllers\Admin\AuthController@processLogin')->name('platform.login.auth');
