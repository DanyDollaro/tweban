<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestazione extends Model
{
    protected $table = 'prestazione';
    protected $primaryKey = 'tipologia';
    public $timestamps = false;
}
