<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PersonnelMedical;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * Afficher la liste des personnels médicaux.
     */
    public function index()
    {
        $personnels = User::where('role', 'personnel_medical')
                          ->with('personnelMedical')
                          ->get();

        return view('dashboard', compact('personnels'));
    }
}
