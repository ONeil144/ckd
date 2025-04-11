<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\PersonnelMedical;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'code_personnel',
        'name',
        'prenom',
        'email',
        'password',
        'avatar',
        'role',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation avec le personnel médical.
     * Si l'utilisateur a le rôle "personnel_medical", 
     * une entrée associée se trouve dans la table "personnel_medical".
     */
    public function personnelMedical()
    {
        return $this->hasOne(PersonnelMedical::class, 'users_id');
        
    }
}
