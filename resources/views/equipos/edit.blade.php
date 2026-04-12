@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm mx-auto" style="max-width: 800px;">
        <div class="card-body p-4">
            <h2 class="card-title mb-4">Editar Equipo: {{ $equipo->codigo_equipo }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <p class="fw-bold mb-2">Por favor corrige los siguientes errores:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
                @csrf 
                @method('PUT') <div class="mb-3">
                    <label class="form-label fw-bold" for="codigo_equipo">Código del Equipo</label>
                    <input type="text" name="codigo_equipo" id="codigo_equipo" value="{{ old('codigo_equipo', $equipo->codigo_equipo) }}"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" for="tipo">Tipo de Equipo</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="Extintor CO2" {{ old('tipo', $equipo->tipo) == 'Extintor CO2' ? 'selected' : '' }}>Extintor CO2</option>
                        <option value="Extintor PQS" {{ old('tipo', $equipo->tipo) == 'Extintor PQS' ? 'selected' : '' }}>Extintor PQS (Polvo Químico)</option>
                        <option value="Manguera" {{ old('tipo', $equipo->tipo) == 'Manguera' ? 'selected' : '' }}>Manguera</option>
                        <option value="Hacha" {{ old('tipo', $equipo->tipo) == 'Hacha' ? 'selected' : '' }}>Hacha</option>
                        <option value="Detector de Humo" {{ old('tipo', $equipo->tipo) == 'Detector de Humo' ? 'selected' : '' }}>Detector de Humo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" for="ubicacion_exacta">Ubicación Exacta</label>
                    <input type="text" name="ubicacion_exacta" id="ubicacion_exacta" value="{{ old('ubicacion_exacta', $equipo->ubicacion_exacta) }}"
                        class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label fw-bold" for="fecha_ultima_recarga">Última Recarga / Revisión</label>
                        <input type="date" name="fecha_ultima_recarga" id="fecha_ultima_recarga" value="{{ old('fecha_ultima_recarga', $equipo->fecha_ultima_recarga) }}"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="fecha_caducidad">Fecha de Caducidad</label>
                        <input type="date" name="fecha_caducidad" id="fecha_caducidad" value="{{ old('fecha_caducidad', $equipo->fecha_caducidad) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" for="estado">Estado Actual</label>
                    <select name="estado" id="estado" class="form-select" required>
                        <option value="Funcional" {{ old('estado', $equipo->estado) == 'Funcional' ? 'selected' : '' }}>Funcional</option>
                        <option value="En reparación" {{ old('estado', $equipo->estado) == 'En reparación' ? 'selected' : '' }}>En reparación</option>
                        <option value="Caducado" {{ old('estado', $equipo->estado) == 'Caducado' ? 'selected' : '' }}>Caducado</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-arrows-rotate"></i> Actualizar equipo
                    </button>
                    <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-xmark"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection