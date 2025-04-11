<?php

namespace App\Http\Controllers;

use App\Models\DossierMedical;
use App\Models\Patient;
use App\Models\PersonnelMedical;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workflow;
use Illuminate\Support\Facades\Auth;

class DossierMedicalController extends Controller
{
    public function index()
    {
        // Récupérer tous les dossiers médicaux avec les relations patient, personnel médical et utilisateur associé
        $dossiers = DossierMedical::with(['patient', 'personnelMedical.user'])->get();
    
        return view('dossiers_medicals.index', compact('dossiers'));
    }
    

    public function create()
    {
        // Récupérer les patients et le personnel médical pour le formulaire
        $patients = Patient::all();
        $personnel = PersonnelMedical::all();
        return view('dossiers_medicaux.create', compact('patients', 'personnel'));
    }

    public function store(Request $request)
    {
    
        // Valider les données entrantes
        $request->validate([
            'code_personnel' => 'required|string|exists:patients,code_personnel', // Vérifie si le code personnel existe
            'consultationdate' => 'required|date',
            'raisonsConsultations' => 'required|string',
            'diagnostic' => 'required|string',
            'observation' => 'required|string',
            'antecedents_medicals' => 'required|string',
            'allergies' => 'nullable|string',
        ]);
    
        // Trouver l'ID du patient à partir du code personnel
        $patient = Patient::where('code_personnel', $request->code_personnel)->first();
    
        if (!$patient) {
            return redirect()->back()->withErrors(['code_personnel' => 'Le code personnel du patient est introuvable.']);
        }

        $personnelMedicalId = Auth::user()->personnelMedical->id;
    
        // Création du dossier médical avec l'ID du patient récupéré
        DossierMedical::create([
            'patients_id' => $patient->id, // Associer l'ID du patient
            'personnel_medical_id' =>  $personnelMedicalId,
            'consultationdate' => $request->consultationdate,
            'raisonsConsultations' => $request->raisonsConsultations,
            'diagnostic' => $request->diagnostic,
            'observation' => $request->observation,
            'allergies' => $request->allergies,
            'antecedents_medicaux' => $request->antecedents_medicals,
        ]);
    
        return redirect()->route('dossiers_medicaux.index')->with('success', 'Dossier médical ajouté avec succès.');
    }
    

    public function show(DossierMedical $dossierMedical)
    {
        return view('dossiers_medicaux.show', compact('dossierMedical'));
    }

    // Autres méthodes comme edit, update, destroy...
}
