<?php

/*namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Per il tipo di ritorno

class LogoutController extends Controller
{
    
    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->invalidate(); // Invalida la sessione corrente
        // TODO: verificare che serva veramente
        $request->session()->regenerateToken(); // Rigenera il token CSRF per sicurezza

        return redirect('/'); // Reindirizza l'utente alla homepage o alla pagina di login
    }
}*/