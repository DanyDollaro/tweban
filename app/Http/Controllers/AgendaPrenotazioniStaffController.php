<?php

namespace App\Http\Controllers;

use App\Models\AgendaPrenotazioni; // Modello per l'agenda (se usato per appuntamenti confermati)
use App\Models\Prenotazione;     // Modello per le richieste di prenotazione in attesa
use App\Models\Prestazione;     // Modello per i tipi di prestazione
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon; // Importa Carbon per la gestione delle date

class AgendaPrenotazioniStaffController extends Controller
{
    /**
     * Mostra la vista dell'agenda delle prenotazioni per lo staff.
     * Questa vista conterrà la tabella delle richieste in attesa.
     */
    public function index()
    {
        $prenotazioni = Prenotazione::all();
        return view('staff_layouts.agendaPrenotazioni', compact('prenotazioni'));
    }

    /**
     * RECUPERA GLI APPUNTAMENTI CONFERMATI PER L'AGENDA (se il modello AgendaPrenotazioni è per questo scopo).
     * NOTA: Questo metodo sembra essere per un'agenda di appuntamenti già confermati,
     * non per le richieste in attesa. Se la tua tabella "Richieste Appuntamenti in Attesa"
     * deve mostrare solo le richieste in attesa, il metodo rilevante è 'fetchPrenotazioni'.
     */
    public function getAppointments(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'tipologia_prestazione' => 'nullable|string',
        ]);

        $staffId = Auth::id();
        // Questo metodo filtra per 'data_prenotazione' già definita, suggerendo appuntamenti confermati.
        $query = AgendaPrenotazioni::where('data_prenotazione', $request->input('date'))
            ->where('staff_id', $staffId)
            ->with(['cliente', 'prestazione', 'staff']); // Assicurati che queste relazioni siano definite nel modello AgendaPrenotazioni

        if ($request->filled('tipologia_prestazione')) {
            $query->whereHas('prestazione', function ($q) use ($request) {
                $q->where('tipologia', $request->input('tipologia_prestazione'));
            });
        }

        $prenotazioni = $query->get();

        return response()->json($prenotazioni->map(function ($p) {
            return [
                'id' => $p->id,
                // Assicurati che getFullDateTimeAttribute() esista nel tuo modello AgendaPrenotazioni
                'orario_prenotazione' => $p->getFullDateTimeAttribute(),
                'tipologia_prestazione' => $p->prestazione->tipologia ?? 'N/A',
                'cliente_id' => $p->cliente->name ?? 'N/A', // Qui restituisci il nome del cliente
                'staff_id' => $p->staff->name ?? 'N/A',     // Qui restituisci il nome dello staff
                'stato' => $p->stato ?? 'confermato', // Lo stato predefinito potrebbe essere 'confermato'
            ];
        }));
    }

    /**
     * Accetta una richiesta di prenotazione dalla tabella 'Prenotazione'.
     * Questa funzione viene chiamata quando lo staff compila data e ora e conferma.
     */
    public function accettaPrenotazione(Request $request, $id)
    {
        $request->validate([
            'giorno_appuntamento' => 'required|date_format:Y-m-d', // Campo per la data effettiva dell'appuntamento
            'orario_appuntamento' => 'required|date_format:H:i',   // Campo per l'ora effettiva dell'appuntamento
        ]);

        $prenotazione = Prenotazione::findOrFail($id);

        // Assegna la data e l'ora effettive dell'appuntamento fornite dallo staff
        $prenotazione->data_prenotazione = $request->giorno_appuntamento;
        $prenotazione->orario_prenotazione = $request->orario_appuntamento;

        $prenotazione->stato = 'accettata'; // Cambia lo stato a 'accettata'
        $prenotazione->staff_id = Auth::id(); // Assegna lo staff che ha accettato
        $prenotazione->save();

        return response()->json(['success' => true, 'message' => 'Prenotazione accettata con successo!']);
    }

    /**
     * Rifiuta una prenotazione dalla tabella 'Prenotazione'.
     */
    /*public function rifiutaPrenotazione($id)
    {
        $prenotazione = Prenotazione::findOrFail($id);
        $prenotazione->stato = 'rifiutata'; // Cambia lo stato a 'rifiutata'
        $prenotazione->staff_id = Auth::id(); // Assegna lo staff che ha rifiutato
        $prenotazione->save();

        return response()->json(['success' => true, 'message' => 'Prenotazione rifiutata con successo.']);
    }*/

    /**
     * Aggiorna data e ora di una prenotazione dell’agenda (se il modello AgendaPrenotazioni è per questo scopo).
     * NOTA: Questo metodo sembra essere per appuntamenti già confermati, gestiti dal modello AgendaPrenotazioni.
     */
    public function updateReservationDateTime(Request $request, $id)
    {
        $request->validate([
            'data_prenotazione' => 'required|date_format:Y-m-d',
            'orario_prenotazione' => 'required|date_format:H:i',
        ]);

        $prenotazione = AgendaPrenotazioni::findOrFail($id); // Usa AgendaPrenotazioni

        if ($prenotazione->staff_id !== Auth::id()) {
            return response()->json(['message' => 'Non autorizzato.'], 403);
        }

        $prenotazione->data_prenotazione = $request->input('data_prenotazione');
        $prenotazione->orario_prenotazione = $request->input('orario_prenotazione');
        $prenotazione->save();

        return response()->json(['message' => 'Data e ora aggiornate.', 'prenotazione' => $prenotazione]);
    }

    /**
     * RECUPERA LE RICHIESTE DI PRENOTAZIONE IN ATTESA DALLA TABELLA 'Prenotazione'.
     * Questo è il metodo che popola la tua tabella "Richieste Appuntamenti in Attesa".
     */
    public function fetchPrenotazioni(Request $request)
    {
        // Carica la relazione 'cliente' per poter accedere al nome del cliente
        $query = Prenotazione::with('cliente')->where('stato', 'in_attesa'); // Filtra per stato 'in_attesa'

        if ($request->filled('date')) {
            // Se il filtro data si riferisce alla data di creazione della richiesta
            $query->whereDate('created_at', $request->input('date'));
        }

        if ($request->filled('tipologia_prestazione')) {
            $query->where('tipologia_prestazione', $request->input('tipologia_prestazione'));
        }

        $prenotazioni = $query->get();

        // Mappa i risultati per il frontend.
        // I nomi delle chiavi di questo array DEVONO corrispondere ai nomi delle proprietà 'p.nome_campo' nel tuo JavaScript.
        return response()->json($prenotazioni->map(function ($p) {
            return [
                'id' => $p->id,
                // data_prenotazione e orario_prenotazione saranno NULL per le richieste in attesa,
                // e verranno formattati come '-' dal JS.
                'data_prenotazione' => $p->data_prenotazione,
                'orario_prenotazione' => $p->orario_prenotazione,
                'giorno_escluso' => $p->giorno_escluso, // Questo campo è presente nel DB [cite: prenotazione.png]
                'cliente_id' => $p->cliente->name ?? 'Sconosciuto', // Restituisce il nome del cliente
                'staff_id' => $p->staff_id, // Restituisce l'ID dello staff
                'tipologia_prestazione' => $p->tipologia_prestazione,
                'stato' => $p->stato,
            ];
        }));
    }

}