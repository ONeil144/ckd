<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

        // Spécifie explicitement le nom de la table
        protected $table = 'workflow';

    // Spécifie les champs qui peuvent être remplis par affectation
    protected $fillable = [
        'nom',
        'description',
        'personnel_medical_id',
    ];

    // Définir la relation entre Workflow et PersonnelMedical
    public function personnelMedical()
    {
        return $this->belongsTo(PersonnelMedical::class);
    }

    
    /**
     * Relation avec le modèle Patient (Un workflow peut être associé à plusieurs patients)
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}

