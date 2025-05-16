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
            ['valore_giorno'=>'Lunedi'],
            ['valore_giorno'=>'Martedi'],
            ['valore_giorno'=>'Mercoledi'],
            ['valore_giorno'=>'Giovedi'],
            ['valore_giorno'=>'Venerdi']
        ]);
    }
}
