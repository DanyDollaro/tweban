<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\GiornoPrestazione;
use App\Models\OrarioPrestazione;
use App\Models\Prestazione;
use Illuminate\Support\Facades\DB;

class DipartimentoController extends Controller
{

    protected $_departmentModel;
    protected $_servicesModel;
    protected $_timeServicesModel;
    protected $_dayServicesModel;

    public function __construct()
    {
        $this->_departmentModel = new Dipartimento;
        $this->_servicesModel = new Prestazione;
        $this->_timeServicesModel = new OrarioPrestazione;
        $this->_dayServicesModel = new GiornoPrestazione;
    }

    //RESTITUZIONE DI PRESTAZIONi PER DIPARTIMENTO ASSOCIATO [ELOQUENT]
    public function showServices(){

        // Carica tutte le prestazioni con il dipartimento associato
        $prestazioni = $this->_servicesModel->with('dipartimento')->get();

        // Raggruppa per specializzazione del dipartimento le prestazioni da restituire
        $group_services = $prestazioni->groupBy(function ($item){
            return $item->dipartimento->specializzazione;
        });

        return $group_services;
    }

    //RESTITUZIONE DI PRESTAZIONI PER DIPARTIMENTO ASSOCIATO (QUERY-BUILDER)

    /*public function showServices(){
        return DB::table('prestazione as p')
        ->join('dipartimento as d', 'p.sp_dipartimento', '=', 'd.specializzazione')
        ->select('p.*', 'd.specializzazione')
        ->get()
        ->groupBy('specializzazione');
    }*/


    //RESTITUZIONE DI ORARI DELLE PRESTAZIONI PER TIPOLOGIA DI PRESTAZIONE [ELOQUENT]
    public function showTimeServices(){
        return $this->_timeServicesModel->select(
                'tipologia_prestazione',
                DB::raw('MIN(orario) as orario_iniziale'),
                DB::raw('MAX(orario) as orario_finale')
            )
            ->groupBy('tipologia_prestazione')
            ->get()
            ->keyBy('tipologia_prestazione');;
    }


    //RESTITUZIONE DI ORARI DELLE PRESTAZIONI PER TIPOLOGIA DI PRESTAZIONE (QUERY-BUILDER)

    /*public function showTimeServices(){
        return DB::table('orario_prestazioni')
        ->select(
            'tipologia_prestazione',
            DB::raw('MIN(orario) as orario_iniziale'),
            DB::raw('MAX(orario) as orario_finale')
        )
        ->groupBy('tipologia_prestazione')
        ->get()
        ->keyBy('tipologia_prestazione');
    }*/

    //RESTITUZIONE GIORNO FINALE E INIZIALE DI SERVIZIO DELLE PRESTAZIONI PER TIPOLOGIA DI PRESTAZIONE (ELOQUENT)
    public function showFirstLastDayServices(){
        $giorniTotali = $this->_dayServicesModel->select('tipologia_prestazione', 'giorno')
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

        $giorniDisponibilita = [];

        foreach ($giorniRaggruppati as $tipo => $giorni) {
            $giorniDisponibilita[$tipo] = [
                'inizio' => $giorni[0],
                'fine' => $giorni[count($giorni) - 1],
            ];
        }
        return $giorniDisponibilita;

    }

    //RESTITUZIONE GIORNO FINALE E INIZIALE DI SERVIZIO DELLE PRESTAZIONI PER TIPOLOGIA DI PRESTAZIONE (QUERY-BUILDER)
    /*public function showFirstLastDayServices(){
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
    }*/

    //RESTITUZIONE DI MEDICI ASSEGNATI PER PRESTAZIONE (QUERY-BUILDER) {NO ELOQUENT DATA LA SOLA ESTRAZIONE DI SEMPLICI DATI IN QUESTO CONTESTO}
    public function showDoctors(){
        return DB::table('medico')
        ->select('nome','cognome','prestazione_assegnata','immagine_profilo')
        ->get()
        ->keyBy('prestazione_assegnata');
    }

    public function showData(){
        $dipartimenti = $this->_departmentModel->all();
        $prestazioni = $this->showServices();
        $orario_prestazioni = $this->showTimeServices();
        $giorni_disponibili = $this->showFirstLastDayServices();
        $medici = $this->showDoctors();
        return view('home', compact('dipartimenti','prestazioni','orario_prestazioni','medici','giorni_disponibili'));
    }

}
