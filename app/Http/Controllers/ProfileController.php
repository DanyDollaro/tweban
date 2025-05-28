<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Mostra il profilo
    public function show()
    {
        $user = Auth::user();
        return view('user_layouts.profile', compact('user'));
    }

    // Mostra il form di modifica
    public function edit()
    {
        $user = Auth::user();
        return view('user_layouts.edit_profile', compact('user'));
    }

    // Aggiorna il profilo
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validazione dati 
        $validated = $request->validate([
            'nome' => 'sometimes|string',
            'cognome' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'telefono' => 'sometimes|string|unique:users,telefono,' . $user->id,
            'data_nascita' => 'sometimes|date',
            'codice_fiscale' => 'sometimes|string|unique:users,codice_fiscale,' . $user->id,
            'indirizzo' => 'sometimes|string',
        ]);

        // Aggiornamento dati
        $user->update([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'data_nascita' => $request->data_nascita,
            'codice_fiscale' => $request->codice_fiscale,
            'indirizzo' => $request->indirizzo,
        ]);

        $user->fill($validated);
        $user->save();
   
        return redirect()->route('paziente.dashboard')->with('profile_updated', true);
        
    }
}