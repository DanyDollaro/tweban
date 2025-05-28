<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View

class PazienteDashboardController extends Controller
{
    public function index(): View
    {
        // Puoi aggiungere qui qualsiasi logica specifica per la dashboard dello staff,
        // come recuperare dati dal database.
        $user = Auth::user(); // Ottiene l'utente autenticato
        // Recupera le prestazioni dal database
        
        

        return view('user_layouts.dashboard', compact('user')); 
    }
}
