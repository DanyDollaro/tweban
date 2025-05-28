<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DipartimentoController::class,'showData']);

Route::get('/paziente/dashboard', function () {
    return view('user_layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show'); });

//modifica del profilo
Route::middleware('auth')->group(function () {
    Route::get('/profilo/modifica', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profilo', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profilo', [ProfileController::class, 'update'])->name('profile.update');


// Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show');
   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//route per il login

Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

//route prenotazioni
Route::middleware(['auth'])->group(function () {
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
});



Route::get('/admin/departments', [AdminController::class,'getDepartments']);

/*
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PrenotazioneController::class, 'storico'])->name('dashboard');
});*/

/*route per appuntamento


Route::post('/appointment', [AppointmentController::class, 'submit'])->name('appointment.submit');*/

require __DIR__.'/auth.php';
