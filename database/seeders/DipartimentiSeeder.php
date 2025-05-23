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
            ['specializzazione' => 'Cardiologia', 'descrizione' => 'DEPARTMENT XXX'],
            ['specializzazione' => 'Ortopedia', 'descrizione' => 'DEPARTMENT XXX'],
            ['specializzazione' => 'Dermatologia', 'descrizione' => 'DEPARTMENT XXX'],
            ['specializzazione' => 'Ginecologia', 'descrizione' => 'DEPARTMENT XXX'],
            ['specializzazione' => 'Neurologia', 'descrizione' => 'DEPARTMENT XXX'],
        ]);
    }
}
