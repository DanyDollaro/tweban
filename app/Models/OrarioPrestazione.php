<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrarioPrestazione extends Model
{
    protected $table = 'orario_prestazioni';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'tipologia_prestazione',
        'orario',
    ];
}
