<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PersonnelMedical;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TraitementController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // On récupère uniquement les traitements associés au personnel médical connecté
        $traitements = Traitement::with(['patient', 'personnelMedical.user', 'medicaments'])
            ->where('personnel_medical_id', $user->personnelMedical->id)
            ->get();
    
        return view('traitements.index', compact('traitements'));
    }

    public function create()
    {
        return view('traitements.create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'code_personnel' => 'required|string|exists:patients,code_personnel',
            'datedebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:datedebut',
            'medicament.*' => 'required|string',
            'dose.*' => 'required|string',
        ]);

         // Trouver l'ID du patient à partir du code personnel
         $patient = Patient::where('code_personnel', $request->code_personnel)->first();
          // Si le patient n'est pas trouvé, retourner une erreur
         if (!$patient) {
             return redirect()->back()->withErrors(['code_personnel' => 'Le code personnel du patient est introuvable.']);
         }

    try {
        
         $traitement = Traitement::create([
            'patient_id' => $patient->id, 
            'personnel_medical_id' => $request->personnel_medical_id,
            'datedebut' => $request->datedebut,
            'datefin' => $request->datefin,
        ]);

        foreach ($request->medicament as $key => $nom) {
            $traitement->medicaments()->create([
                'nom' => $nom,
                'posologie' => $request->dose[$key],
            ]);
        }

        // Si tout se passe bien, rediriger avec un message de succès
        return redirect()->route('traitements.index')->with('success', 'Traitement et médicaments enregistrés.');
    } catch (\Exception $e) {
      // Log l'erreur
      Log::error('Erreur lors de la création du traitement : ' . $e->getMessage());
      Log::error('Erreur complète : ' . $e->getTraceAsString());
        // Si une erreur se produit lors de la création, rediriger avec une erreur
        return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement du traitement.']);
    }

    }
    public function edit(Traitement $traitement)
    {
        return view('traitements.edit', compact('traitement'));
    }

    public function update(Request $request, Traitement $traitement)
    {
        $request->validate([
            'datedebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:datedebut',
            'medicaments.*.nom' => 'required|string',
            'medicaments.*.posologie' => 'required|string',
        ]);
    
        // Mise à jour des infos du traitement
        $traitement->update([
            'datedebut' => $request->datedebut,
            'datefin' => $request->datefin,
        ]);
    
        $submittedIds = [];
    
        foreach ($request->medicaments as $medicamentData) {
            if (isset($medicamentData['id'])) {
                // Médicament existant : on le met à jour
                $medicament = $traitement->medicaments()->where('id', $medicamentData['id'])->first();
                if ($medicament) {
                    $medicament->update([
                        'nom' => $medicamentData['nom'],
                        'posologie' => $medicamentData['posologie'],
                    ]);
                    $submittedIds[] = $medicament->id;
                }
            } else {
                // Nouveau médicament
                $newMedicament = $traitement->medicaments()->create([
                    'nom' => $medicamentData['nom'],
                    'posologie' => $medicamentData['posologie'],
                ]);
                $submittedIds[] = $newMedicament->id;
            }
        }
    
        // Suppression des médicaments supprimés dans le formulaire
        $traitement->medicaments()
            ->whereNotIn('id', $submittedIds)
            ->delete();
    
        return redirect()->route('traitements.index')->with('success', 'Traitement et médicaments mis à jour avec succès.');
    }
    

    public function destroy(Traitement $traitement)
    {
        $traitement->delete();

        return redirect()->route('traitements.index')->with('success', 'Traitement supprimé avec succès.');
    }
}
