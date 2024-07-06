<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    dd(app_config()->get('vacation_maild', 's', 'gapurovich05@mail.ru'));
});
