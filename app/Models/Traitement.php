<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\PersonnelMedical;

class Traitement extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'personnel_medical_id',
        'datedebut',
        'datefin',
    ];

    // Relations
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function personnelMedical()
    {
        return $this->belongsTo(PersonnelMedical::class, 'personnel_medical_id');
    }

    public function medicaments()
    {
        return $this->hasMany(Medicament::class);
    }
}

