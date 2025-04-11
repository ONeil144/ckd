<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifier l'utilisateur
        $request->authenticate();
    
       
    
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérification du rôle et redirection personnalisée
        if ($user->role === 'administrateur') {
            return redirect()->route('dashboard'); // ex: /admin/dashboard
        } elseif ($user->role === 'personnel_medical') {
            return redirect()->route('dashboard_personnel'); // ex: /personnel/dashboard
        }
    
        // Fallback si le rôle n’est pas reconnu
       
        return redirect()->route('login')->with('error', 'Rôle non autorisé.');
    }
    
    /**


     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
