<div class="row"
    id="delete_resource_row">
    <form action="{{ route('patients.destroy', $patient->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Você tem certeza que quer deletar este paciente?')"
            class="btn btn-danger"
            title="Excluir Paciente">
            Excluir Paciente
        </button>
    </form>
</div>