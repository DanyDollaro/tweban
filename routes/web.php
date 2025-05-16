<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/admin-management', function () {
    return view('admin_layouts/admin-management');
});
