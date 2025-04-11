@extends('layouts.layout') 

@section('title', 'Dossiers médicaux')

@section('content')
<h2>Dossiers Médicaux</h2>
<p>Voici la liste des consultations</p>

<input class="w3-input w3-border w3-padding" type="text" placeholder="Recherche par code patient.." id="myInput" onkeyup="myFunction()">

<table class="w3-table-all w3-striped w3-margin-top" id="myTable">
    <tr>
        <th>Code Patient</th>
        <th>Personnel Médical</th>
        <th>Date Consultation</th>
        <th>Raison de la Consultation</th>
        <th>Observation</th>
        <th>Allergies</th>
        <th>Diagnostic</th>
    </tr>

    @foreach($dossiers as $dossier)
        <tr>
            <td>{{ $dossier->patient->code_personnel }}</td> <!-- Affichage du nom du patient -->
            <td>{{ $dossier->personnelMedical->user->name ?? 'N/A' }}  {{ $dossier->personnelMedical->user->prenom ?? 'N/A' }}</td>  <!-- Nom du personnel médical -->
            <td>{{ $dossier->consultationdate }}</td> <!-- Date de consultation -->
            <td>{{ $dossier->raisonsConsultations }}</td> <!-- Raison de la consultation -->
            <td>{{ $dossier->observation }}</td> <!-- Observation -->
            <td>{{ $dossier->allergies }}</td> <!-- Allergies -->
            <td>{{ $dossier->diagnostic }}</td> <!-- Diagnostic -->
        </tr>
        
    @endforeach
</table>

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

@endsection
