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
        $departments = Dipartimento::all();
        $performance_availability = GiornoPrestazione::all();

        return view('admin-layouts.departments', compact('departments', 'performance_availability'));
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

