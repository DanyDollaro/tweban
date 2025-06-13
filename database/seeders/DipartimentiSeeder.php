<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DipartimentiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dipartimento')->insert([
            ['specializzazione' => 'Cardiologia', 'descrizione' => 'Diagnosi e cura delle malattie cardiovascolari'],
            ['specializzazione' => 'Ortopedia', 'descrizione' => 'Trattamento di ossa, articolazioni e muscoli'],
            ['specializzazione' => 'Dermatologia', 'descrizione' => 'Cura delle malattie della pelle e annessi cutanei'],
            ['specializzazione' => 'Ginecologia', 'descrizione' => 'Salute del sistema riproduttivo femminile'],
            ['specializzazione' => 'Neurologia', 'descrizione' => 'Diagnosi e trattamento delle malattie del sistema nervoso']
        ]);
    }
}
