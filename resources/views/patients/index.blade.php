@extends('layouts.layout')

@section('title', 'Patient/list')

@section('content')
<a href="{{ route('patients.create') }}" class="w3-bar-item w3-button w3-blue">Enregistrer patient</a>
<p>Voici ici la liste des patients</p>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Recherche par code patient.." id="myInput" onkeyup="myFunction()">
<input class="w3-input w3-border w3-padding" type="text" placeholder="Recherche par stade.." id="filterstade" onkeyup="filtrerParstade()">

<table class="w3-table-all w3-striped w3-margin-top" id="myTable">
    <thead>
        <tr>
            <th>Code Personnel</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Ville</th>
            <th>Workflow</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>
                <span id="code_{{ $patient->id }}">{{ $patient->code_personnel }}</span>
                <button class="w3-button w3-small w3-green" onclick="copierCode('{{ $patient->id }}')">
                    <i class="fa fa-copy"></i>
                </button>
            </td>
            <td>{{ $patient->nom }}</td>
            <td>{{ $patient->prenom }}</td>
            <td>{{ $patient->ville }}</td>
            <td>{{ $patient->workflow->nom ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('patients.edit', $patient->id) }}" class="w3-button w3-blue">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w3-button w3-red" onclick="return confirm('Voulez-vous vraiment supprimer ce patient ?');">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 1; i < tr.length; i++) { 
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}

function filtrerParstade() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("filterstade");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}

function copierCode(patientId) {
    var codeElement = document.getElementById("code_" + patientId);
    var codePersonnel = codeElement.innerText;

    // Création d'un élément temporaire pour la copie
    var tempInput = document.createElement("input");
    tempInput.value = codePersonnel;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    // Affichage d'un message de confirmation
    alert("Code personnel copié : " + codePersonnel);
}
</script>

@endsection
