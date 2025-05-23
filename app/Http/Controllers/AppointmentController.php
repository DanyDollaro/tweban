<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
     public function showForm()
    {
        return view('user_layouts.appuntamento');
    }

    public function submit(Request $request)
    {
        // Validazione dei campi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required|date',
            'department' => 'required',
            'doctor' => 'required'
        ]);

        //creare visite
        Auth::user()->visite()->create([ 'data_visita' => '2025-05-20', 'descrizione' => 'Visita di controllo']);


    

        // messaggio di conferma
        return back()->with('success', 'La tua richiesta è stata inviata con successo.');
    }
}
