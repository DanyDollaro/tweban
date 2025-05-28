<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Se NON VUOI la verifica email, rimuovi l'importazione di MustVerifyEmail
// use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable // Se NON VUOI la verifica email, rimuovi 'implements MustVerifyEmail'
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cognome',
        'email',
        'password',
        'role', // Aggiungi 'role' qui per consentirne l'assegnazione di massa
        'telefono',
        'data_nascita',
        'codice_fiscale',
        'indirizzo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        // Se NON VUOI la verifica email, puoi rimuovere la riga 'email_verified_at'
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
