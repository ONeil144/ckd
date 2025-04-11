<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\PersonnelMedical;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examens';

    protected $fillable = [
        'patients_id',
        'personnel_medical_id',
        'type_examen',
        'nom_laboratoire',
        'plage_reference',
        'valeur_critique',
        'resultat',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patients_id');
    }

    public function personnelMedical()
    {
        return $this->belongsTo(PersonnelMedical::class, 'personnel_medical_id');
    }
   
}

