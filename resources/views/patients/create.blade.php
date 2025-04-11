@extends('layouts.layout')

@section('title', 'Patient/ajout')

@section('content')

<!-- Conteneur principal -->
<div class="w3-container w3-padding-32" style="min-height: 80vh;">
    <div class="w3-card w3-white w3-padding-large w3-round w3-margin-top w3-margin-bottom" style="max-width: 600px; margin: auto;">
        <h2 class="w3-center">Ajouter un Patient</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form action="{{ route('patients.store') }}" method="POST" class="w3-container" id="multiStepForm">

            @csrf

            <!-- Étape 1 -->
            <div id="etape1">
                <label class="w3-text-indigo"><b>Nom</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="nom" required>
                <label class="w3-text-indigo"><b>Prénom</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="prenom" required>
                <label class="w3-text-indigo"><b>Age</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="age" required>
                <label class="w3-text-indigo"><b>Email</b></label>
                <input class="w3-input w3-border w3-round required" type="email" name="email" required>

                <label class="w3-text-indigo"><b>Téléphone</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="phone" required>

                <label class="w3-text-indigo"><b>Adresse</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="adresse" required>

                <label class="w3-text-indigo"><b>Ville</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="ville" required>

                <h2>Sexe</h2>
                <p>
                    <input class="w3-radio" type="radio" name="sexe" value="Masculin">
                    <label>Masculin</label>
                </p>
                <p>
                    <input class="w3-radio" type="radio" name="sexe" value="Féminin">
                    <label>Féminin</label>
                </p>

                <label class="w3-text-indigo"><b>Nationalité</b></label>
                <select class="w3-select w3-border required" name="nationalite">
                    <option value="" disabled selected>Choisir</option>
                    <option value="Algérienne">Algérienne</option>
                    <option value="Angolaise">Angolaise</option>
                    <option value="Béninoise">Béninoise</option>
                    <option value="Botswanaise">Botswanaise</option>
                    <option value="Burkinabé">Burkinabé</option>
                    <option value="Burundaise">Burundaise</option>
                    <option value="Cap-Verdienne">Cap-Verdienne</option>
                    <option value="Camerounaise">Camerounaise</option>
                    <option value="Centrafricaine">Centrafricaine</option>
                    <option value="Comorienne">Comorienne</option>
                    <option value="Congolaise (RDC)">Congolaise (RDC)</option>
                    <option value="Congolaise (RC)">Congolaise (RC)</option>
                    <option value="Djiboutienne">Djiboutienne</option>
                    <option value="Égyptienne">Égyptienne</option>
                    <option value="Équato-Guinéenne">Équato-Guinéenne</option>
                    <option value="Érythréenne">Érythréenne</option>
                    <option value="Eswatinienne">Eswatinienne</option>
                    <option value="Éthiopienne">Éthiopienne</option>
                    <option value="Gabonaise">Gabonaise</option>
                    <option value="Gambienne">Gambienne</option>
                    <option value="Ghanéenne">Ghanéenne</option>
                    <option value="Guinéenne">Guinéenne</option>
                    <option value="Guinéenne-Bissau">Guinéenne-Bissau</option>
                    <option value="Ivoirienne">Ivoirienne</option>
                    <option value="Kényane">Kényane</option>
                    <option value="Lesothienne">Lesothienne</option>
                    <option value="Libérienne">Libérienne</option>
                    <option value="Libyenne">Libyenne</option>
                    <option value="Malagasy">Malagasy</option>
                    <option value="Malawienne">Malawienne</option>
                    <option value="Malienne">Malienne</option>
                    <option value="Marocaine">Marocaine</option>
                    <option value="Mauricienne">Mauricienne</option>
                    <option value="Mauritanienne">Mauritanienne</option>
                    <option value="Mozambicaine">Mozambicaine</option>
                    <option value="Namibienne">Namibienne</option>
                    <option value="Nigérienne">Nigérienne</option>
                    <option value="Nigériane">Nigériane</option>
                    <option value="Ougandaise">Ougandaise</option>
                    <option value="Rwandaise">Rwandaise</option>
                    <option value="Sahraouie">Sahraouie</option>
                    <option value="Santoméenne">Santoméenne</option>
                    <option value="Sénégalaise">Sénégalaise</option>
                    <option value="Seychelloise">Seychelloise</option>
                    <option value="Sierra-Léonaise">Sierra-Léonaise</option>
                    <option value="Somalienne">Somalienne</option>
                    <option value="Soudanaise">Soudanaise</option>
                    <option value="Sud-Africaine">Sud-Africaine</option>
                    <option value="Sud-Soudanaise">Sud-Soudanaise</option>
                    <option value="Tanzanienne">Tanzanienne</option>
                    <option value="Tchadienne">Tchadienne</option>
                    <option value="Togolaise">Togolaise</option>
                    <option value="Tunisienne">Tunisienne</option>
                    <option value="Zambienne">Zambienne</option>
                    <option value="Zimbabwéenne">Zimbabwéenne</option>
                </select>

                <button type="button" class="w3-button w3-indigo w3-margin-top w3-round" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 2 -->
            <div id="etape2" style="display: none;">
                <label class="w3-text-indigo"><b>Poids (kg)</b></label>
                <input class="w3-input w3-border w3-round required" type="number" name="poids" required>

                <label class="w3-text-indigo"><b>Taille (cm)</b></label>
                <input class="w3-input w3-border w3-round required" type="number" name="taille" required>

                <label class="w3-text-indigo"><b>Profession</b></label>
                <input class="w3-input w3-border w3-round required" type="text" name="profession" required>

                <label class="w3-text-indigo"><b>Groupe Sanguin</b></label>
                <select class="w3-select w3-border required" name="groupe_sanguin">
                    <option value="" disabled selected>Choisir</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>

                <label class="w3-text-indigo"><b>Workflow</b></label>
                <select class="w3-select w3-border required" name="workflow_id" required>
                    <option value="" disabled selected>Choisir un workflow</option>
                    @foreach ($workflows as $workflow)
                        <option value="{{ $workflow->id }}">{{ $workflow->nom }}</option>
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

