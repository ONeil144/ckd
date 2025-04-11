@extends('layouts.layout')

@section('title', 'Tableau de Bord')

@section('content')
    <div class="w3-row-padding w3-margin-top">
        <div class="w3-third">
            <div class="w3-card w3-padding w3-blue w3-center">
                <h3>Patients</h3>
                <p><i class="fa fa-users w3-xxlarge"></i></p>
                <p>{{ $patientsCount }} Patients enregistrés</p>
                <a href="{{ route('patients.index') }}" class="w3-button w3-white w3-round">Voir plus</a>
            </div>
        </div>
        <div class="w3-third">
            <div class="w3-card w3-padding w3-green w3-center">
                <h3>Dossier Médical</h3>
                <p><i class="fa fa-file-medical w3-xxlarge"></i></p>
                <p>{{ $dossierToday }} Dossiers créés </p>
                <a href="{{ route('dossiers_medicaux.index') }}" class="w3-button w3-white w3-round">Voir plus</a>
            </div>
        </div>
        <div class="w3-third">
            <div class="w3-card w3-padding w3-red w3-center">
                <h3>Rendez-vous</h3>
                <p><i class="fa fa-calendar w3-xxlarge"></i></p>
                <p>0 Rendez-vous à venir</p>
                <a href="#" class="w3-button w3-white w3-round">Voir plus</a>
            </div>
        </div>
    </div>
@endsection
