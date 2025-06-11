<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Prestazione;
use App\Models\AgendaPrenotazioni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffDashboardController extends Controller
{
    /**
     * Mostra la dashboard dello staff.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $user = Auth::user();

        $rawPrestazioni = Prestazione::all();

        $prestazioni_per_select = collect([
            (object)['id' => 'all', 'nome' => 'Tutte le Prestazioni']
        ])->merge(
            $rawPrestazioni->map(function ($item) {
                return (object)[
                    'id' => $item->tipologia,
                    'nome' => $item->nome_prestazione_leggibile ?? $item->tipologia
                ];
            })
        );

        $today = Carbon::today()->toDateString();

        $prenotazioni = AgendaPrenotazioni::where('data_prenotazione', $today)
            ->where('stato', '!=', 'svolta')
            ->with(['cliente', 'staff', 'prestazione'])
            ->get();

        return view('staff_layouts.staff', compact('user', 'prestazioni_per_select', 'prenotazioni'));
    }

    /**
     * Recupera le prenotazioni di oggi filtrate per tipologia via AJAX.
     *
     * @param Request $request
     * @param string $tipologia
     * @return JsonResponse
     */
    public function getAppointmentsByTipologia(Request $request, string $tipologia): JsonResponse
    {
        $today = Carbon::today()->toDateString();

        $query = AgendaPrenotazioni::where('data_prenotazione', $today)
            ->where('stato', '!=', 'svolta')
            ->with(['cliente', 'staff', 'prestazione']);

        if ($tipologia !== 'all') {
            $query->where('tipologia_prestazione', $tipologia);
        }

        $prenotazioni = $query->get();

        // Restituisci i dati in formato JSON
        return response()->json($prenotazioni);
    }
    /**
     * Mostra le prenotazioni di oggi (dashboard agenda).
     *
     * @return \Illuminate\View\View
     */
    public function showToday(): View
    {
        $today = Carbon::today()->toDateString();

        $prenotazioni = AgendaPrenotazioni::where('data_prenotazione', $today)
            ->where('stato', '!=', 'accettata')
            ->with(['cliente', 'staff', 'prestazione'])
            ->get();
            

        return view('staff_layouts.agendaPrenotazioni', compact('prenotazioni'));
    }
    
}
