<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\Prestazione;
use App\Models\Prenotazione;
use Illuminate\Support\Facades\Auth;

class PrenotazioneController extends Controller
{
    public function create(Request $request)
    {
        // Prendo tutti per dropdown
        $dipartimenti = Dipartimento::all();
        $prestazioni = Prestazione::all();

        // Prendo input ricerca testo o selezione
        $searchDipartimento = $request->input('dipartimento_text') ?? $request->input('dipartimento_select');
        $searchPrestazione = $request->input('prestazione_text') ?? $request->input('prestazione_select');

        $cleanWildcard = fn($term) => rtrim($term, '*');

        $dipartimentiQuery = Dipartimento::query();
        if ($searchDipartimento) {
            if (str_ends_with($searchDipartimento, '*')) {
                $dipartimentiQuery->where('specializzazione', 'like', $cleanWildcard($searchDipartimento) . '%');
            } else {
                $dipartimentiQuery->where('specializzazione', $searchDipartimento);
            }
        }
        $dipartimentiFiltered = $dipartimentiQuery->get();

        $prestazioniQuery = Prestazione::query();
        if ($searchPrestazione) {
            if (str_ends_with($searchPrestazione, '*')) {
                $prestazioniQuery->where('tipologia', 'like', $cleanWildcard($searchPrestazione) . '%');
            } else {
                $prestazioniQuery->where('tipologia', $searchPrestazione);
            }
        }
        if ($dipartimentiFiltered->isNotEmpty()) {
            $dipSpecializzazioni = $dipartimentiFiltered->pluck('specializzazione')->toArray();
            $prestazioniQuery->whereIn('sp_dipartimento', $dipSpecializzazioni);
        }
        $prestazioniFiltered = $prestazioniQuery->get();

        // Flag per mostrare risultati solo se l’utente ha inviato ricerca
        $ricercaEffettuata = $request->hasAny(['dipartimento_text', 'dipartimento_select', 'prestazione_text', 'prestazione_select']);

        return view('user_layouts.prenotazione', compact(
            'dipartimenti',
            'prestazioni',
            'prestazioniFiltered',
            'ricercaEffettuata'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dipartimento' => 'required|string|exists:dipartimento,specializzazione',
            'prestazione' => 'required|string|exists:prestazione,tipologia',
            'data_prenotazione' => 'nullable|date|after_or_equal:today',
            'orario' => 'nullable|date_format:H:i',
        ]);

        Prenotazione::create([
            'user_id' => Auth::id(),
            'tipologia_prestazione' => $request->prestazione,
            'stato' => 'Visita prenotata',
            'giorno_escluso' => null,
            'mail_staff' => null,
            'data_prenotazione' => $request->data_prenotazione,
            'orario' => $request->orario,
        ]);

        return redirect()->route('prenotazioni.create')->with('success', 'Prenotazione effettuata con successo!');
    }
}
