@extends('layouts.layout')

@section('content')
<div class="w3-container w3-margin-top">
    <h1>Editer le Workflow</h1>
    <form class="w3-container" action="{{ route('workflows.update', $workflow->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label>Intitulé Workflow</label>
            <input class="w3-input" type="text" name="workflow_name" value="{{ $workflow->nom }}" required>
        </p>
        <p>
            <label>Description du Workflow</label>
            <input class="w3-input" type="text" name="workflow_description" value="{{ $workflow->description }}">
        </p>
        <button class="w3-btn w3-blue-grey" type="submit">Mettre à jour</button>
    </form>
</div>
@endsection
