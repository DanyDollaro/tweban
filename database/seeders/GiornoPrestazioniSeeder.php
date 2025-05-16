<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiornoPrestazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('giorni_prestazioni')->insert([
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Lunedi'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Martedi'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Mercoledi'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Giovedi'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Martedi'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Mercoledi'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Giovedi'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Venerdi']
        ]);
    }
}
