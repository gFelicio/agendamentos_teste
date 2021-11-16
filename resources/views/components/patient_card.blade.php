<div class="card col-md-3">

    <div class="card-body">

        <h5 class="card-title">
            {{ $patient->name }}
        </h5>
        <p>
            {{ $patient->cpf }}
        </p>
        <p>
            {{ $patient->email }}
        </p>

        @if ($patient->user_id == auth()->user()->id)
            <a href="{{ route('patients.edit', $patient->id) }}"
                class="btn btn-primary">
                Editar
            </a>
        @endif
    </div>
</div>