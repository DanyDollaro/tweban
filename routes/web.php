<?php

use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth; // Necessario per la logica nella rotta /dashboard

// Importa il controller di sessione autenticata di Breeze
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PazienteDashboardController;

// Rotta per la homepage principale del sito
Route::get('/', [DipartimentoController::class, 'showData'])->name('home');


Route::get('/', [DipartimentoController::class,'showData']);
Route::get('/dashboard', function () {
    return view('breezedashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show'); });


    // --- Rotte per la Gestione del Profilo Utente ---
    // Rotte standard di Breeze per la modifica del profilo
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



    // --- Rotte per le Dashboard Specifiche per Ruolo ---
    // Ogni gruppo è protetto dal middleware 'ruolo' (che deve essere stato creato e registrato).
    // Queste rotte sono NELL'ULTIMO 'auth' middleware group.

    // Rotte per gli Amministratori
    Route::middleware('ruolo:amministratore')->prefix('amministratore')->name('amministratore.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin-layouts.departments'); // Assicurati che esista in resources/views/amministratore
        })->name('dashboard');
        // Aggiungi qui altre rotte specifiche per l'amministratore
    });

    // Rotte per lo Staff
    Route::middleware(['auth', 'staff_only'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        // Reindirizza la rotta base /staff alla dashboard specifica
        Route::get('/', function() {
            return redirect()->route('staff_layouts.staff');
        });
    });

    // Rotte per i Pazienti
    Route::middleware(['auth', 'paziente_only'])->prefix('paziente')->name('paziente.')->group(function () {
        Route::get('/dashboard', [PazienteDashboardController::class, 'index'])->name('dashboard');
    });
}); // Fine del gruppo Route::middleware('auth')


Route::get('/appointment', [AppointmentController::class, 'showForm'])->name('appointment.form');
Route::post('/appointment', [AppointmentController::class, 'submit'])->name('appointment.submit');*/

require __DIR__.'/auth.php';
