<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmministratoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('amministratore')->insert([
            ['username' => 'adminadmin', 'nome'=>'admin', 'cognome'=>'ad','password'=>'hXsThXsT']
        ]);
    }
}
