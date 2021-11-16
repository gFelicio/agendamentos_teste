@extends('layouts.main')

@section('title', 'Editar Paciente')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="resource-create-container"
        class="col-md-6 offset-md-3">
        @include('components.delete_patient')
        <h1>Editar Paciente {{ $patient->id }} : : {{ $patient->name }}</h1>
        <form action="{{ route('patients.update', $patient->id) }}"
            method="POST">
            @csrf
            @method('PUT')

            @include('components.patient_create_form')

            <input type="submit"
                value="Atualizar Paciente"
                class="btn btn-primary">
        </form>
    </div>
@endsection