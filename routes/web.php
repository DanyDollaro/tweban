<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DipartimentoController;

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', [DipartimentoController::class, 'showData']);

Route::get('/admin-management', function () {
    return view('admin_layouts/admin-management');
});
