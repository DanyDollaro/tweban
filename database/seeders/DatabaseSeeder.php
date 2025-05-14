<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //DB::table('cliente')->insert([
        //    [
        //        'nome' => 'Elena',
        //        'cognome' => 'Russo',
        //        'codice_fiscale' => 'RSSLNE92D03H501Q',
        //        'email' => 'elena.russo@example.com',
        //        'password' => Hash::make('elena456')
        //    ],
        //    [
        //        'nome' => 'Alessandro',
        //        'cognome' => 'Ferrari',
        //        'codice_fiscale' => 'FRRLSS85E15F205X',
        //        'email' => 'alessandro.ferrari@example.com',
        //        'password' => Hash::make('alessandro789')
        //    ]
        //]);

        //DB::table('membro_staff')->insert([
        //]);

        DB::table('dipartimento')->inserti([
            ['specializzazione' => 'Cardiologia', 'descrizione' => '...'],
            ['specializzazione' => 'Ortopedia', 'descrizione' => '...'],
            ['specializzazione' => 'Dermatologia', 'descrizione' => '...'],
            ['specializzazione' => 'Ginecologia', 'descrizione' => '...'],
            ['specializzazione' => 'Neurologia', 'descrizione' => '...'],
        ]);

        DB::table('prestazione')->inserti([
            ['tipologia' => 'Elettrocardiogramma', 'descrizione' => '...', 'sp_dipartimento'=>'Cardiologia', 'mail_staff' =>''],
            ['tipologia' => 'Visita cardiologica', 'descrizione' => '...', 'sp_dipartimento'=>'Cardilogia', 'mail_staff' =>''],
            ['tipologia' => 'Visita ortopedica', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>''],
            ['tipologia' => 'Radiografia articolare', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>''],
            ['tipologia' => 'Risonanza magnetica muscolo-scheletrica', 'descrizione' => '...', 'sp_dipartimento'=>'Ortopedia', 'mail_staff' =>''],
            ['tipologia' => 'Visita dermatologica', 'descrizione' => '...', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>''],
            ['tipologia' => 'Dermatoscopia', 'descrizione' => '...', 'sp_dipartimento'=>'Dermatologia', 'mail_staff' =>''],
            ['tipologia' => 'Visita ginecologica', 'descrizione' => '...', 'sp_dipartimento'=>'Ginecologia', 'mail_staff' =>''],
            ['tipologia' => 'Visita neurologica', 'descrizione' => '...', 'sp_dipartimento'=>'Neurologia', 'mail_staff' =>''],
        ]);

        
    }
}
