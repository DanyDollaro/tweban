<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestazione')->insert([
            ['tipologia' => 'Elettrocardiogramma', 
            'prescrizione' => 'Indicata per sospette aritmie o dolori toracici', 
            'descrizione' => 'Registrazione dell’attività elettrica del cuore tramite elettrodi cutanei', 
            'sp_dipartimento' => 'Cardiologia'],

            ['tipologia' => 'Visita cardiologica', 
            'prescrizione' => 'Raccomandata in caso di ipertensione, palpitazioni o familiarità per patologie cardiache', 
            'descrizione' => 'Valutazione clinica del cuore e del sistema cardiovascolare da parte del cardiologo', 
            'sp_dipartimento' => 'Cardiologia'],

            ['tipologia' => 'Visita ortopedica', 
            'prescrizione' => 'Consigliata per dolori articolari, traumi o difficoltà motorie', 
            'descrizione' => 'Esame clinico per diagnosticare e trattare patologie dell’apparato muscolo-scheletrico', 
            'sp_dipartimento' => 'Ortopedia'],

            ['tipologia' => 'Radiografia articolare', 
            'prescrizione' => 'Indicata per lesioni articolari, artrite o fratture sospette', 
            'descrizione' => 'Imaging radiografico per lo studio morfologico delle articolazioni', 
            'sp_dipartimento' => 'Ortopedia'],

            ['tipologia' => 'Risonanza magnetica muscolo-scheletrica', 
            'prescrizione' => 'Prescritta per indagare lesioni tendinee, muscolari o articolari non visibili con radiografie', 
            'descrizione' => 'Esame diagnostico avanzato per visualizzare i tessuti molli e articolazioni', 
            'sp_dipartimento' => 'Ortopedia'],

            ['tipologia' => 'Visita dermatologica', 
            'prescrizione' => 'Consigliata in presenza di eruzioni cutanee, acne o lesioni sospette', 
            'descrizione' => 'Valutazione specialistica della pelle, unghie e capelli', 
            'sp_dipartimento' => 'Dermatologia'],

            ['tipologia' => 'Dermatoscopia', 
            'prescrizione' => 'Prescritta per monitoraggio e diagnosi precoce dei nei e delle lesioni pigmentate', 
            'descrizione' => 'Esame non invasivo che utilizza un dermatoscopio per osservare le strutture cutanee', 
            'sp_dipartimento' => 'Dermatologia'],

            ['tipologia' => 'Visita ginecologica', 
            'prescrizione' => 'Raccomandata per controlli periodici o sintomi ginecologici (ciclo irregolare, dolori pelvici)', 
            'descrizione' => 'Esame clinico del sistema riproduttivo femminile da parte del ginecologo', 
            'sp_dipartimento' => 'Ginecologia'],

            ['tipologia' => 'Visita neurologica', 
            'prescrizione' => 'Consigliata per cefalee persistenti, vertigini, formicolii o disturbi del movimento', 
            'descrizione' => 'Esame clinico delle funzioni neurologiche e del sistema nervoso centrale e periferico', 
            'sp_dipartimento' => 'Neurologia'],
        ]);
    }
}
