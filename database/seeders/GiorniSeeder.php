<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiorniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('giorni_settimana')->insert([
            ['valore_giorno'=>'Lunedì'],
            ['valore_giorno'=>'Martedì'],
            ['valore_giorno'=>'Mercoledì'],
            ['valore_giorno'=>'Giovedì'],
            ['valore_giorno'=>'Venerdì']
        ]);
    }
}
