<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Breeze usa un Form Request per la validazione
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la facade Auth
use Illuminate\View\View;
use App\Models\User; // Importa il modello User

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostra il form di login.
     * Reindirizza gli utenti già autenticati in base al loro ruolo.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        // Logica per reindirizzare se l'utente è già autenticato
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectToRoleDashboard($user); // Usa una funzione helper per la logica di reindirizzamento
        }

        // Se l'utente NON è autenticato, mostra la view del form di login
        return view('auth.login'); // Mantieni la vista di Breeze che stiamo personalizzando
    }

    /**
     * Gestisce la richiesta di login.
     * Autentica l'utente e lo reindirizza in base al ruolo.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Se l'utente è già autenticato, reindirizzalo per prevenire re-login
        if (Auth::check()) {
            $user = Auth::user();
            return $this->redirectToRoleDashboard($user);
        }

        // Il LoginRequest di Breeze gestisce già la validazione e Auth::attempt()
        try {
            $request->authenticate(); // Questo metodo lancia un'eccezione se l'autenticazione fallisce
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Se l'autenticazione fallisce (ad esempio, credenziali non valide),
            // la validazione del Form Request gestirà già il ritorno indietro con gli errori.
            throw $e;
        }

        $request->session()->regenerate(); // Rigenera l'ID della sessione per prevenire attacchi di session fixation

        $user = Auth::user(); // Ottiene l'oggetto utente appena autenticato

        // Logica di reindirizzamento basata sul ruolo dell'utente
        return $this->redirectToRoleDashboard($user); // Usa la funzione helper
    }

    /**
     * Gestisce il logout dell'utente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Breeze usa guard 'web'

        $request->session()->invalidate(); // Invalida la sessione corrente

        $request->session()->regenerateToken(); // Rigenera il token CSRF per protezione

        return redirect('/'); // Reindirizza l'utente alla homepage dopo il logout
    }

    /**
     * Funzione helper per reindirizzare in base al ruolo dell'utente.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRoleDashboard($user): RedirectResponse
    {
        
        switch ($user->ruolo) {
            case 'amministratore':
                return redirect()->intended('/dashboard_amministratore');
            
            case 'staff':
                return redirect()->intended('/dashboard_staff');
            
            case 'paziente':
                return redirect()->intended('/dashboard_paziente');
            default:
                // Se il ruolo non è riconosciuto, scollega l'utente e reindirizza al login con errore
                Auth::logout();
                return redirect('/login')->withErrors(['login' => 'Ruolo utente non valido.']);
        }
    }
}
