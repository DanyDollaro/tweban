<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orari')->insert([
            ['valore_orario'=>'08:00:00'],
            ['valore_orario'=>'09:00:00'],
            ['valore_orario'=>'10:00:00'],
            ['valore_orario'=>'11:00:00'],
            ['valore_orario'=>'12:00:00'],
            ['valore_orario'=>'13:00:00'],
            ['valore_orario'=>'14:00:00'],
            ['valore_orario'=>'15:00:00'],
            ['valore_orario'=>'16:00:00'],
            ['valore_orario'=>'17:00:00'],
            ['valore_orario'=>'18:00:00'],
            ['valore_orario'=>'19:00:00']
        ]);
    }
}
