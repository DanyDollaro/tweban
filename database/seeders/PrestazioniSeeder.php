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
            ['tipologia' => 'Elettrocardiogramma','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Cardiologia', 'staff_id' =>'2'],
            ['tipologia' => 'Visita cardiologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Cardiologia', 'staff_id' =>'2'],
            ['tipologia' => 'Visita ortopedica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'staff_id' =>'2'],
            ['tipologia' => 'Radiografia articolare','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'staff_id' =>'2'],
            ['tipologia' => 'Risonanza magnetica muscolo-scheletrica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'staff_id' =>'2'],
            ['tipologia' => 'Visita dermatologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Dermatologia', 'staff_id' =>'3'],
            ['tipologia' => 'Dermatoscopia','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Dermatologia', 'staff_id' =>'3'],
            ['tipologia' => 'Visita ginecologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ginecologia', 'staff_id' =>'3'],
            ['tipologia' => 'Visita neurologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Neurologia', 'staff_id' =>'3']
        ]);
    }
}
