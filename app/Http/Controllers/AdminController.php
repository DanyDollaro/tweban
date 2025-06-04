<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\Prenotazione;
use App\Models\GiornoPrestazione;

class AdminController extends Controller
{
    public function getDepartmentsData()
    {
        $departments = Dipartimento::with(['prestazioni.giorni'])->get();

        $data = $departments->mapWithKeys(function ($dip) {
            return [
                $dip->specializzazione => $dip->prestazioni->map(function ($prestazione) {
                    return [
                        'tipologia' => $prestazione->tipologia,
                        'giorni' => $prestazione->giorni->pluck('giorno')->all()
                    ];
                })->all()
            ];
        });

        return view('admin-layouts.departments', compact('data'));
    }

    public function getStaffData()
    {
        return view('admin-layouts.staff');
    }

    public function getPerformancesData()
    {
        return view('admin-layouts.performances');
    }
}

