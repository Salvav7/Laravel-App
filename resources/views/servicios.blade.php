@extends('layouts.template')

@section('content')


<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container mt-5">
    <h1>Servicios</h1>
    <button  
        class="btn btn-sm text-white fw-bold border-0" 
        style="background-color: #699bc9;; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); font-size: 1.1rem;" 
        data-bs-toggle="modal" 
        data-bs-target="#modalServicio" 
        onclick="limpiarModal()">
        + Agregar Servicio
    </button>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="modalServicioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalServicioLabel">Agregar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formServicio" method="POST" action="{{ route('servicios.store') }}">
                        @csrf
                        <input type="hidden" id="servicioId" name="id">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required min="0">
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
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->descripcion }}</td>
                <td>${{ number_format($servicio->precio, 2) }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editarServicio('{{ $servicio->id }}', '{{ $servicio->nombre }}', '{{ $servicio->descripcion }}', '{{ $servicio->precio }}')">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmarEliminacion()">
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
    function editarServicio(id, nombre, descripcion, precio) {
        document.getElementById('formServicio').action = `/servicios/${id}`;
        document.getElementById('formServicio').method = 'POST';

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('formServicio').appendChild(methodInput);

        document.getElementById('nombre').value = nombre;
        document.getElementById('descripcion').value = descripcion;
        document.getElementById('precio').value = precio;
        document.getElementById('modalServicioLabel').textContent = 'Editar Servicio';

        new bootstrap.Modal(document.getElementById('modalServicio')).show();
    }

    function limpiarModal() {
        document.getElementById('formServicio').action = '{{ route('servicios.store') }}';
        document.querySelector('#formServicio input[name="_method"]')?.remove();

        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('modalServicioLabel').textContent = 'Agregar Servicio';
    }

    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar este servicio? Esta acción no se puede deshacer.');
    }

    function validarFormularioServicio() {
        const nombre = document.getElementById('nombre').value.trim();
        const descripcion = document.getElementById('descripcion').value.trim();
        const precio = document.getElementById('precio').value;

        if (nombre === '') {
            alert('Por favor, ingresa un nombre para el servicio.');
            return false;
        }

        if (descripcion === '') {
            alert('Por favor, ingresa una descripción del servicio.');
            return false;
        }

        if (isNaN(precio) || precio <= 0) {
            alert('Por favor, ingresa un precio válido.');
            return false;
        }

        return true;
    }
</script>

@endsection

