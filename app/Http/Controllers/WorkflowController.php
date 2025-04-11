<?php

namespace App\Http\Controllers;

use App\Models\Workflow;
use App\Models\PersonnelMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkflowController extends Controller
{
    // Afficher tous les workflows
    public function index()
    {
        $workflows = Workflow::all(); // Récupérer tous les workflows
        return view('workflows.index', compact('workflows'));
    }

    // Afficher un workflow spécifique
    public function show(Workflow $workflow)
    {
        return view('workflows.show', compact('workflow'));
    }

    // Afficher le formulaire de création d'un workflow
    public function create()
    {
        // Récupérer tous les personnels médicaux pour la sélection
        $personnels = PersonnelMedical::all();
        return view('workflows.create', compact('personnels'));
    }

    // Enregistrer un nouveau workflow
    public function store(Request $request)
    {
       
        // Validation des données
        $request->validate([
            'workflow_name' => 'required|string|max:255',
            'workflow_description' => 'nullable|string',
        ]);
       
        // Création du workflow
        $personnelMedicalId = Auth::user()->personnelMedical->id;
        Workflow::create([
           
            'nom' => $request->workflow_name,
            'description' => $request->workflow_description,
            'personnel_medical_id' => $personnelMedicalId,
        ]);

        return redirect()->route('workflows.index')->with('success', 'Workflow créé avec succès.');
    }

    // Afficher le formulaire de modification d'un workflow
    public function edit(Workflow $workflow)
    {
        $personnels = PersonnelMedical::all();
        return view('workflows.edit', compact('workflow', 'personnels'));
    }

    // Mettre à jour un workflow existant
    public function update(Request $request, Workflow $workflow)
    {
        // Validation des données
        $request->validate([
            'workflow_name' => 'required|string|max:255',
            'workflow_description' => 'nullable|string',
            
        ]);

        // Mise à jour du workflow
        $personnelMedicalId = Auth::user()->personnelMedical->id;
        $workflow->update([
            'nom' => $request->workflow_name,
            'description' => $request->workflow_description,
            'personnel_medical_id' => $personnelMedicalId ,
        ]);

        return redirect()->route('workflows.index')->with('success', 'Workflow mis à jour avec succès.');
    }

    // Supprimer un workflow
    public function destroy(Workflow $workflow)
    {
        $workflow->delete();
        return redirect()->route('workflows.index')->with('success', 'Workflow supprimé avec succès.');
    }
}

