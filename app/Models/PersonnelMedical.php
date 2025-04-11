<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class PersonnelMedical extends Model
{
    protected $table = 'personnel_medical'; // Indique le nom exact de la table

    protected $fillable = [
        'specialite',
        'users_id',
    ];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');

        
    }

    // Relation avec le modèle DossierMedical
    public function dossiersMedicaux()
    {
        return $this->hasMany(DossierMedical::class, 'personnel_medical_id');
    }

    public function traitements()
    {
        return $this->hasMany(Traitement::class, 'personnel_medical_id');
    }
    public function examens()
    {
        return $this->hasMany(Examen::class, 'personnel_medical_id');
    }
    public function workflow()
    {
        return $this->hasMany(workflow::class, 'personnel_medical_id');
    }
    public function patients()
    {
        return $this->hasMany(Patient::class, 'personnel_medical_id');
    }
}
