@extends('layouts.layout')

@section('title', 'Modifier Traitement')

@section('content')

<header class="w3-container w3-padding w3-light-grey">
    <h1 class="w3-center">Modifier un Traitement</h1>
</header>

<div class="w3-content w3-padding">
    <form class="w3-container w3-card w3-padding" method="POST" action="{{ route('traitements.update', $traitement->id) }}">
        @csrf
        @method('PUT')

        <p>
            <label for="datedebut" class="w3-label">Date de début :</label>
            <input type="date" name="datedebut" id="datedebut" class="w3-input" value="{{ old('datedebut', $traitement->datedebut) }}" required>
        </p>

        <p>
            <label for="datefin" class="w3-label">Date de fin :</label>
            <input type="date" name="datefin" id="datefin" class="w3-input" value="{{ old('datefin', $traitement->datefin) }}" required>
        </p>

        <!-- Patient (lecture seule) -->
        <p>
            <label class="w3-label">Patient :</label>
            <input class="w3-input w3-light-grey" type="text" value="{{ $traitement->patient->nom }}" disabled>
        </p>

        <h3 class="w3-center">Médicaments associés</h3>
        <div id="medicaments-list">
            @foreach ($traitement->medicaments as $index => $medicament)
                <div class="medicament-entry w3-margin-bottom">
                    <input type="hidden" name="medicaments[{{ $index }}][id]" value="{{ $medicament->id }}">
                    <p>
                        <label class="w3-label">Nom du médicament :</label>
                        <input type="text" name="medicaments[{{ $index }}][nom]" class="w3-input" value="{{ $medicament->nom }}" required>
                    </p>
                    <p>
                        <label class="w3-label">Posologie :</label>
                        <input type="text" name="medicaments[{{ $index }}][posologie]" class="w3-input" value="{{ $medicament->posologie }}" required>
                    </p>
                    <button type="button" class="w3-button w3-red remove-medicament">Supprimer</button>
                    <hr>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-medicament" class="w3-button w3-green">Ajouter un médicament</button>

        <button type="submit" class="w3-button w3-blue w3-block w3-margin-top">Mettre à jour</button>
    </form>
</div>

<script>
    let index = {{ $traitement->medicaments->count() }};
    document.getElementById("add-medicament").addEventListener("click", function () {
        const container = document.createElement("div");
        container.classList.add("medicament-entry", "w3-margin-bottom");
        container.innerHTML = `
            <p>
                <label class="w3-label">Nom du médicament :</label>
                <input type="text" name="medicaments[${index}][nom]" class="w3-input" required>
            </p>
            <p>
                <label class="w3-label">Posologie :</label>
                <input type="text" name="medicaments[${index}][posologie]" class="w3-input" required>
            </p>
            <button type="button" class="w3-button w3-red remove-medicament">Supprimer</button>
            <hr>
        `;
        document.getElementById("medicaments-list").appendChild(container);
        index++;
    });

    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("remove-medicament")) {
            e.target.closest(".medicament-entry").remove();
        }
    });
</script>

@endsection
