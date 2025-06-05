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
        'orario_prenotazione' => 'datetime:H:i:s',

    ];

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

    public function getFullDateTimeAttribute(){
        if ($this->data_prenotazione && $this->orario_prenotazione) {
        return Carbon::parse($this->data_prenotazione->format('Y-m-d') . ' ' . $this->orario_prenotazione->format('H:i'));
       }
       return null;
    }
}
