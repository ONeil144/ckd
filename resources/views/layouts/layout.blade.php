<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PROJET_AI4CKD</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="cursor: default">

    <!-- Barre de navigation -->
    <div class="w3-sidebar w3-bar-block w3-border-bottom w3-animate-left w3-pink" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fermer &times;</button>
    <a href="{{ route('dashboard_personnel') }}" class="w3-bar-item w3-button">Dashboard</a>
    <a href="#" class="w3-bar-item w3-button" onclick="openModal('workflow')">Workflow</a>
    <div class="w3-dropdown-click">
    <button class="w3-button  w3-border-bottom" onclick="toggleDropdown('dropdown1')">Patient <i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block w3-border" id="dropdown1">
        <a href="{{ route('patients.index') }}" class="w3-bar-item w3-button"> Liste des patients</a>
        <a href="{{ route('patients.create') }}" class="w3-bar-item w3-button">Ajouter un patient</a>
        </div>
  </div>
  <div class="w3-dropdown-click">
    <button class="w3-button w3-border-bottom " onclick="toggleDropdown('dropdown2')">Dossier Médical  <i class="fa fa-caret-down"></i></button>
    <div class="w3-dropdown-content w3-bar-block w3-border" id="dropdown2">
      <a href="#" class="w3-bar-item w3-button" onclick="openModal('consulte')">Créer un dossier médical</a>
      <a href="{{ route('dossiers_medicaux.index') }}" class="w3-bar-item w3-button">Recherche un dossier médical</a>
      
    </div>
  </div>
   
    <div class="w3-dropdown-click">
    <button class="w3-button  w3-border-bottom" onclick="toggleDropdown('dropdown4')">Traitements <i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block w3-border" id="dropdown4">
        <a href="{{ route('traitements.create') }}" class="w3-bar-item w3-button">Ajouter un traitement</a>
        <a href="{{ route('traitements.index') }}" class="w3-bar-item w3-button">Les traitements Prescrits</a>
        </div>
    </div>

    <div class="w3-dropdown-click">
    <button class="w3-button  w3-border-bottom" onclick="toggleDropdown('dropdown5')">Examens <i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block w3-border" id="dropdown5">
        <a href="{{route('examens.create')}}" class="w3-bar-item w3-button">Enregistrer un examen</a>
        <a href="#" class="w3-bar-item w3-button">Liste des examens</a>
        </div>
    </div>
    <a href="#" class="w3-bar-item w3-button  w3-border-bottom">NOTIFICATION</a>

</div>


    <!-- Contenu principal -->
    <div class="w3-container w3-padding" id="main">
       <div class="w3-indigo w3-container">
            <button id="openNav" class="w3-button  w3-xlarge" onclick="w3_open()">&#9776;</button>
            
          <!-- Dropdown Paramètres Utilisateur -->
    <div class="w3-dropdown-click w3-right w3-margin">
        <button class="w3-button  w3-border w3-round-large" onclick="toggleDropdown('dropdown6')">
            {{ Auth::user()->name }}  {{ Auth::user()->prenom }}
            <i class="fa fa-caret-down"></i>
        </button>

        <div id="dropdown6" class="w3-dropdown-content w3-bar-block w3-border w3-white w3-right" style="min-width: 200px;">

            <!-- Déconnexion -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w3-bar-item w3-button w3-left-align">
                    <i class="fa fa-sign-out"></i> {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <div class="w3-container ">
                <span class="w3-tag w3-spin fa fa-plus w3-jumbo w3-red"></span>
                <span class="w3-tag  ">A</span>
                <span class="w3-tag w3-white">I</span>
                <span class="w3-tag  w3-yellow">4</span>
                <span class="w3-tag ">C</span>
                <span class="w3-tag w3-white">K</span>
                <span class="w3-tag ">D</span>
            </div>
 </div>

        <div class="w3-content w3-section" style="max-width:100%; max-height:200px; overflow:hidden; object-fit: cover;">
            <img class="mySlides" src="{{ asset('images/img_slide1.jpg') }}" style="width:100%; max-height:300px; object-fit:cover;">
            <img class="mySlides" src="{{ asset('images/img_slide2.jpg') }}" style="width:100%; max-height:300px; object-fit:cover;">
            <img class="mySlides" src="{{ asset('images/img_slide4.jpg') }}" style="width:100%; max-height:300px; object-fit:cover;">
        </div>

<!-- fenetre modale pour enregistrer une consultation -->

<div id="consulte" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-padding-large">
    <span onclick="closeModal('consulte')"
    class="w3-button w3-display-topright">&times;</span>
      <div class="w3-container w3-green">
      <h2>Enregistrer un dossier médical</h2>
      </div>
      <div class="w3-container">
      <form action="{{ route('dossiers_medicaux.store') }}" method="POST" class="w3-container">
            @csrf
            @if ($errors->any())
                <div class="w3-panel w3-red">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p>
                <label for="patients_id">Code personnel du patient</label>
                <input class="w3-input" type="text" name="code_personnel" id="patients_id" value="{{ old('patients_id') }}">
                @error('patients_id')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>
            <p>
                <label for="patients_id">Date consultation</label>
                <input class="w3-input" type="date" name="consultationdate" id="patients_id" value="{{ old('patients_id') }}">
                @error('consultationdate')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <p>
                <label for="allergies">Allergies</label>
                <input class="w3-input" type="text" name="allergies" id="allergies" value="{{ old('allergies') }}">
                @error('allergies')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <p>
                <label for="antecedents_medicals">Antécédents Médicaux</label>
                <input class="w3-input" type="text" name="antecedents_medicals" id="antecedents_medicals" value="{{ old('antecedents_medicals') }}">
                @error('antecedents_medicals')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <p>
                <label for="raisonsConsultations">Raison de la consultation</label>
                <input class="w3-input" type="text" name="raisonsConsultations" id="raisonsConsultations" value="{{ old('raisonsConsultations') }}">
                @error('raisonsConsultations')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <p>
                <label for="diagnostic">Diagnostic</label>
                <input class="w3-input" type="text" name="diagnostic" id="diagnostic" value="{{ old('diagnostic') }}">
                @error('diagnostic')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <p>
                <label for="observation">Observation</label>
                <input class="w3-input" type="text" name="observation" id="observation" value="{{ old('observation') }}">
                @error('observation')
                    <div class="w3-text-red">{{ $message }}</div>
                @enderror
            </p>

            <button class="w3-btn w3-blue-grey">Enregistrer</button>
        </form>

      </div>
    </div>
    </div>
    <!-- fin modale consultation -->

    <!-- debut modale workflow -->
    <div id="workflow" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-padding-large">
        <span onclick="closeModal('workflow')" class="w3-button w3-display-topright">&times;</span>
        <div class="w3-container w3-green">
            <h2>Créer workflow</h2>
        </div>
        <div class="w3-container">
            <form class="w3-container" action="{{ route('workflows.store') }}" method="POST">
            @csrf    
            <p>
            <label>Intitulé Workflow</label>
            <input class="w3-input" type="text" name="workflow_name" required>
        </p>
        <p>
            <label>Description du Workflow</label>
            <input class="w3-input" type="text" name="workflow_description">
        </p>
        <button class="w3-btn w3-blue-grey" type="submit">Créer</button>
            </form>
        </div>
    </div>
    </div>
    <!-- fin modale workflow -->
  </div>
  </div>
  <div class="w3-container w3-padding w3-section w3-margin-top" >
        @yield('content')
    </div>

    <!-- Pied de page -->
    <footer class="w3-container w3-purple w3-center w3-padding w3-section" >
        <p>© {{ date('Y') }} HACKATON - Tous droits réservés.</p>
    </footer>
    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("mySidebar").style.width = "25%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }


var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 5 seconds
}

function toggleDropdown(id) {
    // Fermer tous les dropdowns
    var dropdowns = document.getElementsByClassName("w3-dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        if (dropdowns[i].id !== id) {
            dropdowns[i].classList.remove("w3-show");
        }
    }

    // Afficher/Masquer le dropdown cliqué
    var dropdown = document.getElementById(id);
    dropdown.classList.toggle("w3-show");
}

// Fermer les dropdowns si on clique en dehors
window.onclick = function(event) {
    if (!event.target.matches('.w3-button')) {
        var dropdowns = document.getElementsByClassName("w3-dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].classList.remove("w3-show");
        }
    }
}

function openModal(id) {
    // Ferme toutes les autres modales avant d'en ouvrir une nouvelle
    var modals = document.getElementsByClassName("w3-modal");
    for (var i = 0; i < modals.length; i++) {
        modals[i].style.display = "none";
    }

    // Ouvre la modale souhaitée
    document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
  var modal = document.getElementById(id);
    if (event.target === modal || event.target.classList.contains('w3-display-topright')) {
        modal.style.display = 'none';
}
}


</script>


</body>
</html>
