<div class="card col-md-3">

    <div class="card-body">

        <h5 class="card-title">
            Agendamento de {{ $schedule->patient->name }}
        </h5>
        <p>
            Data agendada: {{ date_format(date_create($schedule->date_set), 'd/m/Y - H:i') }}
        </p>
        <p>
            Médico: {{ $schedule->user->name }}
        </p>

        @if ($schedule->user_id == auth()->user()->id)
            <a href="{{ route('schedules.edit', $schedule->id) }}"
                class="btn btn-primary">
                Editar
            </a>
        @endif
    </div>
</div>