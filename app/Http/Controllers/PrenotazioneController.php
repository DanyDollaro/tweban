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
    $dipartimenti = Dipartimento::all();
    $prestazioni = Prestazione::all();

    //raccolgo i dati che vengono inseriti, ?? da priorità
    $searchDipartimento = $request->input('dipartimento_text') ?? $request->input('dipartimento_select');
    $searchPrestazione = $request->input('prestazione_text') ?? $request->input('prestazione_select');

    // Funzione per rimuovere asterisco 
    $cleanWildcard = fn($term) => rtrim($term, '*');

    // Controllo rigido: se in testo, NON c'è asterisco e non è esatto allora blocco risultati

    // Controllo dipartimento
    if ($request->filled('dipartimento_text')) {
        $term = $request->input('dipartimento_text');
        if (!str_ends_with($term, '*')) {
            // Cerca esatto, se non esiste blocco
            if (!Dipartimento::where('specializzazione', $term)->exists()) {
                // Non esiste, restituisco view con risultati vuoti e flag
                return view('user_layouts.prenotazione', [
                    'dipartimenti' => $dipartimenti,
                    'prestazioni' => $prestazioni,
                    'prestazioniFiltered' => collect(),
                    'ricercaEffettuata' => true,
                ]);
            }
        }
    }

    // Controllo prestazione
    if ($request->filled('prestazione_text')) {
        $term = $request->input('prestazione_text');
        if (!str_ends_with($term, '*')) {
            if (!Prestazione::where('tipologia', $term)->exists()) {
                return view('user_layouts.prenotazione', [
                    'dipartimenti' => $dipartimenti,
                    'prestazioni' => $prestazioni,
                    'prestazioniFiltered' => collect(),
                    'ricercaEffettuata' => true,
                ]);
            }
        }
    }

    // Se passo i controlli continuo con la query (come nel codice precedente)

    $dipartimentiQuery = Dipartimento::query(); //inizializzazione nuova query
    $dipartimentiFiltered = collect(); //collezione vuota

    if ($searchDipartimento !== null) {
        $isWildcard = str_ends_with($searchDipartimento, '*');
        $searchTerm = $cleanWildcard($searchDipartimento);

        if ($searchDipartimento === '') {
            // niente filtro
        } elseif ($isWildcard && strlen($searchTerm) > 0) {
            $dipartimentiQuery->where('specializzazione', 'like', $searchTerm . '%');
            $dipartimentiFiltered = $dipartimentiQuery->get();
        } elseif (!$isWildcard) {
            $dipartimentiFiltered = Dipartimento::where('specializzazione', $searchDipartimento)->get();
        }
    }

    $prestazioniQuery = Prestazione::query();

    if ($searchPrestazione !== null) {
        $isWildcard = str_ends_with($searchPrestazione, '*');
        $searchTerm = $cleanWildcard($searchPrestazione);

        if ($searchPrestazione === '') {
            // niente filtro
        } elseif ($isWildcard && strlen($searchTerm) > 0) {
            $prestazioniQuery->where('tipologia', 'like', $searchTerm . '%');
        } elseif (!$isWildcard) {
            $prestazioniQuery->where('tipologia', $searchPrestazione);
        }
    }
    //filtro per assegnare al dipartimento tutte la sue prestazioni
    if ($dipartimentiFiltered->isNotEmpty()) {
        $dipSpecializzazioni = $dipartimentiFiltered->pluck('specializzazione')->toArray();
        $prestazioniQuery->whereIn('sp_dipartimento', $dipSpecializzazioni);
    }

    $prestazioniFiltered = $prestazioniQuery->get();

    // Medici e giorni
    $medici = DB::table('medico')->get()->keyBy('prestazione_assegnata');
    $giorni_operativi = DB::table('giorni_prestazioni')->get()->groupBy('tipologia_prestazione');

    $prestazioniFiltered->transform(function ($prestazione) use ($medici, $giorni_operativi) {
        $prestazione->medico = $medici[$prestazione->tipologia] ?? null;
        $prestazione->giorni_operativi = $giorni_operativi[$prestazione->tipologia] ?? collect();
        return $prestazione;
    });

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

        $tipologia_prestazione = Prestazione::where('tipologia', $request->tipologia_prestazione)->first();

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
