<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginStaffController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function fakeLogin(Request $request)
    {
        // Validazione base
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Credenziali "fisse"
        $correctUsername = 'a';
        $correctPassword = 'b';

        if ($request->username === $correctUsername && $request->password === $correctPassword) {
            // Login ok: salva username in sessione
            session(['username' => $request->username]);

            return view('staff');
        } else {
            // Login fallito: torna indietro con errore
            return back()->withErrors(['login' => 'Username o password non corretti'])->withInput();
        }
    }
}

