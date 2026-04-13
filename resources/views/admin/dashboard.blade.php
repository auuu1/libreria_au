<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador</title>
</head>
<body>
    @extends('layouts.app')

@section('content')

    <h1>Panel de Administrador</h1>
    <h4>Usuario en sesion:  {{ auth()->user()->name }}</h4>

    @include('partials.alerts')
<br><br>
    <div class="d-flex justify-content-between align-items-center">
        <h4>Usuarios registrados</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('equipos.index') }}" class="btn btn-primary mb-3">
                <i class="fa-solid fa-fire-extinguisher"></i>
                Ver Equipos
            </a>
            <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">
                <i class="fa-solid fa-plus"></i> Crear Nuevo usuario
            </a>
        </div>
    </div>

    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>EMAIL</th>
            <th class="text-center">ADMINISTRADOR</th>
            <th class="text-center">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td class="text-center">{{ $usuario->is_admin ? 'Sí' : 'No' }}</td>
                <td class="text-center">
                    <a href="{{ route('usuarios.edit', $usuario->id) }}">
                        <button class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </a>

                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Desea eliminar este usuario?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                    <a href="{{ route('usuarios.bienvenida', $usuario->id) }}">
                        <button class="btn btn-success">
                            <i class="fa-solid fa-envelope"></i>
                        </button>
                    </a>
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