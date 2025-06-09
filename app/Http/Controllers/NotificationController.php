<?php

namespace App\Http\Controllers;
use App\Models\Notification; // Assicurati di importare il modello Notification
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View; // Importa la classe View
use App\Models\User; // Importa il modello User se necessario

class NotificationController extends Controller
{
    /**
     * Mostra le notifiche dell'utente autenticato.
     *
     * @return \Illuminate\View\View
     */
    public function mostraNotifiche()
    {
        $user = Auth::user(); // Ottiene l'utente autenticato
        // Recupera le notifiche non lette dell'utente, ordinate per data (opzionale)
        $notifications = $user->notifications()->get();

        return view('staff_layouts.notificheStaff', compact('notifications'));
    }

}
