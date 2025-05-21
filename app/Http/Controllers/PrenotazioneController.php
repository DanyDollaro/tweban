<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\Prestazione;
use App\Models\Prenotazione;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrenotazioneController extends Controller
{  
    public function create(Request $request)
    {
        $searchDipartimento = $request->input('dipartimento');
        $searchPrestazione = $request->input('prestazione');

        $cleanWildcard = fn($term) => rtrim($term, '*');

        $dipartimentiQuery = Dipartimento::query();
        if ($searchDipartimento) {
            if (str_ends_with($searchDipartimento, '*')) {
                $dipartimentiQuery->where('specializzazione', 'like', $cleanWildcard($searchDipartimento) . '%');
            } else {
                $dipartimentiQuery->where('specializzazione', $searchDipartimento);
            }
        }
        $dipartimenti = $dipartimentiQuery->get();

        $prestazioniQuery = Prestazione::query();
        if ($searchPrestazione) {
            if (str_ends_with($searchPrestazione, '*')) {
                $prestazioniQuery->where('tipologia', 'like', $cleanWildcard($searchPrestazione) . '%');
            } else {
                $prestazioniQuery->where('tipologia', $searchPrestazione);
            }
        }
        if ($dipartimenti->isNotEmpty()) {
            $dipSpecializzazioni = $dipartimenti->pluck('specializzazione')->toArray();
            $prestazioniQuery->whereIn('sp_dipartimento', $dipSpecializzazioni);
        }
        $prestazioni = $prestazioniQuery->get();

        return view('user_layouts.prenotazione', compact('dipartimenti', 'prestazioni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dipartimento' => 'required|string|exists:dipartimento,specializzazione',
            'prestazione' => 'required|string|exists:prestazione,tipologia',
            'data_prenotazione' => 'required|date|after_or_equal:today',
            'orario' => 'required|date_format:H:i:s',
        ]);

        // Il giorno della prenotazione, in italiano
        $giornoPrenotazione = strtolower($this->getGiornoItaliano($request->data_prenotazione));

        if (!$giornoPrenotazione) {
            return back()->withErrors(['data_prenotazione' => 'Il giorno selezionato non è valido per la prenotazione']);
        }

        $tipologia = $request->prestazione;

        $giornoValido = DB::table('giorni_prestazioni')
            ->where('tipologia_prestazione', $tipologia)
            ->where('giorno', $giornoPrenotazione)
            ->exists();

        if (!$giornoValido) {
            return back()->withErrors(['data_prenotazione' => 'La prestazione non è disponibile nel giorno selezionato']);
        }

        $orarioValido = DB::table('orario_prestazioni')
            ->where('tipologia_prestazione', $tipologia)
            ->where('orario', $request->orario)
            ->exists();

        if (!$orarioValido) {
            return back()->withErrors(['orario' => 'L\'orario selezionato non è disponibile per la prestazione']);
        }

        Prenotazione::create([
            'user_id' => Auth::id(),
            'data_prenotazione' => $request->data_prenotazione,
            'stato' => 'Visita prenotata',
            'giorno_escluso' => null,
            'mail_staff' => null,
            'tipologia_prestazione' => $tipologia,
        ]);

        return redirect()->route('prenotazioni.create')->with('success', 'Prenotazione effettuata con successo!');
    }

    private function getGiornoItaliano($data)
    {
        $giorniSettimana = [
            'Monday' => 'lunedi',
            'Tuesday' => 'martedi',
            'Wednesday' => 'mercoledi',
            'Thursday' => 'giovedi',
            'Friday' => 'venerdi',
            'Saturday' => 'sabato',
            'Sunday' => 'domenica',
        ];

        $giornoInglese = date('l', strtotime($data));
        return $giorniSettimana[$giornoInglese] ?? null;
    }
}
