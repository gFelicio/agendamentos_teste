<div class="form-group">
    <label for="patient_search">
        Paciente
    </label>
    <select name="patient_id"
        id="patient_search"
        class="form-control"
        @if ($routeName == 'schedules.show')
            disabled="disabled"
        @endif>
        <option value="0"
            selected
            disabled>
            Escolha o Paciente
        </option>
        @if ($routeName == 'schedules.create' || $routeName == 'schedules.edit')
            @forelse ($patients as $patient)
                <option value="{{ $patient->id }}"
                    name="patient_id">
                    {{ $patient->name }}
                </option>
            @empty
                <option value="#"
                    disabled>
                    Nenhum Paciente Cadastrado
                </option>
            @endforelse
        @else
            <option selected="selected"
                disabled="disabled"
                value="{{ $schedule->patient->id }}">
                {{ $schedule->patient->name }}
            </option>
        @endif
    </select>
</div>

<div class="form-group">
    <label for="date_set">
        Data Marcada
    </label>
    <input type="datetime-local"
        class="form-control"
        name="date_set"
        id="date_set"
        @if ($routeName == 'schedules.show')
            disabled="disabled"
            value="{{ $schedule->date_set }}"
        @elseif ($routeName == 'schedules.edit')
            value="{{ date_format(date_create($schedule->date_set), 'd/m/Y - H:i') }}"
        @endif>
</div>

<input type="hidden"
    name="user_id"
    @if ($routeName == 'schedules.create')
        value="{{ auth()->user()->id }}"
    @else
        value="{{ $schedule->user->id }}"
    @endif>
</div>