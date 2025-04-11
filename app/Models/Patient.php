<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'code_personnel',
        'nom',
        'prenom',
        'nationalite',
        'sexe',
        'adresse',
        'ville',
        'email',
        'age',
        'poids',
        'taille',
        'profession',
        'telephone',
        'groupe_sanguin',
        'workflow_id',
        'personnel_medical_id',
    ];

    /**
     * Relation avec le modèle Workflow (Un patient appartient à un workflow)
     */
    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

     // Relation avec le modèle DossierMedical
     public function dossiersMedicaux()
     {
         return $this->hasMany(DossierMedical::class, 'patients_id');
     }

     public function traitements()
    {
        return $this->hasMany(Traitement::class, 'patients_id');
    }
    public function  examens()
    {
        return $this->hasMany(Examen::class, 'patients_id');
    }
    public function personnelMedical()
    {
        return $this->belongsTo(PersonnelMedical::class, 'personnel_medical_id');
    }

}
