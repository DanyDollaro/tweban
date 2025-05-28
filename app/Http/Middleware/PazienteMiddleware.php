<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PazienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // 1. Controlla se l'utente è autenticato.
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Devi essere autenticato per accedere a questa risorsa.');
        }

        $user = Auth::user();

        // 2. Controlla che l'utente esista e che il suo ruolo sia esattamente 'paziente'.
        if (is_null($user) || !isset($user->ruolo) || $user->ruolo !== 'paziente') {
            Auth::logout(); // Disconnetti l'utente non autorizzato.
            return redirect('/login')->withErrors(['unauthorized' => 'Accesso negato: Solo il paziente può accedere a questa risorsa.']);
        }

        // Se l'utente è autenticato e il suo ruolo è 'staff', la richiesta può procedere.
        return $next($request);
    }
}
