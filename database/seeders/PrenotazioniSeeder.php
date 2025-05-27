<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestazione; 
use App\Models\Paziente; 
use App\Models\Prenotazione; 

class PrenotazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Esempio: recupera un paziente esistente
        $paziente1 = Paziente::first(); // Prende il primo paziente disponibile
        // O recupera un paziente specifico:
        // $paziente1 = Paziente::where('email', 'mario.rossi@example.com')->first();

        // Esempio: recupera un'altra paziente
        $paziente2 = Paziente::skip(1)->first(); // Prende il secondo paziente disponibile
        // O recupera un paziente specifico:
        // $paziente2 = Paziente::where('email', 'laura.bianchi@example.com')->first();

        // Esempio: recupera una prestazione esistente
        $prestazioneCardiologica = Prestazione::where('tipologia', 'cardiologica')->first();
        // O recupera un'altra prestazione:
        $prestazioneDermatologica = Prestazione::where('tipologia', 'dermatologica')->first();


        // Data per le prenotazioni (puoi usare Carbon::now() per la data odierna)
        $today = Carbon::now()->format('Y-m-d');
        // Oppure una data fissa per i test:
        // $testDate = '2025-05-28'; // Esempio: domani

        // Inserimento delle due prenotazioni (Appuntamenti)
        if ($paziente1 && $prestazioneCardiologica) {
            Prenotazione::create([
                'data' => $today, // Data di oggi (o $testDate)
                'ora' => '09:30:00', // Ora dell'appuntamento
                'id_prestazione' => $prestazioneCardiologica->tipologia, // Chiave esterna per la prestazione
                'paziente_id' => $paziente1->id, // Chiave esterna per il paziente
                'note' => 'Controllo annuale preventivo.',
                // Aggiungi qui altri campi se la tua tabella Appuntamento li richiede
            ]);
        } else {
            $this->command->info('Skipping appointment 1: Paziente 1 or Cardiologica Prestazione not found.');
        }


        if ($paziente2 && $prestazioneDermatologica) {
            Prenotazione::create([
                'data' => $today, // Data di oggi (o $testDate)
                'ora' => '14:00:00', // Ora dell'appuntamento
                'id_prestazione' => $prestazioneDermatologica->tipologia,
                'paziente_id' => $paziente2->id,
                'note' => 'Visita per controllo nei.',
                // Aggiungi qui altri campi se la tua tabella Appuntamento li richiede
            ]);
        } else {
            $this->command->info('Skipping appointment 2: Paziente 2 or Dermatologica Prestazione not found.');
        }

        $this->command->info('PrenotazioniSeeder executed.');
    }
}
