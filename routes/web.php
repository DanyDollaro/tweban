<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DipartimentoController::class,'showData']);
Route::get('/dashboard', function () {
    return view('breezedashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show'); });

//modifica del profilo
Route::middleware('auth')->group(function () {
    Route::get('/profilo/modifica', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profilo', [ProfileController::class, 'update'])->name('profile.update');

// Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show');
   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
<<<<<<< HEAD

=======
>>>>>>> c275b4c117fc33c6c7a1f4097cbba9a62cbe064e

//route per il login

Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

//route prenotazioni
Route::middleware(['auth'])->group(function () {
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
});


/*
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PrenotazioneController::class, 'storico'])->name('dashboard');
});*/

/*route per appuntamento

use App\Http\Controllers\AppointmentController;

Route::get('/appointment', [AppointmentController::class, 'showForm'])->name('appointment.form');
Route::post('/appointment', [AppointmentController::class, 'submit'])->name('appointment.submit');*/

<<<<<<< HEAD
=======
//route per modificare il profilo

/*Route::middleware('auth')->group(function () {
    Route::get('/profilo/modifica', [EditProfileController::class, 'edit'])->name('profilo.edit');
    Route::post('/profilo/modifica', [EditProfileController::class, 'update'])->name('profilo.update');
});*/

/*prenotazione
    Route::middleware(['auth'])->group(function () {
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
});*/

>>>>>>> c275b4c117fc33c6c7a1f4097cbba9a62cbe064e
require __DIR__.'/auth.php';
