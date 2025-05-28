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
        // Prendo tutti 
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

        // Recupera tutti i medici e i giorni in cui la prestazione è disponibile
        $medici = DB::table('medico')->get()->keyBy('prestazione_assegnata');
        $giorni_operativi = DB::table('giorni_prestazioni')->get()->groupBy('tipologia_prestazione');
          
        
        $prestazioniFiltered->transform(function ($prestazione) use ($medici, $giorni_operativi) {
        $prestazione->medico = $medici[$prestazione->tipologia] ?? null;
        $prestazione->giorni_operativi = $giorni_operativi[$prestazione->tipologia] ?? collect();
        return $prestazione;
        });

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
           
            'tipologia_prestazione' => 'required|string|exists:prestazione,tipologia',
            
        ]);

        $tipologia_prestazione = Prestazione::where('tipologia', $request->tipologia_prestazione);

        //salva prenotazione 
        Prenotazione::create([
            'cliente_id' => Auth::id(),
            'tipologia_prestazione' => $request->tipologia_prestazione,
            'giorno_escluso' => null,
            'staff_id' =>$tipologia_prestazione->staff_id,
        ]);

        return redirect()->route('prenotazioni.create')->with('success', 'Prenotazione effettuata con successo!');
    }
}
