@extends('layouts.main')

@section('title', 'Inserir Paciente')

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
        <h1>Insira um novo Paciente</h1>

        <form action="{{ route('patients.store') }}"
            method="POST">
            @csrf

            @include('components.patient_create_form')

            <input type="submit"
                value="Inserir Paciente"
                class="btn btn-primary">
        </form>
    </div>
@endsection