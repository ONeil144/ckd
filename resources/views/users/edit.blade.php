<x-app-layout>
<x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
 </x-slot>

<div class="w3-modal-content w3-padding-large w3-card-4">
    <header class="w3-container w3-green">
        <span onclick="document.getElementById('editUserModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <h2>Modifier Utilisateur</h2>
    </header>
    <div class="w3-container">
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <p>
                <label>Nom</label>
                <input class="w3-input" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </p>
            <p>
                <label>Prénom</label>
                <input class="w3-input" type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
            </p>
            <p>
                <label>Email</label>
                <input class="w3-input" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </p>
            <p>
                <label>Mot de passe</label>
                <input class="w3-input" type="password" name="password">
            </p>
            <p>
                <label>Confirmer mot de passe</label>
                <input class="w3-input" type="password" name="password_confirmation">
            </p>
            <p>
                <label>Avatar (optionnel)</label>
                <input class="w3-input" type="file" name="avatar" accept="image/*">
            </p>
            <p>
                <label>Rôle</label>
                <select class="w3-select" name="role" id="roleSelect" onchange="toggleSpeciality()" required>
                    <option value="administrateur" {{ $user->role == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                    <option value="personnel_medical" {{ $user->role == 'personnel_medical' ? 'selected' : '' }}>Personnel Médical</option>
                </select>
            </p>
            <p id="specialityField" style="{{ $user->role == 'personnel_medical' ? 'display:block;' : 'display:none;' }}">
                <label>Spécialité</label>
                <select class="w3-select" name="specialite">
                    <option value="Médecin" {{ $user->personnelMedical->specialite == 'Médecin' ? 'selected' : '' }}>Médecin</option>
                    <option value="Infirmier" {{ $user->personnelMedical->specialite == 'Infirmier' ? 'selected' : '' }}>Infirmier</option>
                    <option value="Chirurgien" {{ $user->personnelMedical->specialite == 'Chirurgien' ? 'selected' : '' }}>Chirurgien</option>
                    <option value="Anesthésiste" {{ $user->personnelMedical->specialite == 'Anesthésiste' ? 'selected' : '' }}>Anesthésiste</option>
                </select>
            </p>
            <button class="w3-button w3-blue" type="submit">Enregistrer</button>
        </form>
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

</x-app-layout>