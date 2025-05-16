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
            ['specializzazione' => 'Cardiologia', 'descrizione' => '...'],
            ['specializzazione' => 'Ortopedia', 'descrizione' => '...'],
            ['specializzazione' => 'Dermatologia', 'descrizione' => '...'],
            ['specializzazione' => 'Ginecologia', 'descrizione' => '...'],
            ['specializzazione' => 'Neurologia', 'descrizione' => '...'],
        ]);
    }
}
