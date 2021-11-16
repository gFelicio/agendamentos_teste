@extends('layouts.main')

@section('title', 'Inserir Agendamento')

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
        <h1>Insira um novo Agendamento</h1>

        <form action="{{ route('schedules.store') }}"
            method="POST">
            @csrf

            @include('components.schedule_create_form')

            <input type="submit"
                value="Inserir Agendamento"
                class="btn btn-primary">
        </form>
    </div>
@endsection