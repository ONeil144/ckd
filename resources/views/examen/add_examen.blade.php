@extends('layouts.layout')

@section('title', 'Examen/ajout')
@section('content')

<header class="w3-container w3-padding w3-light-grey">
        <h1 class="w3-center">Enregistrement des Examens Médicaux</h1>
    </header>
    
    <div class="w3-content w3-padding">
        <form id="examen-form" class="w3-container w3-padding w3-card">
            <h2 class="w3-center">Informations sur l'Examen</h2>

            <p>
                <label for="type-examen" class="w3-label">Numéro du dossier médical :</label>
                <input type="text" id="type-examen" name="dossierMedical" class="w3-input" required>
            </p>
            <p>
                <label for="type-examen" class="w3-label">Type d'examen :</label>
                <input type="text" id="type-examen" name="type_examen" class="w3-input" required>
            </p>

            <p>
                <label for="resultats" class="w3-label">Résultats :</label>
                <textarea id="resultats" name="resultats" class="w3-input" required></textarea>
            </p>

            <p>
                <label for="nom-laboratoire" class="w3-label">Nom du laboratoire :</label>
                <input type="text" id="nom-laboratoire" name="nom_laboratoire" class="w3-input" required>
            </p>

            <p>
                <label for="plage-references" class="w3-label">Plage de références :</label>
                <input type="text" id="plage-references" name="plage_references" class="w3-input" placeholder="Ex: 3.5 - 5.5 g/dL" required>
            </p>

            <p>
                <label for="valeur-critiques" class="w3-label">Valeurs critiques :</label>
                <input type="text" id="valeur-critiques" name="valeur_critiques" class="w3-input" placeholder="Ex: < 3.0 ou > 6.0" required>
            </p>

            <button type="submit" class="w3-button w3-blue w3-margin-top w3-block">Enregistrer l'examen</button>
        </form>
    </div>

    <script>
        document.getElementById("examen-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche l'envoi du formulaire pour test
            alert("Examen enregistré avec succès !");
        });
    </script>
@endsection