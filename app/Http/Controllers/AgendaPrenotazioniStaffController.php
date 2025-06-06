<?php

namespace App\Http\Controllers;

use App\Models\AgendaPrenotazioni; // Modello per l'agenda (se usato per appuntamenti confermati)
use App\Models\Prenotazione;       // Modello per le richieste di prenotazione in attesa
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    $prenotazione->data_prenotazione = $request->input('data_prenotazione');
    $prenotazione->orario_prenotazione = $request->input('orario_prenotazione');
    $prenotazione->stato = 'accettata';
    $prenotazione->staff_id = Auth::id();
    $prenotazione->save();

    return response()->json(['success' => true, 'message' => 'Prenotazione accettata con successo!']);
    
}


public function modifyReservationStatus(Request $request, $id)
    {
    $prenotazione = Prenotazione::findOrFail($id);

    if ($request->has('data_prenotazione')) {
        $prenotazione->data_prenotazione = $request->input('data_prenotazione');
    }

    if ($request->has('orario_prenotazione')) {
        $prenotazione->orario_prenotazione = $request->input('orario_prenotazione');
    }

    $prenotazione->save();

    return response()->json([
        'success' => true,
        'message' => 'Prenotazione modificata con successo.'
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