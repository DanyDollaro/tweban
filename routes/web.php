<?php

use App\Http\Controllers\AgendaPrenotazioniStaffController;
use App\Http\Controllers\AgendaStaffController;
use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrenotazioneController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Necessario per la logica nella rotta /dashboard
use App\Http\Controllers\NotificationController; // Importa il controller delle notifiche

// Importa il controller di sessione autenticata di Breeze
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PazienteDashboardController;

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
    Route::get('/profilo/modifica', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profilo', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profilo', [ProfileController::class, 'update'])->name('profile.update');


    // La tua rotta personalizzata per la visualizzazione del profilo
    Route::get('/profilo', [ProfileController::class, 'show'])->name('profile.show');


    // --- Rotte per le Prenotazioni ---
    // Accessibili a qualsiasi utente autenticato.
    Route::get('/prenotazioni', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');


    // --- Rotte per le Dashboard Specifiche per Ruolo ---
    // Ogni gruppo è protetto dal middleware 'ruolo' (che deve essere stato creato e registrato).
    // Queste rotte sono NELL'ULTIMO 'auth' middleware group.

    // Rotte per gli Amministratori
    Route::middleware(['auth', 'admin_only'])->prefix('amministratore')->name('amministratore.')->group(function () {
        Route::get('/admin', [AdminController::class, 'getDepartmentsData'])->name('admin');
    });

    // Rotte per lo Staff
    Route::middleware(['auth', 'staff_only'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    // Stampa prestazione
    Route::get('/stampa-prestazione/{id}', [AgendaPrenotazioniStaffController::class, 'stampa'])->name('stampa-prestazione');
    // Prenotazioni di oggi per tipologia
    Route::get('/prenotazioni-oggi/{tipologia}', [StaffDashboardController::class, 'getAppointmentsByTipologia'])->name('prenotazioni.oggi');
    Route::get('/staff/agenda-prestazioni', [AgendaPrenotazioniStaffController::class, 'index'])->name('agenda');
    // Accetta una prenotazione (POST)
    Route::post('/prenotazioni/{id}/accetta', [AgendaPrenotazioniStaffController::class, 'accettaPrenotazione'])->name('prenotazioni.accetta');
    // Modifica lo stato di una prenotazione (POST)
    Route::post('/prenotazioni/{id}/modifica', [AgendaPrenotazioniStaffController::class, 'modifyReservationStatus'])->name('prenotazioni.modifica');
    // Route per il bottone elimina
    Route::post('/prenotazioni/{id}/elimina', [AgendaPrenotazioniStaffController::class, 'deleteReservation'])->name('prenotazioni.elimina');
    // Route per ottenere giorni e orari disponibili per una prestazione
    Route::get('/prenotazioni/{id}/disponibilita', [AgendaPrenotazioniStaffController::class, 'getDisponibilita'])->name('prenotazioni.disponibilita');
    //route per le notifiche
});

 // Rotte per i Pazienti
    Route::middleware(['auth', 'paziente_only'])->prefix('paziente')->name('paziente.')->group(function () {
        Route::get('/dashboard', [PazienteDashboardController::class, 'index'])->name('dashboard');
        Route::delete('/prenotazioni/{id}', [PazienteDashboardController::class, 'destroy'])->name('prenotazioni.destroy');
        Route::get('/storico', [PazienteDashboardController::class, 'storico'])->name('prenotazioni.passate');


        Route::get('/notifiche', [PazienteDashboardController::class, 'notifications'])->name('messaggi');
        Route::get('/notifiche/count', [PazienteDashboardController::class, 'getUnreadNotificationsCount']);


    });

}); // Fine del gruppo Route::middleware('auth')

Route::get('/admin/dipartimenti', [AdminController::class, 'getDepartmentsData'])->name('admin.departments');
Route::get('/admin/prestazioni', [AdminController::class, 'getPerformancesData'])->name('admin.performances');
Route::get('/admin/personale', [AdminController::class, 'getStaffData'])->name('admin.staff');
Route::get('/admin/analytics', [AdminController::class, 'getAnalyticsData'])->name('admin.analytics');
/// Richieste post
// Prestazioni
Route::post('/admin/prestazioni/update', [AdminController::class, 'updateReservation'])->name('admin.updateReservation');
// Personale
Route::post('/admin/personale/action', [AdminController::class, 'dispatchStaffAction'])->name('admin.staffAction');
// Dipartimenti
Route::post('/admin/dipartimenti/action', [AdminController::class, 'dispatchDepartmentAction'])->name('admin.departmentAction');

// --- Include le rotte di autenticazione predefinite di Breeze ---
// Questo file contiene le rotte per login, logout, registrazione, reset password, ecc.
// Non modificarlo direttamente, ma personalizza AuthenticatedSessionController per il reindirizzamento.
require __DIR__.'/auth.php';

//commento per commit
