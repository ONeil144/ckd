<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\WorkflowController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/personnel/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard_personnel');
Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('workflows', WorkflowController::class);
    Route::resource('dossiers_medicaux', DossierMedicalController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('traitements', TraitementController::class);
    Route::resource('home', HomeController::class);
    Route::resource('examens', ExamenController::class);
    Route::resource('users', UserController::class);

});


require __DIR__.'/auth.php';
