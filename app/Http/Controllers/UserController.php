<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonnelMedical;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Afficher le formulaire d'édition pour un utilisateur
    public function edit($id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($id);
        
        // Retourner la vue d'édition avec l'utilisateur
        return view('users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:administrateur,personnel_medical',
            'specialite' => 'nullable|string|max:255',
        ]);

        // Trouver l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Mettre à jour les informations de l'utilisateur
        $user->name = $validated['name'];
        $user->prenom = $validated['prenom'];
        $user->email = $validated['email'];
        
        // Mise à jour du mot de passe si fourni
        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        // Mise à jour de l'avatar si fourni
        if ($request->hasFile('avatar')) {
            // Supprimer l'avatar existant (si nécessaire) et enregistrer le nouveau
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Mettre à jour le rôle
        $user->role = $validated['role'];

        // Mettre à jour la spécialité si c'est un personnel médical
        if ($validated['role'] === 'personnel_medical' && $validated['specialite']) {
            $user->personnelMedical->specialite = $validated['specialite'];
        }

        // Sauvegarder les changements
        $user->save();

        // Rediriger avec succès
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
       
        $personnel = PersonnelMedical::where('id', $id)->first();
       
        $userId = $personnel->user->id;

        $user = User::where('id',  $userId )->first();
        $user ->delete();

        $personnel->delete();

       

        return redirect()->route('profile.index')->with('success', 'Compte supprimé avec succès.');
    }
}
