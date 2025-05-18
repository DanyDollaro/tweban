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

    //FUNZIONE CHE RESTUISCE NELLA HOME LE PRESTAZIONI PER CIASCUN DIPARTIMENTO, CON ORARI E GIORNI DISPONIBILI

    public function showTimeServices(){
        return DB::table('orario_prestazioni')
        ->select(
            'tipologia_prestazione',
            DB::raw('MIN(orario) as orario_iniziale'),
            DB::raw('MAX(orario) as orario_finale')
        )
        ->groupBy('tipologia_prestazione')
        ->get()
        ->keyBy('tipologia_prestazione');
    }

    public function showDayServices(){
        $giorniTotali = DB::table('giorni_prestazioni')
        ->select('tipologia_prestazione', 'giorno')
        ->orderBy('tipologia_prestazione')
        ->get();

        $giorniRaggruppati = [];

        foreach ($giorniTotali as $row) {
            $tipo = $row->tipologia_prestazione;
            if (!isset($giorniRaggruppati[$tipo])) {
                $giorniRaggruppati[$tipo] = [];
            }
            $giorniRaggruppati[$tipo][] = $row->giorno;
        }

        // Ora estrai primo e ultimo per ciascuna prestazione
        $giorniDisponibilita = [];

        foreach ($giorniRaggruppati as $tipo => $giorni) {
            $giorniDisponibilita[$tipo] = [
                'inizio' => $giorni[0],
                'fine' => $giorni[count($giorni) - 1],
            ];
        }

        return $giorniDisponibilita;
    }

    public function showDoctors(){
        return DB::table('medico')
        ->select('nome','cognome','prestazione_assegnata')
        ->get()
        ->keyBy('prestazione_assegnata');
    }

    public function showData(){
        $dipartimenti = $this->showDepartments();
        $prestazioni = $this->showServices();
        $orario_prestazioni = $this->showTimeServices();
        $giorni_disponibili = $this->showDayServices();
        $medici = $this->showDoctors();
        return view('home', compact('dipartimenti','prestazioni','orario_prestazioni','medici','giorni_disponibili'));
    }

    
}
