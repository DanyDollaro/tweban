<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrenotazioniSeeder extends Seeder
{
    public function run(): void
    {
        $stati = ['in_attesa', 'accettata', 'rifiutata'];
        $giorni = ['lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi'];

        // Recupera ID validi
        $clienti = DB::table('users')->where('ruolo', 'paziente')->pluck('id')->toArray();
        $staff = DB::table('users')->where('ruolo', 'staff')->pluck('id')->toArray();
        $tipologie = DB::table('prestazione')->pluck('tipologia')->toArray();

        if (empty($clienti) || empty($staff) || empty($tipologie)) {
            $this->command->warn("⚠️ Nessun dato base trovato (clienti, staff o prestazioni), quindi il seeder non ha generato nulla.");
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            $giorni_da_oggi = rand(1, 30);
            $data = date('Y-m-d', strtotime("+$giorni_da_oggi days"));
            $ora = sprintf('%02d:00:00', rand(8, 17)); // orari interi tra 08 e 17

            DB::table('prenotazione')->insert([
                'data_prenotazione'     => $data,
                'orario_prenotazione'   => $ora,
                'giorno_escluso'        => $giorni[array_rand($giorni)],
                'cliente_id'            => $clienti[array_rand($clienti)],
                'staff_id'              => $staff[array_rand($staff)],
                'tipologia_prestazione' => $tipologie[array_rand($tipologie)],
                'stato'                 => $stati[array_rand($stati)],
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);
        }
    }
}

