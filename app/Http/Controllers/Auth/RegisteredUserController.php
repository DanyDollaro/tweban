<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'codice_fiscale' => ['required', 'string', 'size:16', 'unique:users,codice_fiscale'],
            'data_nascita' => ['required', 'date', 'before:today','after_or_equal:1900-01-01'],
            'telefono' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'indirizzo' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'username' => $request->username,
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'codice_fiscale' => $request->codice_fiscale,
            'data_nascita' => $request->data_nascita,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'indirizzo' => $request->indirizzo,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);
        session()->flash('success', 'Registrazione completata con successo!');
        return redirect(route('dashboard', absolute: false));
    }
}
