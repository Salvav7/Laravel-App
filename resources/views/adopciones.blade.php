@extends('layouts.template')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container mt-5">
    <h1>Adopciones</h1>
    <button class="btn btn-sm text-white fw-bold border-0"
        style="background-color:#699bc9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); font-size: 1.1rem;"
        data-bs-toggle="modal" data-bs-target="#modalAdopcion" onclick="limpiarModal()">
        + Nueva Adopción
    </button>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Modal para agregar/editar adopción -->
    <div class="modal fade" id="modalAdopcion" tabindex="-1" aria-labelledby="modalAdopcionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdopcionLabel">Agregar/Editar Adopción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdopcion" method="POST">
                        @csrf
                        <input type="hidden" id="adopcionId" name="id">
                        <div class="mb-3">
                            <label for="mascota" class="form-label">Mascota</label>
                            <select id="mascota" name="mascota_id" class="form-select">
                                @foreach($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="adopcion" class="form-label">Fecha de adopción</label>
                            <input type="date" class="form-control" id="adopcion" name="adopcion">
                        </div>
                        <div class="mb-3">
                            <label for="pesp" class="form-label">Peso</label>
                            <input type="text" class="form-control" id="peso" name="peso" required>
                        </div>
                        <div class="mb-3">
                            <label for="talla" class="form-label">Talla</label>
                            <input type="text" class="form-control" id="talla" name="talla" required>
                        </div>
                        <div class="mb-3">
                            <label for="contacto" class="form-label">Contacto</label>
                            <input type="text" class="form-control" id="contacto" name="contacto" required>
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
                <th>Adopción</th>
                <th>Peso</th>
                <th>Talla</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopciones as $adopcion)
                <tr>
                    <td>{{ $adopcion->mascota->nombre }}</td>
                    <td>{{ $adopcion->adopcion }}</td>
                    <td>{{ $adopcion->peso }}</td>
                    <td>{{ $adopcion->talla }}</td>
                    <td>{{ $adopcion->contacto }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="editarAdopcion('{{ $adopcion->id }}', '{{ $adopcion->mascota_id }}', '{{ $adopcion->adopcion }}', '{{ $adopcion->peso }}', '{{ $adopcion->talla }}','{{ $adopcion->contacto }}')">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <form action="{{ route('adopcion.destroy', $adopcion->id) }}" method="POST"
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
    function editarAdopcion(id, mascota_id, adopcion, peso, tall, contacto) {
        document.getElementById('formAdopcion').action = `{{ url('adopcion') }}/${id}`;
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('formAdopcion').appendChild(methodInput);

        document.getElementById('adopcionId').value = id;
        document.getElementById('mascota').value = mascota_id;
        document.getElementById('adopcion').value = adopcion;
        document.getElementById('peso').value = peso;
        document.getElementById('talla').value = talla;
        document.getElementById('contacto').value = contacto;

        const modal = new bootstrap.Modal(document.getElementById('modalAdopcion'));
        modal.show();
    }

    function limpiarModal() {
        document.getElementById('formAdopcion').action = `{{ route('adopcion.store') }}`;
        document.getElementById('formAdopcion').reset();
        document.getElementById('formAdopcion').querySelector('input[name="_method"]')?.remove();
    }

    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar esta adopción? Esta acción no se puede deshacer.');
    }
</script>
@endsection
