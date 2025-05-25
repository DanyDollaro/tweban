<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DipartimentoController::class,'showData']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route per il login

Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

//route per entrare in area riservata
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PrenotazioneController::class, 'storico'])->name('dashboard');
});

//route per appuntamento

use App\Http\Controllers\AppointmentController;

Route::get('/appointment', [AppointmentController::class, 'showForm'])->name('appointment.form');
Route::post('/appointment', [AppointmentController::class, 'submit'])->name('appointment.submit');

//route per modificare il profilo

/*Route::middleware('auth')->group(function () {
    Route::get('/profilo/modifica', [EditProfileController::class, 'edit'])->name('profilo.edit');
    Route::post('/profilo/modifica', [EditProfileController::class, 'update'])->name('profilo.update');
});*/

require __DIR__.'/auth.php';