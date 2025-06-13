<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orario extends Model
{
    protected $table = 'orari';
    protected $primaryKey = 'valore_orario';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'valore_orario',
    ];

    public function prestazioni()
    {
        return $this->hasMany(OrarioPrestazione::class, 'orario', 'valore_orario');
    }
}
