<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('membro_staff')->insert([
            ['business_mail'=>'mail@business.com','nome'=>'Mario','cognome'=>'Rossi','password'=>'...']
        ]);
    }
}
