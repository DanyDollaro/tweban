<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(DipartimentiSeeder::class);
        $this->call(GiorniSeeder::class);
        $this->call(OrariSeeder::class);
        $this->call(PrestazioniSeeder::class);
        $this->call(OrarioPrestazioniSeeder::class);
        $this->call(GiornoPrestazioniSeeder::class);
        $this->call(MedicoSeeder::class);
        $this->call(PrenotazioniSeeder::class);
    }
}
