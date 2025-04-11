@extends('layouts.layout')

@section('title', 'Traitement / Ajout')
@section('content')

<header class="w3-container w3-padding w3-light-grey">
    <h1 class="w3-center">Enregistrement des Traitements</h1>
</header>

<div class="w3-content w3-padding">
@if ($errors->any())
    <div class="w3-text-red w3-padding">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form id="traitement-form" class="w3-container w3-padding w3-card" method="POST" action="{{ route('traitements.store') }}">
        @csrf
        <h2 class="w3-center">Informations du Traitement</h2>

        <!-- Code Personnel du Patient -->
        <p>
            <label for="code_personnel" class="w3-label">Code Personnel du Patient :</label>
            <input type="text" id="code_personnel" name="code_personnel" class="w3-input @error('code_personnel') w3-border-red @enderror" value="{{ old('code_personnel') }}" required>
            @error('code_personnel')
                <div class="w3-text-red">{{ $message }}</div>
            @enderror
        </p>

        <!-- Personnel Médical ID (sera récupéré automatiquement à partir de l'utilisateur connecté) -->
        <input type="hidden" name="personnel_medical_id" value="{{ Auth::user()->personnelMedical->id }}">

        <p>
            <label for="date-debut-traitement" class="w3-label">Date de début :</label>
            <input type="date" id="date-debut-traitement" name="datedebut" class="w3-input @error('datedebut') w3-border-red @enderror" value="{{ old('datedebut') }}" required>
            @error('datedebut')
                <div class="w3-text-red">{{ $message }}</div>
            @enderror
        </p>
        <p>
            <label for="date-fin-traitement" class="w3-label">Date de fin :</label>
            <input type="date" id="date-fin-traitement" name="datefin" class="w3-input @error('datefin') w3-border-red @enderror" value="{{ old('datefin') }}" required>
            @error('datefin')
                <div class="w3-text-red">{{ $message }}</div>
            @enderror
        </p>

        <h2 class="w3-center">Médicaments Prescrits</h2>
        <div id="medicaments-list">
            <div class="medicament-entry">
                <p>
                    <label class="w3-label">Nom du médicament :</label>
                    <input type="text" name="medicament[]" class="w3-input @error('medicament.*') w3-border-red @enderror" required>
                    @error('medicament.*')
                        <div class="w3-text-red">{{ $message }}</div>
                    @enderror
                </p>
                <p>
                    <label class="w3-label">Dosage :</label>
                    <input type="text" name="dose[]" class="w3-input @error('dose.*') w3-border-red @enderror" required>
                    @error('dose.*')
                        <div class="w3-text-red">{{ $message }}</div>
                    @enderror
                </p>
            </div>
        </div>
        <button type="button" id="add-medicament" class="w3-button w3-green w3-margin-top">Ajouter un médicament</button>

        <button type="submit" class="w3-button w3-blue w3-margin-top w3-block">Enregistrer les informations</button>
    </form>
</div>

<script>
    document.getElementById("add-medicament").addEventListener("click", function() {
        let medicamentsList = document.getElementById("medicaments-list");

        let newEntry = document.createElement("div");
        newEntry.classList.add("medicament-entry");
        newEntry.innerHTML = `
            <p>
                <label class="w3-label">Nom du médicament :</label>
                <input type="text" name="medicament[]" class="w3-input" required>
            </p>
            <p>
                <label class="w3-label">Dosage :</label>
                <input type="text" name="dose[]" class="w3-input" required>
            </p>
        `;
        medicamentsList.appendChild(newEntry);
    });

    document.getElementById("traitement-form").addEventListener("submit", function(event) {
        
        alert("Voulez vous vraiment enregistrer le traitement ?");
    });
</script>

@endsection
