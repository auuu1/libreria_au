<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mensaje</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        
        <h2 class="mb-4">Registrar Mensaje de Emergencia</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                <strong>Hecho:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('mensajeEmergencia.store') }}" method="POST">
            @csrf

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <input type="text" name="tipo_emergencia" placeholder="Tipo de emergencia (ej. Incendio)" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-truck-medical"></i></span>
                <input type="text" name="servicio_destinatario" placeholder="Servicio destinatario (ej. Bomberos)" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-tower-broadcast"></i></span>
                <input type="text" name="medio_envio" placeholder="Medio de envío (ej. SMS, API)" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <textarea name="contenido" placeholder="Contenido del mensaje" class="form-control" rows="3" required></textarea>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="ubicacion" placeholder="Ubicación del incidente" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="datetime-local" name="fecha_envio" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-circle-check"></i></span>
                <select name="estado_envio" class="form-control" required>
                    <option value="" disabled selected>Estado del mensaje</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="enviado">Enviado</option>
                    <option value="fallido">Fallido</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-outline-success">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Mensaje
                </button>
                <a href="{{ route('mensajeEmergencia.index') }}" class="btn btn-outline-secondary ms-2">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
</body>
</html>