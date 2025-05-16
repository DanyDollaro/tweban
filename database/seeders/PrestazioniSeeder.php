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
            ['tipologia' => 'Elettrocardiogramma', 'descrizione' => '...', 'sp_dipartimento'=>'Cardiologia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Visita cardiologica', 'descrizione' => '...', 'sp_dipartimento'=>'Cardiologia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Visita ortopedica', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Radiografia articolare', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Risonanza magnetica muscolo-scheletrica', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Visita dermatologica', 'descrizione' => '...', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Dermatoscopia', 'descrizione' => '...', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Visita ginecologica', 'descrizione' => '...', 'sp_dipartimento'=>'Ginecologia', 'mail_staff' =>'mail@business.com'],
            ['tipologia' => 'Visita neurologica', 'descrizione' => '...', 'sp_dipartimento'=>'Neurologia', 'mail_staff' =>'mail@business.com']
        ]);
    }
}
