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
            ['tipologia' => 'Elettrocardiogramma','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Cardiologia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Visita cardiologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Cardiologia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Visita ortopedica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Radiografia articolare','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Risonanza magnetica muscolo-scheletrica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Visita dermatologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Dermatoscopia','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Visita ginecologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Ginecologia', 'mail_staff' =>'staffstaff@example.com'],
            ['tipologia' => 'Visita neurologica','prescrizione' => 'prescrizione xxx', 'descrizione' => 'Descrizione XXX', 'sp_dipartimento'=>'Neurologia', 'mail_staff' =>'staffstaff@example.com']
        ]);
    }
}
