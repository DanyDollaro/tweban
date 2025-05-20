<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiornoPrestazione extends Model
{
    protected $table = 'giorni_prestazioni';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'tipologia_prestazione',
        'giorno',
    ];
}
