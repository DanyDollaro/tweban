<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Visita;

class VisiteController extends Controller 
{
    protected $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new Visita;
    }

    public function storico()
    {

         // Prendi l'utente autenticato
        $user = Auth::user();

         // Prendi tutte le visite associate a quell'utente
        $visite = $this->visitaModel->where('user_id', $user->id)->get();

        // Passa i dati alla vista 'visite.storico'
        return view('user_layouts.dashboard',compact('visite'));

    }
}
