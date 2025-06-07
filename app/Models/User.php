<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nome',
        'cognome',
        'codice_fiscale',
        'data_nascita',
        'telefono',
        'email',
        'indirizzo',
        'password',
        'ruolo', // Aggiungi 'role' qui per consentirne l'assegnazione di massa
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
     /**
     * Verifica se l'utente ha il ruolo di 'amministratore'.
     *
     * @return bool
     */
    public function isPaziente():bool{
        return $this->ruolo === 'paziente';
    }
    public function isStaff():bool{
        return $this->ruolo === 'staff';
    }
    public function isAmministratore():bool{
        return $this->ruolo === 'amministratore';
    }
    /**
     * Verifica se l'utente appartiene a uno dei ruoli specificati.
     * Utile per controllare ruoli multipli.
     *
     * @param  array|string  $roles
     * @return bool
     */
    public function hasRole(array|string $roles): bool
    {
        // Se $roles è una stringa, la convertiamo in un array per uniformità
        if (is_string($roles)) {
            $roles = [$roles];
        }

        return in_array($this->ruolo, $roles);
    }
}

