<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="w3-container w3-padding w3-indigo">
        <h2>Gestion des Utilisateurs du Personnel Médical</h2>
        <button class="w3-button w3-green" onclick="document.getElementById('addUserModal').style.display='block'">+ Ajouter Utilisateur</button>
    </div>
    
    <div class="w3-container w3-margin-top">
        <table class="w3-table w3-striped w3-bordered">
            <tr class="w3-light-grey">
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>Dr. Dupont</td>
                <td>dupont@example.com</td>
                <td>Médecin</td>
                <td>
                    <button class="w3-button w3-blue" onclick="editUser()">Modifier</button>
                    <button class="w3-button w3-red" onclick="deleteUser()">Supprimer</button>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Modal d'ajout utilisateur -->
    <div id="addUserModal" class="w3-modal">
        <div class="w3-modal-content w3-padding-large w3-card-4">
            <header class="w3-container w3-green">
                <span onclick="document.getElementById('addUserModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h2>Ajouter Utilisateur</h2>
            </header>
            <div class="w3-container">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <p>
        <label>Nom</label>
        <input class="w3-input" type="text" name="name" required>
    </p>
    <p>
        <label>Prénom</label>
        <input class="w3-input" type="text" name="prenom" required>
    </p>
    <p>
        <label>Email</label>
        <input class="w3-input" type="email" name="email" required>
    </p>
    <p>
        <label>Mot de passe</label>
        <input class="w3-input" type="password" name="password" required>
    </p>
    <p>
        <label>Confirmer mot de passe</label>
        <input class="w3-input" type="password" name="password_confirmation" required>
    </p>
    <p>
        <label>Avatar (optionnel)</label>
        <input class="w3-input" type="file" name="avatar" accept="image/*">
    </p>
    <p>
        <label>Rôle</label>
        <select class="w3-select" name="role" id="roleSelect" onchange="toggleSpeciality()" required>
            <option value="administrateur">Administrateur</option>
            <option value="personnel_medical">Personnel Médical</option>
        </select>
    </p>
    <p id="specialityField" style="display: none;">
        <label>Spécialité</label>
        <select class="w3-select" name="specialite">
            <option value="Médecin">Médecin</option>
            <option value="Infirmier">Infirmier</option>
            <option value="Chirurgien">Chirurgien</option>
            <option value="Anesthésiste">Anesthésiste</option>
        </select>
    </p>
    <button class="w3-button w3-blue" type="submit">Enregistrer</button>
</form>

            </div>
        </div>
    </div>
    <script>
        function toggleSpeciality() {
            var roleSelect = document.getElementById('roleSelect');
            var specialityField = document.getElementById('specialityField');
            if (roleSelect.value === 'personnel_medical') {
                specialityField.style.display = 'block';
            } else {
                specialityField.style.display = 'none';
            }
        }
    </script>
</body>
</html>