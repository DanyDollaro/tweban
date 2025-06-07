<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppuntamentoNotifica extends Notification
{
    use Queueable;

    protected $azione;
    protected $appuntamento;

    public function __construct(string $azione, $appuntamento)
    {
        $this->azione = $azione;
        $this->appuntamento = $appuntamento;
    }

    // Usa solo il canale database
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'azione' => $this->azione,
            'appuntamento_id' => $this->appuntamento->id,
            'data_prenotazione' => $this->appuntamento->data_prenotazione,
            'orario_prenotazione' => $this->appuntamento->orario_prenotazione,
            'messaggio' => "Il tuo appuntamento è stato {$this->azione}.",
        ];
    }
}
