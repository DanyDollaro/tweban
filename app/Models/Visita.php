<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $table = 'visite';
    protected $fillable = ['user_id', 'data_visita', 'descrizione'];

    protected $casts = [
        'data_visita' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
