<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestazione;
use App\Models\User;
use App\Models\Prenotazione;
use Carbon\Carbon; // Import the Carbon facade

class PrenotazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera un paziente esistente
        $paziente1 = User::where('ruolo', 'paziente')->first();
        $paziente2 = User::where('ruolo', 'paziente')->skip(1)->first();

        // Recupera le prestazioni esistenti
        $prestazioneCardiologica = Prestazione::where('tipologia', 'cardiologica')->first();
        $prestazioneDermatologica = Prestazione::where('tipologia', 'dermatologica')->first();

        // Data per le prenotazioni
        $today = Carbon::now()->format('Y-m-d');

        // Inserimento delle due prenotazioni (Appuntamenti)
        if ($paziente1 && $prestazioneCardiologica) {
            Prenotazione::create([
                'data_prenotazione' => $today, // Modificato da 'data'
                'ora' => '09:30:00',
                // IMPORTANTE: Se 'tipologia_prestazione' nella tua tabella `prenotazione` è un ID numerico
                // (chiave esterna a `prestazioni.id`), allora qui dovresti usare `$prestazioneCardiologica->id`.
                // Se invece deve contenere la stringa "cardiologica", allora `$prestazioneCardiologica->tipologia` è corretto.
                // Basandoci sul nome della colonna che hai mostrato, assumiamo che voglia la stringa "cardiologica".
                'tipologia_prestazione' => $prestazioneCardiologica->tipologia, // Modificato da 'id_prestazione'
                'client_id' => $paziente1->id, // Modificato da 'paziente_id'
                'note' => 'Controllo annuale preventivo.',
                // 'giorno_escluso' e 'staff_id' non sono inclusi qui.
                // Se non sono nullable nella tua tabella, dovrai aggiungerli con un valore.
            ]);
        } else {
            $this->command->info('Skipping appointment 1: Paziente 1 or Cardiologica Prestazione not found.');
        }

        if ($paziente2 && $prestazioneDermatologica) {
            Prenotazione::create([
                'data_prenotazione' => $today, // Modificato da 'data'
                'ora' => '14:00:00',
                // Vedi la nota sopra per 'tipologia_prestazione'.
                'tipologia_prestazione' => $prestazioneDermatologica->tipologia, // Modificato da 'id_prestazione'
                'client_id' => $paziente2->id, // Modificato da 'paziente_id'
                'note' => 'Visita per controllo nei.',
            ]);
        } else {
            $this->command->info('Skipping appointment 2: Paziente 2 or Dermatologica Prestazione not found.');
        }

        $this->command->info('PrenotazioniSeeder executed.');
    }
}