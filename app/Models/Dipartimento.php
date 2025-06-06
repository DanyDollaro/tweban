<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dipartimento extends Model
{
    protected $table = 'dipartimento';
    protected $primaryKey = 'specializzazione';
    public $incrementing = false;
    public $timestamps = false;

    public function prestazioni()
    {
        return $this->hasMany(Prestazione::class, 'sp_dipartimento', 'specializzazione');
    }
}
