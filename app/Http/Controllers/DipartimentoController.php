<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\Prestazione;
use Illuminate\Support\Facades\DB;

class DipartimentoController extends Controller
{
    public function showDepartments(){
        return Dipartimento::all(); //SELECT DI TUTTI I DIPARTIMENTI

    }

    public function showServices(){
        return DB::table('prestazione as p')
        ->join('dipartimento as d', 'p.sp_dipartimento', '=', 'd.specializzazione')
        ->select('p.*', 'd.specializzazione')
        ->get()
        ->groupBy('specializzazione');
    }

    

    public function showData(){
        $dipartimenti = $this->showDepartments();
        $prestazioni = $this->showServices();
        return view('home', compact('dipartimenti','prestazioni'));

    }

    //FUNZIONE CHE RESTUISCE NELLA HOME LE PRESTAZIONI PER CIASCUN DIPARTIMENTO, CON ORARI E GIORNI DISPONIBILI
}
