<?php

namespace App\Http\Controllers;

use App\Models\AgendaPrenotazioni; // Modello per l'agenda (se usato per appuntamenti confermati)
use App\Models\Prenotazione;       // Modello per le richieste di prenotazione in attesa
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaPrenotazioniStaffController extends Controller
{
    public function index()
    {
        $prenotazioni = Prenotazione::all();
        return view('staff_layouts.agendaPrenotazioni', compact('prenotazioni'));
    }

    public function getAppointments(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'tipologia_prestazione' => 'nullable|string',
        ]);

        $staffId = Auth::id();
        $query = AgendaPrenotazioni::where('data_prenotazione', $request->input('date'))
            ->where('staff_id', $staffId)
            ->with(['cliente', 'prestazione', 'staff']);

        if ($request->filled('tipologia_prestazione')) {
            $query->whereHas('prestazione', function ($q) use ($request) {
                $q->where('tipologia', $request->input('tipologia_prestazione'));
            });
        }

        $prenotazioni = $query->get();

        return response()->json($prenotazioni->map(function ($p) {
            return [
                'id' => $p->id,
                'orario_prenotazione' => $p->getFullDateTimeAttribute(),
                'tipologia_prestazione' => $p->prestazione->tipologia ?? 'N/A',
                'cliente_id' => $p->cliente->name ?? 'N/A',
                'staff_id' => $p->staff->name ?? 'N/A',
                'stato' => $p->stato ?? 'confermato',
            ];
        }));
    }

public function accettaPrenotazione(Request $request, $id)
{
    $request->validate([
        'data_prenotazione' => 'required|date_format:Y-m-d',
        'orario_prenotazione' => 'required|date_format:H:i',
    ]);

    $prenotazione = Prenotazione::findOrFail($id);

    $tipologia = $prenotazione->tipologia_prestazione;
    $data = $request->input('data_prenotazione');
    $orario = $request->input('orario_prenotazione');

    // Traduci il giorno in italiano per il controllo (lunedi, martedi, ecc.)
    $giornoItaliano = [
        'Monday' => 'Lunedi',
        'Tuesday' => 'Martedi',
        'Wednesday' => 'Mercoledi',
        'Thursday' => 'Giovedi',
        'Friday' => 'Venerdi',
        'Saturday' => 'Sabato',
        'Sunday' => 'Domenica'
    ][date('l', strtotime($data))] ?? null;

    if (!$giornoItaliano) {
        return response()->json(['error' => 'Data non valida.'], 422);
    }

    // 1) Controlla che il giorno sia abilitato per la prestazione
    $giornoValido = DB::table('giorni_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->where('giorno', $giornoItaliano)
        ->exists();

    if (!$giornoValido) {
        return response()->json(['error' => 'Il giorno selezionato non è disponibile per questa prestazione.'], 422);
    }

    // 2) Controlla che l'orario sia abilitato per la prestazione
    $orarioValido = DB::table('orario_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->where('orario', $orario)
        ->exists();

    if (!$orarioValido) {
        return response()->json(['error' => 'L\'orario selezionato non è disponibile per questa prestazione.'], 422);
    }

    // 3) Controlla che non ci sia già una prenotazione nello stesso giorno, orario, prestazione e stato accettato/confermato
    $prenotazioneEsistente = Prenotazione::where('tipologia_prestazione', $tipologia)
        ->where('data_prenotazione', $data)
        ->where('orario_prenotazione', $orario)
        ->whereIn('stato', ['accettata', 'confermata'])
        ->where('id', '!=', $prenotazione->id)
        ->exists();

    if ($prenotazioneEsistente) {
        return response()->json(['error' => 'Esiste già una prenotazione per questa prestazione, giorno e orario.'], 422);
    }

    // Aggiorna e salva
    $prenotazione->data_prenotazione = $data;
    $prenotazione->orario_prenotazione = $orario;
    $prenotazione->stato = 'accettata';
    $prenotazione->staff_id = Auth::id();
    $prenotazione->save();

    return response()->json(['success' => true, 'message' => 'Prenotazione accettata con successo!']);
}


public function modifyReservationStatus(Request $request, $id){

    $prenotazione = Prenotazione::findOrFail($id);

    $tipologia = $prenotazione->tipologia_prestazione;
    $data = $request->input('data_prenotazione') ?? $prenotazione->data_prenotazione;
    $orario = $request->input('orario_prenotazione') ?? $prenotazione->orario_prenotazione;

    // Giorno della settimana in italiano
    $giornoItaliano = [
        'Monday' => 'Lunedi',
        'Tuesday' => 'Martedi',
        'Wednesday' => 'Mercoledi',
        'Thursday' => 'Giovedi',
        'Friday' => 'Venerdi',
        'Saturday' => 'Sabato',
        'Sunday' => 'Domenica'
    ][date('l', strtotime($data))] ?? null;

    if (!$giornoItaliano) {
        return response()->json(['error' => 'Data non valida.'], 422);
    }

    //verifivica che il giorno sia abilitato per la prestazione
    $giornoValido = DB::table('giorni_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->where('giorno', $giornoItaliano)
        ->exists();

    if (!$giornoValido) {
        return response()->json(['error' => 'Il giorno selezionato non è disponibile per questa prestazione.'], 422);
    }
    //verifica che l'orario sia abilitato per la prestazione
    $orarioValido = DB::table('orario_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->where('orario', $orario)
        ->exists();
        
    if (!$orarioValido) {
        return response()->json(['error' => 'L\'orario selezionato non è disponibile per questa prestazione.'], 422);
    }
    //verifica che non ci sia già una prenotazione nello stesso giorno, orario, prestazione e stato accettato/confermato
    $prenotazioneEsistente = Prenotazione::where('tipologia_prestazione', $tipologia)
        ->where('data_prenotazione', $data)
        ->where('orario_prenotazione', $orario)
        ->whereIn('stato', ['accettata', 'confermata'])
        ->where('id', '!=', $prenotazione->id)
        ->exists();
    if ($prenotazioneEsistente) {
        return response()->json(['error' => 'Esiste già una prenotazione per questa prestazione, giorno e orario.'], 422);
    }

    // Applica le modifiche
    $prenotazione->data_prenotazione = $data;
    $prenotazione->orario_prenotazione = $orario;
    $prenotazione->staff_id = Auth::id(); // opzionale: aggiorna lo staff
    $prenotazione->save();

    return response()->json([
        'success' => true,
        'message' => 'Prenotazione modificata con successo.'
    ]);
}

public function disponibilita($id)
{
    $prenotazione = Prenotazione::findOrFail($id);
    $tipologia = $prenotazione->tipologia_prestazione;

    // Giorni disponibili
    $giorni = DB::table('giorni_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->pluck('giorno');

    // Orari disponibili
    $orari = DB::table('orario_prestazioni')
        ->where('tipologia_prestazione', $tipologia)
        ->pluck('orario');

    return response()->json([
        'giorni' => $giorni,
        'orari' => $orari,
    ]);
}

public function fetchPrenotazioni(Request $request){
        $query = AgendaPrenotazioni::with('cliente')->where('stato', 'in_attesa');

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        if ($request->filled('tipologia_prestazione')) {
            $query->where('tipologia_prestazione', $request->input('tipologia_prestazione'));
        }

        $prenotazioni = $query->get();

        return response()->json($prenotazioni->map(function ($p) {
            return [
                'id' => $p->id,
                'data_prenotazione' => $p->data_prenotazione,
                'orario_prenotazione' => $p->orario_prenotazione,
                'cliente_id' => $p->cliente->name ?? 'Sconosciuto',
                'staff_id' => $p->staff_id,
                'tipologia_prestazione' => $p->tipologia_prestazione,
                'stato' => $p->stato,
            ];
        }));
    }
    public function deleteReservation($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->delete();

        return response()->json(['success' => true, 'message' => 'Prenotazione eliminata con successo!']);
    }
}