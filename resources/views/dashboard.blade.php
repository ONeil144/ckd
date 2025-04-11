<x-app-layout>
    <!-- Vérification du rôle de l'utilisateur connecté -->
    @if(Auth::user()->role === 'administrateur')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="w3-container w3-padding w3-indigo">
            <h2>Gestion des Utilisateurs du Personnel Médical</h2>
            <button class="w3-button w3-green" onclick="document.getElementById('addUserModal').style.display='block'">+ Ajouter Utilisateur</button>
        </div>
        
        <div class="w3-container w3-margin-top">
            <table class="w3-table w3-striped w3-bordered">
            <tr>
                    <td>Nom et Prenoms</td>
                    <td>Email</td>
                    <td>Spécialité</td>
                    <td>Action</td>
            </tr>        
                @foreach ($personnels as $personnel)
                <tr>
                    <td>{{ $personnel->name }} {{ $personnel->prenom }}</td>
                    <td>{{ $personnel->email }}</td>
                    <td>{{ $personnel->personnelMedical->specialite?? 'Non spécifié' }}</td>
                    <td>
                    <a href="{{ route('users.edit', $personnel->id) }}" class="w3-button w3-small w3-teal">Modifier</a>

                            <form action="{{ route('users.destroy', $personnel->personnelMedical->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="w3-button w3-small w3-red" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                    </td>
                </tr>
                @endforeach
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
    @else
        <!-- Message pour les utilisateurs non administrateurs -->
        <div class="w3-container w3-padding w3-red">
            <h2>Accès refusé</h2>
            <p>Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
        </div>
    @endif

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
</x-app-layout>
