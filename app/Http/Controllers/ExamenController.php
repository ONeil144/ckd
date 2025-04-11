<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Patient;
use App\Models\PersonnelMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function index()
    {
        $examens = Examen::with(['patient', 'personnelMedical'])->get();
        return view('examen.index', compact('examens'));
    }

    public function create()
    {

        return view('examen.create');
    }

    public function store(Request $request)

    {


        $request->validate([
           'code_personnel' => 'required|string|exists:patients,code_personnel',
            'type_examen' => 'required|string',
            'nom_laboratoire' => 'required|string',
            'plage_reference' => 'required|string',
            'valeur_critique' => 'required|string',
            'resultat' => 'required|string',
        ]);


         // Trouver l'ID du patient à partir du code personnel
         $patient = Patient::where('code_personnel', $request->code_personnel)->first();
          // Si le patient n'est pas trouvé, retourner une erreur
         if (!$patient) {
             return redirect()->back()->withErrors(['code_personnel' => 'Le code personnel du patient est introuvable.']);
         }
         $personnel = Auth::user()->personnelMedical;

         if (!$personnel) {
             return redirect()->back()->withErrors(['error' => 'Aucun compte personnel médical associé à cet utilisateur.']);
         }

         $personnelMedicalId = $personnel->id;
        //Examen::create($request->all());
        Examen::create([
         'patients_id'=> $patient->id,
        'personnel_medical_id' => $personnelMedicalId,
        'type_examen' => $request->type_examen,
        'nom_laboratoire' => $request->nom_laboratoire,
        'plage_reference'=> $request->plage_reference,
        'valeur_critique' => $request->valeur_critique,
        'resultat' => $request->resultat,
        ]);

        return redirect()->route('examens.index')->with('success', 'Examen enregistré avec succès.');
    }

    public function show(Examen $examen)
    {
        return view('examen.show', compact('examen'));
    }

    public function edit($id)
    {

    $examen = Examen::findOrFail($id);  // Trouver l'examen par son ID
    return view('examen.edit', compact('examen'));  // Passer l'examen à la vue
    }

    public function update(Request $request, Examen $examen)
    {
        $request->validate([
            'code_personnel' => 'required|string|exists:patients,code_personnel',
            'type_examen' => 'required|string',
            'resultat' => 'required|string',
            'nom_laboratoire' => 'required|string',
            'plage_reference' => 'required|string',
            'valeur_critique' => 'required|string',
        ]);


        // Mettre à jour les données
        $patient = Patient::where('code_personnel', $request->code_personnel)->first();
        $personnelMedicalId = Auth::user()->personnelMedical->id;

        $examen->update([
            'patients_id' => $patient->id,
            'personnel_medical_id' => $personnelMedicalId,
            'type_examen' => $request->type_examen,
            'resultat' => $request->resultat,
            'nom_laboratoire' => $request->nom_laboratoire,
            'plage_reference' => $request->plage_reference,
            'valeur_critique' => $request->valeur_critique,
        ]);

        return redirect()->route('examens.index')->with('success', 'Examen mis à jour avec succès.');
    }

    public function destroy(Examen $examen)
    {
        $examen->delete();
        return redirect()->route('examens.index')->with('success', 'Examen supprimé.');
    }
}