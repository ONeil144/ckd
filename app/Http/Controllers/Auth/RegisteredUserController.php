<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PersonnelMedical;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        // Validation des données envoyées par le formulaire
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'prenom'     => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar'     => ['nullable', 'image', 'max:2048'], // optionnel, image max 2MB
            'role'       => ['required', 'in:administrateur,personnel_medical'],
            // Validation conditionnelle pour la spécialité uniquement si le rôle est personnel_medical
            'specialite' => ['required_if:role,personnel_medical', 'string', 'max:255'],
        ]);

        // Génération automatique d'un code personnel alphanumérique unique
        do {
            $codePersonnel = Str::upper(Str::random(8));
        } while (User::where('code_personnel', $codePersonnel)->exists());

        // Gestion de l'avatar (si présent)
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Création de l'utilisateur avec le code personnel généré
        $user = User::create([
            'code_personnel' => $codePersonnel,
            'name'           => $request->name,
            'prenom'         => $request->prenom,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'avatar'         => $avatarPath,
            'role'           => $request->role,
        ]);

        // Si le rôle est personnel médical, créer une entrée associée dans la table personnel_medical
        try {
            PersonnelMedical::create([
                'specialite' => $request->specialite,
                'users_id'   => $user->id,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        

        event(new Registered($user));


        return redirect(route('dashboard'));
    }
}
