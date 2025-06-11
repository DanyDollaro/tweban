<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AgendaPrenotazioni extends Model
{
    use HasFactory;

    protected $table = 'prenotazione';
    protected $fillable = [
        'cliente_id',
        'staff_id',
        'data_prenotazione',
        'orario_prenotazione',
        'tipologia_prestazione',
        'giorno_escluso',
        'stato',
    ];

    protected $casts = [
        'data_prenotazione' => 'date',
        'orario_prenotazione' => 'datetime',
    ];

    // RELAZIONI
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function prestazione()
    {
        return $this->belongsTo(Prestazione::class, 'tipologia_prestazione', 'tipologia');
    }

    // ACCESSOR: orario formattato
    public function getOrarioPrenotazioneFormattedAttribute()
    {
        return $this->orario_prenotazione ? $this->orario_prenotazione->format('H:i') : null;
    }

    // ACCESSOR: data + orario uniti in un unico oggetto Carbon
    public function getFullDateTimeAttribute()
    {
        if ($this->data_prenotazione && $this->orario_prenotazione) {
            return Carbon::create(
                $this->data_prenotazione->year,
                $this->data_prenotazione->month,
                $this->data_prenotazione->day,
                $this->orario_prenotazione->hour,
                $this->orario_prenotazione->minute,
                $this->orario_prenotazione->second
            );
        }
        return null;
    }

    // (OPZIONALE) ACCESSOR per visualizzare lo stato in formato leggibile
    public function getStatoLabelAttribute()
    {
        return match($this->stato) {
            'in_attesa' => 'In Attesa',
            'accettata' => 'Accettata',
            default => ucfirst($this->stato),
        };
    }
}
