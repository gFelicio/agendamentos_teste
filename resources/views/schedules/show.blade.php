@extends('layouts.main')

@section('title', 'Agendamento '.$schedule->id)

@section('content')
    @include('components.edit_schedule_row')
    <div id="resource-create-container"
        class="col-md-6 offset-md-3">
        <h1>Agendamento : : {{ $schedule->id }} </h1>
        @include('components.schedule_create_form')
    </div>
@endsection