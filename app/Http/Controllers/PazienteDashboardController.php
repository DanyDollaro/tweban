<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View
use App\Models\Prenotazione; //Importa Prenotazione 
use Carbon\Carbon;

class PazienteDashboardController extends Controller
{
    public function index(): View
    {
        // Puoi aggiungere qui qualsiasi logica specifica per la dashboard del paziente,
        // come recuperare dati dal database.
        $user = Auth::user(); // Ottiene l'utente autenticato
        // Recupera le prestazioni dal database
        
    $today = Carbon::today()->toDateString();

    $stampa = Prenotazione::where('cliente_id', Auth::id())  // solo le prenotazioni dell'utente loggato
        ->where('stato', 'accettata')  // stato accettato
        ->where('data_prenotazione', '>=', $today)  // data prenotazione >= oggi
        ->orderBy('data_prenotazione', 'asc')
        ->orderBy('orario_prenotazione', 'asc')
        ->get();


        return view('user_layouts.dashboard', compact('stampa')); 
    }

 public function storico(): View
    {
        
    $today = Carbon::today()->toDateString();

    $passate = Prenotazione::where('cliente_id', Auth::id())  // solo le prenotazioni dell'utente loggato
        ->where('stato', 'accettata')  // stato accettato
        ->where('data_prenotazione', '<', $today)  // data prenotazione >= oggi
        ->orderBy('data_prenotazione', 'desc')
        ->orderBy('orario_prenotazione', 'desc')
        ->get();

        return view('user_layouts.storico', compact('passate')); 
    }



    public function destroy($id)
{
    $prenotazione = Prenotazione::where('id', $id)
        ->where('cliente_id', Auth::id())
        ->first();

    if (!$prenotazione) {
        return response()->json(['error' => 'Prenotazione non trovata o non autorizzato.'], 404);
    }

    $prenotazione->delete();

    return response()->json(['success' => 'Prenotazione eliminata con successo.']);
}

}
