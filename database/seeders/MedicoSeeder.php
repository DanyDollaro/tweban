<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medico')->insert([
            [
                'codice_fiscale' => 'RSSMRA85M01H501Z',
                'nome' => 'Marco',
                'cognome' => 'Rossi',
                'email' => 'marco.rossi@example.com',
                'password' => Hash::make('Password123!'),
                'prestazione_assegnata' => 'Elettrocardiogramma',
            ],
            [
                'codice_fiscale' => 'VRNGPP90A41F205X',
                'nome' => 'Giuseppe',
                'cognome' => 'Verdi',
                'email' => 'giuseppe.verdi@example.com',
                'password' => Hash::make('SecurePass456!'),
                'prestazione_assegnata' => 'Visita cardiologica',
            ],
            [
                'codice_fiscale' => 'BNCFNC75T41L219Y',
                'nome' => 'Francesca',
                'cognome' => 'Bianchi',
                'email' => 'francesca.bianchi@example.com',
                'password' => Hash::make('StrongPass789!'),
                'prestazione_assegnata' => 'Dermatoscopia',
            ]
            ]);
    }
}
