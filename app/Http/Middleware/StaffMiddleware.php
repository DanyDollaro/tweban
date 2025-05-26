<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Gestisce una richiesta in entrata, verificando che l'utente sia dello staff.
     *
     * @param  \Closure(\Illuminate\Http\Request)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Controlla se l'utente è autenticato.
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Devi essere autenticato per accedere a questa risorsa.');
        }

        $user = Auth::user();

        // 2. Controlla che l'utente esista e che il suo ruolo sia esattamente 'staff'.
        if (is_null($user) || !isset($user->role) || $user->role !== 'staff') {
            Auth::logout(); // Disconnetti l'utente non autorizzato.
            return redirect('/login')->withErrors(['unauthorized' => 'Accesso negato: Solo lo staff può accedere a questa risorsa.']);
        }

        // Se l'utente è autenticato e il suo ruolo è 'staff', la richiesta può procedere.
        return $next($request);
    }
}
