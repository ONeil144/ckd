@extends('layouts.layout')

@section('title', 'Patient/Modifier')

@section('content')

<!-- Conteneur principal -->
<div class="w3-container w3-padding-32" style="min-height: 80vh;">
    <div class="w3-card w3-white w3-padding-large w3-round w3-margin-top w3-margin-bottom" style="max-width: 600px; margin: auto;">
        <h2 class="w3-center">Modifier le Patient</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="w3-container" id="multiStepForm">
            @csrf
            @method('PUT') <!-- Méthode PUT pour mettre à jour -->

            <!-- Étape 1 -->
            <div id="etape1">
                <label class="w3-text-indigo"><b>Nom</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="nom" value="{{ old('nom', $patient->nom) }}" required>
                
                <label class="w3-text-indigo"><b>Prénom</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="prenom" value="{{ old('prenom', $patient->prenom) }}" required>
                
                <label class="w3-text-indigo"><b>Age</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="age" value="{{ old('age', $patient->age) }}" required>
                
                <label class="w3-text-indigo"><b>Email</b></label>
                <input class="w3-input w3-border w3-round required" type="email" name="email" value="{{ old('email', $patient->email) }}" required>

                <label class="w3-text-indigo"><b>Téléphone</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="phone" value="{{ old('phone', $patient->telephone) }}" required>

                <label class="w3-text-indigo"><b>Adresse</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="adresse" value="{{ old('adresse', $patient->adresse) }}" required>

                <label class="w3-text-indigo"><b>Ville</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="ville" value="{{ old('ville', $patient->ville) }}" required>

                <h2>Sexe</h2>
                <p>
                    <input class="w3-radio" type="radio" name="sexe" value="Masculin" {{ old('sexe', $patient->sexe) == 'Masculin' ? 'checked' : '' }}>
                    <label>Masculin</label>
                </p>
                <p>
                    <input class="w3-radio" type="radio" name="sexe" value="Féminin" {{ old('sexe', $patient->sexe) == 'Féminin' ? 'checked' : '' }}>
                    <label>Féminin</label>
                </p>

                <label class="w3-text-indigo"><b>Nationalité</b></label>
                <select class="w3-select w3-border required" name="nationalite" required>
                    <option value="" disabled>Choisir</option>
                    @foreach (['Algérienne', 'Angolaise', 'Béninoise', 'Française', 'Marocaine'] as $nationalite)
                        <option value="{{ $nationalite }}" {{ old('nationalite', $patient->nationalite) == $nationalite ? 'selected' : '' }}>{{ $nationalite }}</option>
                    @endforeach
                </select>

                <button type="button" class="w3-button w3-indigo w3-margin-top w3-round" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 2 -->
            <div id="etape2" style="display: none;">
                <label class="w3-text-indigo"><b>Poids (kg)</b></label>
                <input class="w3-input w3-border w3-round required" type="number" name="poids" value="{{ old('poids', $patient->poids) }}" required>

                <label class="w3-text-indigo"><b>Taille (cm)</b></label>
                <input class="w3-input w3-border w3-round required" type="number" name="taille" value="{{ old('taille', $patient->taille) }}" required>

                <label class="w3-text-indigo"><b>Profession</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="profession" value="{{ old('profession', $patient->profession) }}" required>

                <label class="w3-text-indigo"><b>Groupe Sanguin</b></label>
                <select class="w3-select w3-border required" name="groupe_sanguin" required>
                    <option value="" disabled>Choisir</option>
                    @foreach (['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $groupe)
                        <option value="{{ $groupe }}" {{ old('groupe_sanguin', $patient->groupe_sanguin) == $groupe ? 'selected' : '' }}>{{ $groupe }}</option>
                    @endforeach
                </select>

                <label class="w3-text-indigo"><b>Workflow</b></label>
                <select class="w3-select w3-border required" name="workflow_id" required>
                    <option value="" disabled>Choisir un workflow</option>
                    @foreach ($workflows as $workflow)
                        <option value="{{ $workflow->id }}" {{ old('workflow_id', $patient->workflow_id) == $workflow->id ? 'selected' : '' }}>
                            {{ $workflow->nom }}
                        </option>
                    @endforeach
                </select>

                <button type="button" class="w3-button w3-grey w3-margin-top w3-round" onclick="prevStep()">Retour</button>
                <button type="submit" class="w3-button w3-green w3-margin-top w3-round">Enregistrer</button>
            </div>

        </form>
    </div>
</div>

<script>
    function nextStep() {
        // Vérifier que tous les champs requis de l'étape 1 sont remplis
        let valid = true;
        document.querySelectorAll("#etape1 .required").forEach(function(input) {
            if (!input.value.trim()) {
                valid = false;
                input.classList.add("w3-border-red"); // Ajoute une bordure rouge si vide
            } else {
                input.classList.remove("w3-border-red");
            }
        });

        if (valid) {
            document.getElementById("etape1").style.display = "none";
            document.getElementById("etape2").style.display = "block";
        }
    }

    function prevStep() {
        document.getElementById("etape1").style.display = "block";
        document.getElementById("etape2").style.display = "none";
    }
</script>

@endsection
