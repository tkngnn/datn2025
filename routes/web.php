<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});
Route::get('/user', function () {
    return view('user.index');
});
