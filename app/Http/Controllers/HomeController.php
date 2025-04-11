<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\DossierMedical;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer l'ID du personnel médical de l'utilisateur connecté
        $personnelMedicalId = Auth::user()->personnelMedical->id;

        // Compter les patients associés à ce personnel médical
        $patientsCount = Patient::where('personnel_medical_id', $personnelMedicalId)->count();

        $dossierToday = DossierMedical::where('personnel_medical_id', $personnelMedicalId)->count();

        return view('index', compact('patientsCount', 'dossierToday'));
    }
}
