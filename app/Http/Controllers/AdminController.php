<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
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
        $performances = Prestazione::all();
        return view('admin-layouts.performances', compact('performances'));
    }

    public function getStaffData()
    {
        return view('admin-layouts.staff');
    }
}
