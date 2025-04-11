@extends('layouts.layout') 

@section('title', 'Examens')

@section('content')

    <div class="w3-container w3-padding w3-light-grey">
        <h3>Examens enregistrés</h3>
        <a href="{{ route('examens.create') }}" class="w3-button w3-blue w3-margin-bottom">+ Ajouter un Examen</a>

        <table class="w3-table w3-striped w3-bordered w3-white">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Personnel Médical</th>
                    <th>Type d'Examen</th>
                    <th>Laboratoire</th>
                    <th>Plage Référence</th>
                    <th>Valeur Critique</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examens as $examen)
                    <tr>
                        <td>{{ $examen->patient->nom }} {{ $examen->patient->prenom }}</td>
                        <td>{{ $examen->personnelMedical->user->name }} {{ $examen->personnelMedical->user->prenom }}</td>
                        <td>{{ $examen->type_examen }}</td>
                        <td>{{ $examen->nom_laboratoire }}</td>
                        <td>{{ $examen->plage_reference }}</td>
                        <td>{{ $examen->valeur_critique }}</td>
                        <td>
                            <a href="{{ route('examens.edit', $examen->id) }}" class="w3-button w3-small w3-teal">Modifier</a>
                            <form action="{{ route('examens.destroy', $examen->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="w3-button w3-small w3-red" onclick="return confirm('Supprimer cet examen ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($examens->isEmpty())
                    <tr>
                        <td colspan="7" class="w3-center">Aucun examen enregistré.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @endsection
