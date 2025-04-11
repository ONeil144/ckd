@extends('layouts.layout')

@section('content')
    <h1>Liste des Workflows</h1>

    <table class="w3-table w3-striped w3-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workflows as $workflow)
                <tr>
                    <td>{{ $workflow->nom }}</td>
                    <td>{{ $workflow->description }}</td>
                    <td>
                        <a href="{{ route('workflows.edit', $workflow->id) }}" class="w3-button w3-blue">Modifier</a>
                        <form action="{{ route('workflows.destroy', $workflow->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce workflow ?')" class="w3-button w3-red">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
