<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\StaffDashboardController; 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Necessario per la logica nella rotta /dashboard

// Importa il controller di sessione autenticata di Breeze
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Rotta per la homepage principale del sito
Route::get('/', [DipartimentoController::class, 'showData'])->name('home');


// --- Rotta Generica /dashboard di Breeze ---
// Questa rotta serve come punto di smistamento dopo il login.
// Reindirizza l'utente alla sua dashboard specifica in base al ruolo.
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        // Chiama il metodo helper dal controller di Breeze per reindirizzare al ruolo corretto
        return (new AuthenticatedSessionController())->redirectToRoleDashboard($user);
    }
    // Se un utente non autenticato prova ad accedere a /dashboard, lo reindirizziamo al login
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- Gruppo di Rotte Protette da Autenticazione ---
// TUTTE le rotte all'interno di questo gruppo richiedono che l'utente sia loggato.
Route::middleware('auth')->group(function () {

    // --- Rotte per la Gestione del Profilo Utente ---
    // Rotte standard di Breeze per la modifica del profilo
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // La tua rotta personalizzata per la visualizzazione del profilo
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show');


    // --- Rotte per le Prenotazioni ---
    // Accessibili a qualsiasi utente autenticato.
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
    
    //Route::get('/admin/departments', [AdminController::class,'getDepartments']);

    // --- Rotte per le Dashboard Specifiche per Ruolo ---
    // Ogni gruppo è protetto dal middleware 'role' (che deve essere stato creato e registrato).
    // Queste rotte sono NELL'ULTIMO 'auth' middleware group.

    // Rotte per gli Amministratori
    Route::middleware('role:amministratore')->prefix('amministratore')->name('amministratore.')->group(function () {
        Route::get('/dashboard', function () {
            return view('amministratore.dashboard'); // Assicurati che esista in resources/views/amministratore
        })->name('dashboard');
        // Aggiungi qui altre rotte specifiche per l'amministratore
    });

    // Rotte per lo Staff
    Route::middleware(['auth', 'staff_only'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    // Reindirizza la rotta base /staff alla dashboard specifica
    Route::get('/', function() {
        return redirect()->route('staff.dashboard');
    });});

    // Rotte per i Pazienti
    Route::middleware('role:paziente')->prefix('paziente')->name('paziente.')->group(function () {
        Route::get('/dashboard', function () {
            return view('paziente.dashboard'); // Assicurati che esista in resources/views/paziente
        })->name('dashboard');
        // Aggiungi qui altre rotte specifiche per il paziente
    });
}); // Fine del gruppo Route::middleware('auth')


// --- Include le rotte di autenticazione predefinite di Breeze ---
// Questo file contiene le rotte per login, logout, registrazione, reset password, ecc.
// Non modificarlo direttamente, ma personalizza AuthenticatedSessionController per il reindirizzamento.
require __DIR__.'/auth.php';