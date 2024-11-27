@extends('layouts.template')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <div class="container mt-5">
        <h1>Mascotas</h1>
        <button class="btn btn-sm text-white fw-bold border-0"
            style="background-color:#699bc9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); font-size: 1.1rem;"
            data-bs-toggle="modal" data-bs-target="#modalMascota" onclick="limpiarModal()">
            + Nueva
        </button>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="modal fade" id="modalMascota" tabindex="-1" aria-labelledby="modalMascotaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMascotaLabel">Agregar/Editar Mascota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formMascota" method="POST">
                            @csrf
                            <input type="hidden" id="mascotaId" name="id">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" required
                                    min="0">
                            </div>
                            <div class="mb-3">
                                <label for="raza" class="form-label">Raza</label>
                                <input type="text" class="form-control" id="raza" name="raza" required>
                            </div>
                            <div class="mb-3">
                                <label for="peso" class="form-label">Peso</label>
                                <input type="number" step="0.01" class="form-control" id="peso" name="peso"
                                    required min="0">
                            </div>
                            <div class="mb-3">
                                <label for="nombre_duenio" class="form-label">Nombre del Dueño</label>
                                <input type="text" class="form-control" id="nombre_duenio" name="nombre_duenio" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono_duenio" class="form-label">Teléfono del Dueño</label>
                                <input type="text" class="form-control" id="telefono_duenio" name="telefono_duenio"
                                    required pattern="^\d{10}$">
                                <small class="form-text text-muted">El teléfono debe contener exactamente 10
                                    dígitos.</small>
                            </div>
                            <div class="mb-3">
                                <label for="imagen_url" class="form-label">URL de Imagen</label>
                                <input type="text" class="form-control" id="imagen_url" name="imagen_url" required>
                            </div>
                            <button type="submit" class="btn btn-success"
                                style="background-color: #699bc9;">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover mt-3 custom-table">
            <thead>
                <tr class="table-dark">
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Raza</th>
                    <th>Peso</th>
                    <th>Dueño</th>
                    <th>Teléfono</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->nombre }}</td>
                        <td>{{ $mascota->edad }}</td>
                        <td>{{ $mascota->raza }}</td>
                        <td>{{ $mascota->peso }}</td>
                        <td>{{ $mascota->nombre_duenio }}</td>
                        <td>{{ $mascota->telefono_duenio }}</td>
                        <td>
                            <img src="{{ $mascota->imagen_url }}" alt="Imagen de {{ $mascota->nombre }}"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editarMascota('{{ $mascota->id }}', '{{ $mascota->nombre }}', {{ $mascota->edad }}, '{{ $mascota->raza }}', {{ $mascota->peso }}, '{{ $mascota->nombre_duenio }}', '{{ $mascota->telefono_duenio }}', '{{ $mascota->imagen_url }}')">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST"
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
        function editarMascota(id, nombre, edad, raza, peso, nombreDuenio, telefonoDuenio, imagenUrl) {
            document.getElementById('formMascota').action = `{{ url('mascotas') }}/${id}`;
            document.getElementById('formMascota').method = 'POST';
            document.querySelector('#formMascota input[name="_method"]')?.remove();
            const inputMethod = document.createElement('input');
            inputMethod.type = 'hidden';
            inputMethod.name = '_method';
            inputMethod.value = 'PUT';
            document.getElementById('formMascota').appendChild(inputMethod);

            document.getElementById('mascotaId').value = id;
            document.getElementById('nombre').value = nombre;
            document.getElementById('edad').value = edad;
            document.getElementById('raza').value = raza;
            document.getElementById('peso').value = peso;
            document.getElementById('nombre_duenio').value = nombreDuenio;
            document.getElementById('telefono_duenio').value = telefonoDuenio;
            document.getElementById('imagen_url').value = imagenUrl;

            document.getElementById('modalMascotaLabel').textContent = 'Editar Mascota';
            const modal = new bootstrap.Modal(document.getElementById('modalMascota'));
            modal.show();
        }

        function limpiarModal() {
            document.getElementById('formMascota').action = `{{ route('mascotas.store') }}`;
            document.getElementById('formMascota').method = 'POST';
            document.querySelector('#formMascota input[name="_method"]')?.remove();

            document.getElementById('mascotaId').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('edad').value = '';
            document.getElementById('raza').value = '';
            document.getElementById('peso').value = '';
            document.getElementById('nombre_duenio').value = '';
            document.getElementById('telefono_duenio').value = '';
            document.getElementById('imagen_url').value = '';

            document.getElementById('modalMascotaLabel').textContent = 'Agregar Mascota';
        }

        function confirmarEliminacion() {
            return confirm('¿Estás seguro de que deseas eliminar esta mascota? Esta acción no se puede deshacer.');
        }

        function validarFormulario() {
            const edad = document.getElementById('edad').value;
            const peso = document.getElementById('peso').value;
            const telefono = document.getElementById('telefono_duenio').value;

            if (isNaN(edad) || edad <= 0) {
                alert('Por favor, introduce una edad válida.');
                return false;
            }

            if (isNaN(peso) || peso <= 0) {
                alert('Por favor, introduce un peso válido.');
                return false;
            }

            const telefonoRegex = /^\d{10}$/;
            if (!telefonoRegex.test(telefono)) {
                alert('Por favor, introduce un teléfono válido.');
                return false;
            }

            return true;
        }
    </script>
@endsection
