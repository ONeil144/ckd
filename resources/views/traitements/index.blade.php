@extends('layouts.layout')

@section('title', 'Liste des Traitements')

@section('content')

<header class="w3-container w3-padding w3-light-grey">
    <h1 class="w3-center">Liste des Traitements</h1>
</header>

<div class="w3-content w3-padding">
    @if(session('success'))
        <div class="w3-panel w3-green w3-padding">
            {{ session('success') }}
        </div>
    @endif

    <table class="w3-table w3-bordered w3-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Personnel Médical</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Médicaments</th>
                <th>Actions</th> <!-- Nouvelle colonne pour Modifier & Supprimer -->
            </tr>
        </thead>
        <tbody>
            @foreach ($traitements as $traitement)
            <tr>
                <td>{{ $traitement->id }}</td>
                <td>{{ $traitement->patient->nom ?? 'N/A' }} {{ $traitement->patient->prenom ?? '' }}</td>
                <td>{{ $traitement->personnelMedical->user->name ?? 'N/A' }}</td>
                <td>{{ $traitement->datedebut }}</td>
                <td>{{ $traitement->datefin }}</td>
                <td>
                    <ul>
                        @foreach ($traitement->medicaments as $medicament)
                            <li>{{ $medicament->nom }} ({{ $medicament->posologie }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <!-- Bouton Modifier -->
                    <a href="{{ route('traitements.edit', $traitement->id) }}" class="w3-button w3-yellow w3-small">Modifier</a>

                    <!-- Formulaire Supprimer -->
                    <form action="{{ route('traitements.destroy', $traitement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w3-button w3-red w3-small" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce traitement ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
