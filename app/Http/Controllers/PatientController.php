<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Workflow;
use App\Http\Controllers\WorkflowController;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Afficher la liste des patients.
     */
    public function index()
    {
    // Récupérer l'ID du personnel médical de l'utilisateur connecté
        $personnelMedicalId = Auth::user()->personnelMedical->id;

        // Récupérer les patients associés à ce personnel médical
        $patients = Patient::with('workflow')  // Charger la relation workflow
            ->where('personnel_medical_id', $personnelMedicalId)  // Filtrer par personnel médical
            ->orderBy('created_at', 'desc')  // Trier par date de création
            ->get();

        return view('patients.index', compact('patients'));
    }

    /**
     * Afficher le formulaire de création d'un patient.
     */
    public function create()
    {
        $personnelMedicalId = Auth::user()->personnelMedical->id;
       // Récupère les workflows créés par l'utilisateur connecté
    $workflows = Workflow::where('personnel_medical_id',  $personnelMedicalId)->get();

    return view('patients.create', compact('workflows'));
    }

    /**
     * Enregistrer un nouveau patient dans la base de données.
     */
    
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'age'            => 'required|string|max:255',
            'email'            => 'required|string|max:255',
            'nationalite'    => 'required|string|max:255',
            'sexe'           => 'required|in:Masculin,Féminin,Autre',
            'adresse'        => 'nullable|string|max:255',
            'ville'          => 'nullable|string|max:255',
            'poids'          => 'nullable|numeric',
            'taille'         => 'nullable|numeric',
            'profession'     => 'nullable|string|max:255',
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/|unique:patients,telephone',
            'groupe_sanguin' => 'nullable|string|max:10',
            'workflow_id'    => 'required|exists:workflow,id',
        ]);

        // Générer un code patient unique
        do {
            $codePersonnel = 'PA' . strtoupper(Str::random(6));
        } while (Patient::where('code_personnel', $codePersonnel)->exists());
        $personnelMedicalId = Auth::user()->personnelMedical->id;
        // Créer le patient
        Patient::create([
            'code_personnel' => $codePersonnel,
            'nom'            => $validatedData['nom'],
            'prenom'         => $validatedData['prenom'],
            'nationalite'    => $validatedData['nationalite'],
            'sexe'           => $validatedData['sexe'],
            'adresse'        => $validatedData['adresse'] ?? null,
            'ville'          => $validatedData['ville'] ?? null,
            'poids'          => $validatedData['poids'] ?? null,
            'taille'         => $validatedData['taille'] ?? null,
            'profession'     => $validatedData['profession'] ?? null,
            'telephone'      => $validatedData['phone'],
            'groupe_sanguin' => $validatedData['groupe_sanguin'] ?? null,
            'workflow_id'    => $validatedData['workflow_id'],
            'email' => $validatedData['email'],
            'age'   => $validatedData['age'],

            'personnel_medical_id' => $personnelMedicalId,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès.');
    }

    /**
     * Afficher un patient en détail.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Afficher le formulaire de modification d'un patient.
     */
    public function edit(Patient $patient)
    {
        $workflows = Workflow::all(); // Récupère tous les workflows
        return view('patients.edit', compact('patient', 'workflows'));
    }

    /**
     * Mettre à jour un patient dans la base de données.
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'nationalite'    => 'required|string|max:255',
            'sexe'           => 'required|in:Masculin,Féminin,Autre',
            'adresse'        => 'nullable|string|max:255',
            'ville'          => 'nullable|string|max:255',
            'poids'          => 'nullable|numeric',
            'taille'         => 'nullable|numeric',
            'profession'     => 'nullable|string|max:255',
            'phone'      => 'required|regex:/^\+?[0-9]{10,15}$/|unique:patients,telephone' . $patient->id,
            'groupe_sanguin' => 'nullable|string|max:10',
            'workflow_id'    => 'required|exists:workflow,id',
        ]);

        // Mettre à jour le patient
        $patient->update($validatedData);

        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès.');
    }

    /**
     * Supprimer un patient de la base de données.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }
}
