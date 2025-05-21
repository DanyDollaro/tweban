<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DipartimentoController;
/*use App\Http\Controllers\VisiteController;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;*/

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', [DipartimentoController::class, 'showData']);


/*(DANIELE)*/
Route::get('/admin-management', function () {
    return view('admin_layouts/admin-management');
});

/*(NAOMI) */
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'fakeLogin']);

/*Route::middleware(['auth'])->group(function () {
    Route::get('/staff', function () {
        return view('staff');
    })->name('staff');
});*/

/*route per il login (CLAUDIA)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//route per entrare in area riservata
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [VisiteController::class, 'storico'])->name('dashboard');
});

//route per appuntamento

use App\Http\Controllers\AppointmentController;

Route::get('/appointment', [AppointmentController::class, 'showForm'])->name('appointment.form');
Route::post('/appointment', [AppointmentController::class, 'submit'])->name('appointment.submit');*/