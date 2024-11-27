@extends('layouts.template')

@section('content')


<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container mt-5">
    <h1>Citas</h1>
    <button  
        class="btn btn-sm text-white fw-bold border-4" 
        style="background-color: #699bc9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); font-size: 1.1rem;" 
        data-bs-toggle="modal" 
        data-bs-target="#modalCita" 
        onclick="limpiarModal()">
        + Nueva
    </button>
    

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCitaLabel">Agregar/Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCita" method="POST" action="">
                        @csrf
                        <input type="hidden" id="citaId" name="id">
                        
                        <div class="mb-3">
                            <label for="mascota" class="form-label">Mascota</label>
                            <select id="mascota" name="mascota_id" class="form-select">
                                @foreach($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Servicio</label>
                            <select id="servicio" name="servicio_id" class="form-select">
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora">
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select">
                                <option value="pendiente">Pendiente</option>
                                <option value="realizado">Realizado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
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
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->mascota->nombre }}</td>
                    <td>{{ $cita->servicio->nombre }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ ucfirst($cita->estado) }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="editarCita('{{ $cita->id }}', '{{ $cita->mascota_id }}', '{{ $cita->servicio_id }}', '{{ $cita->fecha }}', '{{ $cita->hora }}', '{{ $cita->estado }}')">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmarEliminacion()">
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
    function editarCita(id, mascota, servicio, fecha, hora, estado) {
        document.getElementById('citaId').value = id;
        document.getElementById('mascota').value = mascota;
        document.getElementById('servicio').value = servicio;
        document.getElementById('fecha').value = fecha;
        document.getElementById('hora').value = hora;
        document.getElementById('estado').value = estado;

        document.getElementById('modalCitaLabel').textContent = 'Editar Cita';
        document.getElementById('formCita').action = `/citas/${id}`;
        document.getElementById('formCita').method = 'POST';
        var hiddenMethod = document.createElement('input');
        hiddenMethod.type = 'hidden';
        hiddenMethod.name = '_method';
        hiddenMethod.value = 'PUT';
        document.getElementById('formCita').appendChild(hiddenMethod);

        var modal = new bootstrap.Modal(document.getElementById('modalCita'));
        modal.show();
    }

    function limpiarModal() {
        document.getElementById('citaId').value = '';
        document.getElementById('mascota').value = '';
        document.getElementById('servicio').value = '';
        document.getElementById('fecha').value = '';
        document.getElementById('hora').value = '';
        document.getElementById('estado').value = 'pendiente';

        document.getElementById('modalCitaLabel').textContent = 'Agregar Cita';
        document.getElementById('formCita').action = '/citas';
        document.getElementById('formCita').method = 'POST';
    }

    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar esta cita? Esta acción no se puede deshacer.');
    }
</script>

@endsection
