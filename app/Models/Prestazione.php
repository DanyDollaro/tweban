<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestazione extends Model
{
    protected $table = 'prestazione';
    protected $primaryKey = 'tipologia';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tipologia',
        'prescrizione',
        'descrizione',
        'sp_dipartimento',
        'staff_id',
    ];

    public function dipartimento()
    {
        return $this->belongsTo(Dipartimento::class, 'sp_dipartimento', 'specializzazione');
    }

    public function giorni()
    {
        return $this->hasMany(GiornoPrestazione::class, 'tipologia_prestazione', 'tipologia');
    }

    public function orari()
    {
        return $this->hasMany(OrarioPrestazione::class, 'tipologia_prestazione', 'tipologia');
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class, 'tipologia_prestazione', 'tipologia');
    }
}
