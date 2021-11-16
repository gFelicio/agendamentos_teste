@extends('layouts.main')

@section('title', 'Paciente '.$patient->name)

@section('content')
    @if ($patient->user_id == auth()->user()->id)
        @include('components.edit_patient_row')
    @endif

    <div id="resource-create-container"
        class="col-md-6 offset-md-3">
        <h1>Paciente : : {{ $patient->name }} </h1>
        @include('components.patient_create_form')
    </div>
@endsection