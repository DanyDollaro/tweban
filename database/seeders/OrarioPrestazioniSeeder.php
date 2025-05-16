<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrarioPrestazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orario_prestazioni')->insert([
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '09:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '10:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '11:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '12:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '13:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '14:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '15:00:00'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'orario' => '16:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '09:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '10:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '11:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '12:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '13:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '14:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '15:00:00'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'orario' => '16:00:00']
        ]);
    }
}
