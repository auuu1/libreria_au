<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Inventario de equipos contra incendio</h1>
    <h4>Usuario en sesion:  {{ auth()->user()->name }}</h4>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('equipos.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Nuevo Equipo
        </a>
        
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin-dashboard') }}" class="btn btn-secondary ms-2">
                <i class="fa-solid fa-screwdriver-wrench"></i> Panel Admin
            </a>
        @endif
    </div>

    @include('partials.alerts')

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>CÓDIGO</th>
                    <th>TIPO</th>
                    <th>UBICACIÓN</th>
                    <th>ESTADO</th>
                    <th>CADUCIDAD</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $equipo)
                    <tr class="align-middle">
                        <td>{{ $equipo->id }}</td>
                        <td><strong>{{ $equipo->codigo_equipo }}</strong></td>
                        <td>{{ $equipo->tipo }}</td>
                        <td>{{ $equipo->ubicacion_exacta }}</td>
                        <td>
                            <span class="badge @if($equipo->estado == 'Funcional') bg-success @elseif($equipo->estado == 'Caducado') bg-danger @else bg-warning text-dark @endif">
                                {{ strtoupper($equipo->estado) }}
                            </span>
                        </td>
                        <td>{{ $equipo->fecha_caducidad }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if(auth()->user()->is_admin)
                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="m-0" onsubmit="
                                return confirm('¿Estás seguro de que deseas eliminar este equipo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                 @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </div>
</div>

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