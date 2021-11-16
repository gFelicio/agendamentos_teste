<div class="form-group">
    <label for="name">
        Nome do Paciente
    </label>
    <input type="text"
        class="form-control"
        name="name"
        id="name"
        placeholder="Nome do Paciente"
        @if ($routeName == 'patients.show')
            disabled="disabled"
            value="{{ $patient->name }}"
        @elseif ($routeName == 'patients.edit')
            value="{{ $patient->name }}"
        @endif>
</div>

<div class="form-group">
    <label for="cpf">
        CPF
    </label>
    <input type="text"
        class="form-control"
        name="cpf"
        id="cpf"
        placeholder="CPF do Paciente"
        @if ($routeName == 'patients.show')
            disabled="disabled"
            value="{{ $patient->cpf }}"
        @elseif ($routeName == 'patients.edit')
            value="{{ $patient->cpf }}"
        @endif>
</div>

<div class="form-group">
    <label for="phone">
        Telefone de Contato do Paciente
    </label>
    <input type="text"
        class="form-control"
        name="phone"
        id="phone"
        placeholder="Telefone do Paciente"
        @if ($routeName == 'patients.show')
            disabled="disabled"
            value="{{ $patient->phone }}"
        @elseif ($routeName == 'patients.edit')
            value="{{ $patient->phone }}"
        @endif>
</div>

<div class="form-group">
    <label for="email">
        E-Mail de Contato do Paciente
    </label>
    <input type="text"
        class="form-control"
        name="email"
        id="email"
        placeholder="E-mail do Paciente"
        @if ($routeName == 'patients.show')
            disabled="disabled"
            value="{{ $patient->email }}"
        @elseif ($routeName == 'patients.edit')
            value="{{ $patient->email }}"
        @endif>

    <input type="hidden"
        name="user_id"
        @if ($routeName == 'patients.show' || $routeName == 'patients.edit')
            value="{{ $patient->user_id }}"
        @else
            value="{{ auth()->user()->id }}"
        @endif>
</div>