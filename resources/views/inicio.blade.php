<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    @extends('layouts.app')

@section('content')

    <h1>Bienvenido(a), {{ auth()->user()->name }}</h1>
    <p>¿Qué deseas hacer hoy?</p>

    <div class="d-flex gap-3 mt-4">
        <a href="{{ route('mensajeEmergencia.index') }}" class="btn btn-danger btn-lg">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Ver Mensajes de Emergencia
        </a>

        <a href="{{ route('equipos.index') }}" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-fire-extinguisher"></i>
            Ver Equipos
        </a>

        @if(auth()->user()->is_admin)
            <a href="{{ route('admin-dashboard') }}" class="btn btn-secondary btn-lg">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Panel de Admin
            </a>
        @endif
    </div>

    <div class="mt-4">
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar sesión
            </button>
        </form>
    </div>

@endsection
</body>
</html>