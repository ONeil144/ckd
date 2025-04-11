<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierMedical extends Model
{
    use HasFactory;

    // Propriétés qui peuvent être assignées en masse
    protected $fillable = [
        'patients_id', 
        'personnel_medical_id', 
        'consultationdate', 
        'raisonsConsultations', 
        'diagnostic', 
        'observation', 
        'allergies',
        'antecedents_medicaux',
    ];

    // Relation avec le modèle Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patients_id');
    }

    // Relation avec le modèle PersonnelMedical
    public function personnelMedical()
    {
        return $this->belongsTo(PersonnelMedical::class, 'personnel_medical_id');
    }

}

