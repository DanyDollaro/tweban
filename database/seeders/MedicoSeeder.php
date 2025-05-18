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
            ],
            [
                'codice_fiscale' => 'NGLMRA80A01F205Z',
                'nome' => 'Maria',
                'cognome' => 'Neri',
                'email' => 'maria.neri@example.com',
                'password' => Hash::make('MyPassword321!'),
                'prestazione_assegnata' => 'Visita dermatologica',
            ],
            [
                'codice_fiscale' => 'FRLLNZ85B01H501Y',
                'nome' => 'Lorenzo',
                'cognome' => 'Faralli',
                'email' => 'lorenzo.faralli@example.com',
                'password' => Hash::make('PassWord654!'),
                'prestazione_assegnata' => 'Visita ginecologica',
            ],
            [
                'codice_fiscale' => 'MNTGPP90C41F205X',
                'nome' => 'Giuseppe',
                'cognome' => 'Monti',
                'email' => 'giuseppe.monti@example.com',
                'password' => Hash::make('Secure789Pass!'),
                'prestazione_assegnata' => 'Visita neurologica',
            ],
            [
                'codice_fiscale' => 'RLLFNC75T41L219Y',
                'nome' => 'Francesca',
                'cognome' => 'Ralli',
                'email' => 'francesca.ralli@example.com',
                'password' => Hash::make('Strong321Pass!'),
                'prestazione_assegnata' => 'Radiografia articolare',
            ],
            [
                'codice_fiscale' => 'NGLMRA80A01F215Z',
                'nome' => 'Maria',
                'cognome' => 'Niglio',
                'email' => 'maria.niglio@example.com',
                'password' => Hash::make('MyPass123!'),
                'prestazione_assegnata' => 'Risonanza magnetica muscolo-scheletrica',
            ],
            [
                'codice_fiscale' => 'FRLLNZ85B01H511Y',
                'nome' => 'Lorenzo',
                'cognome' => 'Farina',
                'email' => 'lorenzo.farina@example.com',
                'password' => Hash::make('Pass456Word!'),
                'prestazione_assegnata' => 'Visita ortopedica',
            ]
            ]);
    }
}
