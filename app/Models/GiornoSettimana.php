<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiornoSettimana extends Model
{
    protected $table = 'giorni_settimana';
    protected $primaryKey = 'valore_giorno';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = ['valore_giorno'];
}

