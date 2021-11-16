@extends('layouts.main')

@section('title', 'Pacientes')

@section('content')
    @include('components.add_new_patient')
    <div id="cards-container" class="row">
        @forelse ($patients as $patient)
            @include('components.patient_card')
        @empty
            @include('components.no_resource')
        @endforelse
    </div>
@endsection