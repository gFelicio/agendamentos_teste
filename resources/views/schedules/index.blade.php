@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')
    @include('components.add_new_schedule')
    <div id="cards-container" class="col-md-12">
        @forelse ($schedules as $schedule)
            @include('components.schedule_card')
        @empty
            @include('components.no_resource')
        @endforelse
    </div>
@endsection