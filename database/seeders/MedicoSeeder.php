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
                'prestazione_assegnata' => 'Elettrocardiogramma',
                'immagine_profilo' => 'doctors-1.jpg'
            ],
            [
                'codice_fiscale' => 'VRNGPP90A41F205X',
                'nome' => 'Giuseppe',
                'cognome' => 'Verdi',
                'prestazione_assegnata' => 'Visita cardiologica',
                'immagine_profilo' => 'doctors-1.jpg'
            ],
            [
                'codice_fiscale' => 'BNCFNC75T41L219Y',
                'nome' => 'Francesca',
                'cognome' => 'Bianchi',
                'prestazione_assegnata' => 'Dermatoscopia',
                'immagine_profilo' => 'doctors-2.jpg'
            ],
            [
                'codice_fiscale' => 'NGLMRA80A01F205Z',
                'nome' => 'Maria',
                'cognome' => 'Neri',
                'prestazione_assegnata' => 'Visita dermatologica',
                'immagine_profilo' => 'doctors-4.jpg'
            ],
            [
                'codice_fiscale' => 'FRLLNZ85B01H501Y',
                'nome' => 'Lorenzo',
                'cognome' => 'Faralli',
                'prestazione_assegnata' => 'Visita ginecologica',
                'immagine_profilo' => 'doctors-1.jpg'
            ],
            [
                'codice_fiscale' => 'MNTGPP90C41F205X',
                'nome' => 'Giuseppe',
                'cognome' => 'Monti',
                'prestazione_assegnata' => 'Visita neurologica',
                'immagine_profilo' => 'doctors-1.jpg'
            ],
            [
                'codice_fiscale' => 'RLLFNC75T41L219Y',
                'nome' => 'Francesca',
                'cognome' => 'Ralli',
                'prestazione_assegnata' => 'Radiografia articolare',
                'immagine_profilo' => 'doctors-4.jpg'
            ],
            [
                'codice_fiscale' => 'NGLMRA80A01F215Z',
                'nome' => 'Maria',
                'cognome' => 'Niglio',
                'prestazione_assegnata' => 'Risonanza magnetica muscolo-scheletrica',
                'immagine_profilo' => 'doctors-2.jpg'
            ],
            [
                'codice_fiscale' => 'FRLLNZ85B01H511Y',
                'nome' => 'Lorenzo',
                'cognome' => 'Farina',
                'prestazione_assegnata' => 'Visita ortopedica',
                'immagine_profilo' => 'doctors-3.jpg'
            ]
            ]);
    }
}
