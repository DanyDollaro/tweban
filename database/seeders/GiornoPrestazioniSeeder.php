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
            ['tipologia_prestazione' => 'Visita cardiologica', 'giorno' => 'Venerdì'],
            ['tipologia_prestazione' => 'Visita ortopedica', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Visita ortopedica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Visita ortopedica', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Visita ortopedica', 'giorno' => 'Venerdì'],
            ['tipologia_prestazione' => 'Radiografia articolare', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Radiografia articolare', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Radiografia articolare', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Radiografia articolare', 'giorno' => 'Venerdì'],
            ['tipologia_prestazione' => 'Risonanza magnetica muscolo-scheletrica', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Risonanza magnetica muscolo-scheletrica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Risonanza magnetica muscolo-scheletrica', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Risonanza magnetica muscolo-scheletrica', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Dermatoscopia', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Dermatoscopia', 'giorno' => 'Giovedì'],
            ['tipologia_prestazione' => 'Visita dermatologica', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Visita dermatologica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Visita dermatologica', 'giorno' => 'Mercoledì'],
            ['tipologia_prestazione' => 'Visita ginecologica', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Visita ginecologica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Visita neurologica', 'giorno' => 'Lunedì'],
            ['tipologia_prestazione' => 'Visita neurologica', 'giorno' => 'Martedì'],
            ['tipologia_prestazione' => 'Visita neurologica', 'giorno' => 'Mercoledì'],
        ]);
    }
}
