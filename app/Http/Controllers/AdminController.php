<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\User;
use App\Models\Prenotazione;
use App\Models\Prestazione;
use App\Models\GiornoPrestazione;

class AdminController extends Controller
{
    public function getDepartmentsData()
    {
        $departments = Dipartimento::with(['prestazioni.giorni', 'prestazioni.orari'])->get();

        $data = $departments->mapWithKeys(function ($dip) {
            return [
                $dip->specializzazione => $dip->prestazioni->map(function ($prestazione) {
                    return [
                        'tipologia' => $prestazione->tipologia,
                        'giorni' => $prestazione->giorni->pluck('giorno')->all(),
                        'orari' => $prestazione->orari->pluck('orario')->all()
                    ];
                })->all()
            ];
        });

        return view('admin-layouts.departments', compact('data'));
    }

    public function getPerformancesData()
    {
        $data = Prestazione::with('prenotazioni')->get();
        return view('admin-layouts.performances', compact('data'));
    }

    public function getStaffData()
    {
        $data = User::where('ruolo', '!=', 'paziente')->get();
        return view('admin-layouts.staff', compact('data'));
    }

    public function getAnalyticsData(Request $request)
    {
        // Make a redirection in case the url does contains the date parameters
        if (!$request->has('start_date') || !$request->has('end_date')) {
            return redirect()->route('admin.analytics', [
                'start_date' => now()->subMonth()->toDateString(),
                'end_date' => now()->toDateString(),
            ]);
        }

        $departments = Dipartimento::with(['prestazioni'])->get()->mapWithKeys(function ($dip) {
            return [
                $dip->specializzazione => $dip->prestazioni->map(function ($prestazione) {
                    return [
                        'tipologia' => $prestazione->tipologia,
                    ];
                })->all()
            ];
        });

        $startDate = $request->input('start_date', '1970-01-01');
        $endDate = $request->input('end_date', now()->toDateString());

        $data = [
            'performances' => Prestazione::all(),
            'departments' => $departments,
            'patients' => User::where('ruolo', 'paziente')->get(),
            'reservations' => Prenotazione::all(),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        return view('admin-layouts.analytics', compact('data'));
    }
}
