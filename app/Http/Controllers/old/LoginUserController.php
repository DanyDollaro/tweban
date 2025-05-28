<?php
/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function showLoginForm()
    {
        return view('user_layouts.login');
    }

    public function login(Request $request)
    {
        // Validazione dati
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Prova ad autenticare
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();  // Protezione sessione

            return redirect()->intended('dashboard'); // o altra rotta dopo login
        }

        // Se fallisce torna indietro con errore
        //return back()->withErrors([
            //'email' => 'Le credenziali non sono corrette.',
        //])->onlyInput('email');
   }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}*/
