<?php

//namespace App\Http\Controllers;

/*use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Assicurati di importare la classe Controller base!


class LoginController extends Controller
{
    /**
     * Mostra il form di login.
     * Reindirizza gli utenti già autenticati in base al loro ruolo.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     
    public function showLoginForm()
    {
        // Logica per reindirizzare se l'utente è già autenticato
        if (Auth::check()) { // Controlla se un utente è attualmente loggato
            $user = Auth::user(); // Recupera l'oggetto utente dell'utente loggato
            switch ($user->role) { // Inizia una dichiarazione switch basata sul valore della proprietà 'role' dell'utente
                case 'amministratore':
                    return redirect()->intended('/amministratore/dashboard'); // Se il ruolo è 'amministratore', reindirizza alla dashboard admin
                case 'staff':
                    return redirect()->intended('/staff/dashboard'); // Se il ruolo è 'staff', reindirizza alla dashboard staff
                case 'paziente':
                    return redirect()->intended('/paziente/dashboard'); // Se il ruolo è 'paziente', reindirizza alla dashboard paziente
                default:
                    // Se il ruolo non è riconosciuto (o è nullo), scollega l'utente
                    Auth::logout();
                    // E reindirizza alla pagina di login con un messaggio di errore
                    return redirect('/login')->withErrors(['login' => 'Ruolo utente non valido.']);
            }
        }
        // Se l'utente NON è autenticato, mostra la view del form di login
        return view('auth.login'); // Restituisce la view 'login.blade.php' 
    }

    /**
     * Gestisce la richiesta di login.
     * Autentica l'utente e lo reindirizza in base al ruolo.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     
    public function autentich(Request $request) // Il metodo che processa i dati del form di login
    {
        // Se l'utente è già autenticato, reindirizzalo per prevenire re-login
        if (Auth::check()) { // Di nuovo, controlla se l'utente è già loggato (previene doppie sottomissioni o problemi)
            $user = Auth::user();
            switch ($user->role) { // Reindirizzamento basato sul ruolo, come nel showLoginForm
                case 'amministratore':
                    return redirect()->intended('/amministratore/dashboard');
                case 'staff':
                    return redirect()->intended('/staff/dashboard');
                case 'paziente':
                    return redirect()->intended('/paziente/dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['login' => 'Ruolo utente non valido.']);
            }
        }

        // Validazione delle credenziali (email e password)
        $credentials = $request->validate([ // Valida i dati inviati dal form ($request)
            'email' => ['required', 'email'], // Campo 'email' è obbligatorio e deve essere un formato email valido
            'password' => ['required'],       // Campo 'password' è obbligatorio
        ]);

        // Tentativo di autenticazione
        // Auth::attempt() tenta di autenticare l'utente con le credenziali fornite.
        // Il secondo parametro $request->remember è per la funzionalità "Ricordami" (se presente nel form)
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // Rigenera l'ID della sessione per prevenire attacchi di session fixation

            $user = Auth::user(); // Ottiene l'oggetto utente appena autenticato

            // Logica di reindirizzamento basata sul ruolo dell'utente
            switch ($user->role) { // Di nuovo, reindirizzamento basato sul ruolo, ma dopo l'autenticazione riuscita
                case 'amministratore':
                    return redirect()->intended('/amministratore/dashboard');
                case 'staff':
                    return redirect()->intended('/staff/dashboard');
                case 'paziente':
                    return redirect()->intended('/paziente/dashboard');
                default:
                    // Se il ruolo non è riconosciuto, scollega l'utente e reindirizza al login con errore
                    Auth::logout();
                    return redirect('/login')->withErrors(['login' => 'Ruolo utente non valido.']);
            }
        }

        // Se l'autenticazione fallisce (Auth::attempt restituisce false), torna indietro
        return back()->withErrors([ // Torna alla pagina precedente (il form di login)
            'email' => 'Le credenziali fornite non corrispondono ai nostri record.', // Aggiunge un errore specifico per l'email
        ])->onlyInput('email'); // Mantiene solo il valore dell'email nel form (non la password per sicurezza)
    }

    /**
     * Gestisce il logout dell'utente.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     
    public function logout(Request $request)
    {
        Auth::logout(); // Effettua il logout dell'utente

        $request->session()->invalidate(); // Invalida la sessione corrente

        $request->session()->regenerateToken(); // Rigenera il token CSRF per protezione

        return redirect('/'); // Reindirizza l'utente alla homepage dopo il logout
    }
}*/