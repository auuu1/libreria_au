<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes de Emergencia</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')

    <h1>Mensajes de emergencia</h1>
    <h4>Usuario en sesion:  {{ auth()->user()->name }}</h4>

    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('mensajeEmergencia.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Nuevo mensaje
        </a>

        @if(auth()->user()->is_admin)
            <a href="{{ route('admin-dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-screwdriver-wrench"></i> 
                Panel Admin
            </a>
        @endif
    </div>

    @include('partials.alerts')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>TIPO</th>
                <th>DESTINATARIO</th>
                <th>UBICACIÓN</th>
                <th class="text-center">ESTADO</th>
                <th>FECHA ENVÍO</th>
                <th class="text-center">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mensajeEmergencia as $mensaje)
                <tr>
                    <td>{{ $mensaje->id }}</td>
                    <td>{{ $mensaje->tipo_emergencia }}</td>
                    <td>{{ $mensaje->servicio_destinatario }}</td>
                    <td>{{ $mensaje->ubicacion }}</td>
                    <td class="text-center">
                        <span class="badge @if($mensaje->estado_envio == 'enviado') bg-success @elseif($mensaje->estado_envio == 'fallido') bg-danger @else bg-warning @endif">
                            {{ strtoupper($mensaje->estado_envio) }}
                        </span>
                    </td>
                    <td>{{ $mensaje->fecha_envio }}</td>
                    <td class="text-center">
                        <a href="{{ route('mensajeEmergencia.edit', $mensaje->id) }}">
                            <button class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </a>

                        @if(auth()->user()->is_admin)
                            <form action="{{ route('mensajeEmergencia.destroy', $mensaje->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Desea eliminar este mensaje de emergencia?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('inicio') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            Regresar
        </a>

        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar sesión
            </button>
        </form>
    </div>

    @endsection
</body>
</html>