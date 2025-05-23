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
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Elettrocardiogramma', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Venerdì']
        ]);
    }
}
