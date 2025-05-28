<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    protected $table = 'prenotazione';
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipologia_prestazione',
        'giorno_escluso',
        'staff_id',
    ];
}
