<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'pazipazi',
            'nome' => 'pazi',
            'cognome' => 'pazi',
            'codice_fiscale' => 'pppzzz',
            'data_nascita' => '01/01/0001',
            'telefono'=> '123456789',
            'email' => 'pazipazi@example.com',
            'indirizzo' => 'via geppetto',
            'password' => Hash::make('hXsThXsT'),
            'ruolo' => 'paziente'],
            ['username' => 'staffstaff',
            'nome' => 'staff',
            'cognome' => 'staff',
            'codice_fiscale' => 'sssffff',
            'data_nascita' => '01/01/0001',
            'telefono'=> '123456780',
            'email' => 'staffstaff@example.com',
            'indirizzo' => 'via geppetto',
            'password' => Hash::make('hXsThXsT'),
            'ruolo' => 'staff'],
            ['username' => 'adminadmin',
            'nome' => 'admin',
            'cognome' => 'admin',
            'codice_fiscale' => 'ddddmmmm',
            'data_nascita' => '01/01/0001',
            'telefono'=> '123456781',
            'email' => 'admin@example.com',
            'indirizzo' => 'via geppetto',
            'password' => Hash::make('hXsThXsT'),
            'ruolo' => 'amministratore']
        ]);
    }
}
