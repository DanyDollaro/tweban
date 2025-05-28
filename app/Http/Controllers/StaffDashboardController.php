<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View
use App\Models\Prestazione; 

class StaffDashboardController extends Controller
{
    /**
     * Mostra la dashboard dello staff.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Puoi aggiungere qui qualsiasi logica specifica per la dashboard dello staff,
        // come recuperare dati dal database.
        $user = Auth::user(); // Ottiene l'utente autenticato
        // Recupera le prestazioni dal database
        $rawPrestazioni = Prestazione::all();
        // Prepara la collezione per la select, aggiungendo l'opzione "Tutte le Prestazioni"
         $prestazioni_per_select = collect([
            (object)['id' => 'all', 'nome' => 'Tutte le Prestazioni']
        ])->merge($rawPrestazioni->map(function($item) {
            // Qui è FONDAMENTALE usare 'tipologia' per il value (id) e 'nome' per il testo
            // Assumendo che tu abbia una colonna 'nome' o 'descrizione' per il testo leggibile
            return (object)['id' => $item->tipologia, 'nome' => $item->nome_prestazione_leggibile ?? $item->tipologia];
            // Sostituisci 'nome_prestazione_leggibile' con il nome effettivo della colonna nel tuo DB
            // che contiene la descrizione leggibile della prestazione (es. "Visita Cardiologica")
            // Se non hai una colonna specifica per il nome leggibile, userà 'tipologia' come fallback
        }));

        return view('staff_layouts.staff', compact('user', 'prestazioni_per_select')); // Restituisce la vista staff.blade.php
    }
}
