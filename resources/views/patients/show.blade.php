@extends('layouts.main')

@section('title', 'Paciente '.$patient->name)

@section('content')
    @include('components.edit_patient_row')
    <div id="resource-create-container"
        class="col-md-6 offset-md-3">
        <h1>Paciente : : {{ $patient->name }} </h1>
        @include('components.patient_create_form')
    </div>
@endsection