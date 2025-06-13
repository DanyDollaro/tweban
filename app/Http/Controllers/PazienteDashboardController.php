<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View
use App\Models\Prenotazione; //Importa Prenotazione 
use Carbon\Carbon;
use App\Models\Notification;

class PazienteDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user(); 
    $today = Carbon::today()->toDateString();

    $stampa = Prenotazione::where('cliente_id', $user->id)
        ->where('stato', 'accettata')
        ->where('data_prenotazione', '>=', $today)
        ->orderBy('data_prenotazione', 'asc')
        ->orderBy('orario_prenotazione', 'asc')
        ->get();

    // Conteggio notifiche non lette
    $unreadCount = Notification::where('user_id', $user->id)
                               ->where('is_read', false)
                               ->count();

    return view('user_layouts.dashboard', compact('stampa', 'unreadCount')); 
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

// Per visualizzare la lista delle notifiche
public function notifications(): View
{
    $user = Auth::user();

    // Recupera tutte le notifiche dell'utente
    $notifications = Notification::where('user_id', $user->id)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    // Marca come lette tutte le notifiche non lette
    Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

    return view('user_layouts.notifiche', compact('notifications'));
}

// Per recuperare il conteggio notifiche non lette via AJAX
public function getUnreadNotificationsCount()
{
    $user = Auth::user();

    $unreadCount = Notification::where('user_id', $user->id)
                               ->where('is_read', false)
                               ->count();

    return response()->json(['unreadCount' => $unreadCount]);
}

}

