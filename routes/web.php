<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Importa il controller di sessione autenticata di Breeze
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Necessario per la logica nella rotta /dashboard

Route::get('/', [DipartimentoController::class,'showData'])->name('home');;

Route::get('/dashboard_paziente', function () {
    return view('breezedashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show'); 
});

//modifica del profilo
Route::middleware('auth')->group(function () {
    Route::get('/profilo/modifica', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profilo', [ProfileController::class, 'update'])->name('profile.update');
});

//route per la registrazione
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

//route prenotazioni
Route::middleware(['auth'])->group(function () {
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
});

Route::get('/dashboard_amministratore', [AdminController::class,'getDepartments']);

require __DIR__.'/auth.php';
