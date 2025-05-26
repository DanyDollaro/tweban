<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View

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

        return view('staff_layouts.staff', compact('user')); // Restituisce la vista staff.blade.php
    }
}