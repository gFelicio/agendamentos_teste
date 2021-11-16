<div class="row"
    id="delete_resource_row">
    <form action="{{ route('schedules.destroy', $schedule->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Você tem certeza que quer deletar este agendamento?')"
            class="btn btn-danger"
            title="Excluir Agendamento">
            Excluir Agendamento
        </button>
    </form>
</div>