@extends('layouts.layout')

@section('title', 'Modifier Examen')
@section('content')

<header class="w3-container w3-padding w3-light-grey">
    <h1 class="w3-center">Modification des Examens Médicaux</h1>
</header>

<div class="w3-content w3-padding">
    @if ($errors->any())
    <div class="w3-panel w3-red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" id="examen-form" class="w3-container w3-padding w3-card" action="{{ route('examens.update', $examen->id) }}">
        @csrf
        @method('PATCH') <!-- PATCH est utilisé pour la mise à jour d'un enregistrement existant -->

        <h2 class="w3-center">Informations sur l'Examen</h2>

        <p>
            <label for="code_personnel" class="w3-label">Code Personnel du patient:</label>
            <input type="text" id="code_personnel" name="code_personnel" class="w3-input" value="{{ old('code_personnel', $examen->patient->code_personnel) }}" required>
        </p>
        <p>
            <label for="type-examen" class="w3-label">Type d'examen :</label>
            <input type="text" id="type-examen" name="type_examen" class="w3-input" value="{{ old('type_examen', $examen->type_examen) }}" required>
        </p>

        <p>
            <label for="resultats" class="w3-label">Résultats :</label>
            <textarea id="resultats" name="resultat" class="w3-input" required>{{ old('resultat', $examen->resultat) }}</textarea>
        </p>

        <p>
            <label for="nom-laboratoire" class="w3-label">Nom du laboratoire :</label>
            <input type="text" id="nom-laboratoire" name="nom_laboratoire" class="w3-input" value="{{ old('nom_laboratoire', $examen->nom_laboratoire) }}" required>
        </p>

        <p>
            <label for="plage-references" class="w3-label">Plage de références :</label>
            <input type="text" id="plage-references" name="plage_reference" class="w3-input" value="{{ old('plage_reference', $examen->plage_reference) }}" placeholder="Ex: 3.5 - 5.5 g/dL" required>
        </p>

        <p>
            <label for="valeur-critiques" class="w3-label">Valeurs critiques :</label>
            <input type="text" id="valeur-critiques" name="valeur_critique" class="w3-input" value="{{ old('valeur_critique', $examen->valeur_critique) }}" placeholder="Ex: < 3.0 ou > 6.0" required>
        </p>

        <button type="submit" class="w3-button w3-blue w3-margin-top w3-block">Mettre à jour l'examen</button>
    </form>
</div>

<script>
    document.getElementById("examen-form").addEventListener("submit", function(event) {
        //event.preventDefault();  Empêche l'envoi du formulaire pour test
    });
</script>
@endsection
