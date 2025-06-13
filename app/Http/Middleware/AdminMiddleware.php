<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Devi essere autenticato per accedere a questa risorsa.');
        }

        $user = Auth::user();

        if (is_null($user) || !isset($user->ruolo) || $user->ruolo !== 'amministratore') {
            Auth::logout();
            return redirect('/login')->withErrors(['unauthorized' => 'Accesso negato']);
        }

        return $next($request);
    }
}
