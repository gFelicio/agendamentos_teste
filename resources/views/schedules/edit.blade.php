@extends('layouts.main')

@section('title', 'Editar Agendamento')

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
        @include('components.delete_schedule')
        <h1>Editar Agendamento {{ $schedule->id }} : : {{ $schedule->patient->name }}</h1>
        <form action="{{ route('schedules.update', $schedule->id) }}"
            method="POST">
            @csrf
            @method('PUT')

            @include('components.schedule_create_form')

            <input type="submit"
                value="Atualizar Agendamento"
                class="btn btn-primary">
        </form>
    </div>
@endsection