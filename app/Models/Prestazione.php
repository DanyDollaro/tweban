<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestazione extends Model
{
    protected $table = 'prestazione';
    protected $primaryKey = 'tipologia';
    public $incrementing = false;
    public $timestamps = false;

    public function dipartimento()
    {
        return $this->belongsTo(Dipartimento::class, 'sp_dipartimento', 'specializzazione');
    }
}
