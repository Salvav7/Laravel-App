@extends('layouts.template')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container mt-5">
    <h1>Historial Médico</h1>
    <button class="btn btn-sm text-white fw-bold border-0"
        style="background-color:#699bc9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); font-size: 1.1rem;"
        data-bs-toggle="modal" data-bs-target="#modalHistorial" onclick="limpiarModal()">
        + Nuevo
    </button>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Modal para agregar/editar historial -->
    <div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="modalHistorialLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHistorialLabel">Agregar/Editar Historial Médico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formHistorial" method="POST">
                        @csrf
                        <input type="hidden" id="historialId" name="id">
                        <div class="mb-3">
                            <label for="mascota" class="form-label">Mascota</label>
                            <select id="mascota" name="mascota_id" class="form-select">
                                @foreach($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="diagnostico" class="form-label">Diagnóstico</label>
                            <input type="text" class="form-control" id="diagnostico" name="diagnostico" required>
                        </div>
                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento</label>
                            <input type="text" class="form-control" id="tratamiento" name="tratamiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="medicamento" class="form-label">Medicamentos</label>
                            <input type="text" class="form-control" id="medicamentos" name="medicamentos" required>
                        </div>
                        <div class="mb-3">
                            <label for="veterinario" class="form-label">Veterinario</label>
                            <input type="text" class="form-control" id="veterinario" name="veterinario" required>
                        </div>
                        <button type="submit" class="btn btn-success" style="background-color: #699bc9;">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-3 custom-table">
        <thead>
            <tr class="table-dark">
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Diagnóstico</th>
                <th>Tratamiento</th>
                <th>Medicamentos</th>
                <th>Veterinario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial_medico as $historial)
                <tr>
                    <td>{{ $historial->mascota->nombre }}</td>
                    <td>{{ $historial->fecha }}</td>
                    <td>{{ $historial->diagnostico }}</td>
                    <td>{{ $historial->tratamiento }}</td>
                    <td>{{ $historial->medicamentos }}</td>
                    <td>{{ $historial->veterinario }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="editarHistorial('{{ $historial->id }}', '{{ $historial->mascota_id }}', '{{ $historial->fecha }}', '{{ $historial->diagnostico }}', '{{ $historial->tratamiento }}', '{{ $historial->medicamentos }}', '{{ $historial->veterinario }}')">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <form action="{{ route('historial_medico.destroy', $historial->id) }}" method="POST"
                            style="display: inline-block;" onsubmit="return confirmarEliminacion()">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function editarHistorial(id, mascota_id, fecha, diagnostico, tratamiento, medicamentos, veterinario) {
        document.getElementById('formHistorial').action = `{{ url('historial_medico') }}/${id}`;
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('formHistorial').appendChild(methodInput);

        document.getElementById('historialId').value = id;
        document.getElementById('mascota').value = mascota_id;
        document.getElementById('fecha').value = fecha;
        document.getElementById('diagnostico').value = diagnostico;
        document.getElementById('tratamiento').value = tratamiento;
        document.getElementById('medicamentos').value = medicamentos;
        document.getElementById('veterinario').value = veterinario;

        const modal = new bootstrap.Modal(document.getElementById('modalHistorial'));
        modal.show();
    }

    function limpiarModal() {
        document.getElementById('formHistorial').action = `{{ route('historial_medico.store') }}`;
        document.getElementById('formHistorial').reset();
        document.getElementById('formHistorial').querySelector('input[name="_method"]')?.remove();
    }

    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.');
    }
</script>
@endsection
