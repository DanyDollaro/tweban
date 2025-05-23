<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Prenotazione;

class PrenotazioneController extends Controller 
{
    protected $visitaModel;

    public function __construct()
    {
        $this->visitaModel = new Prenotazione;
    }

    public function storico()
    {

        return view('user_layouts.dashboard');

    }
}
