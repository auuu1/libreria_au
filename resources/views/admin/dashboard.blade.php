@extends('layouts.app')

@section('content')

    <h1>Panel de Administrador</h1>

    <div class="d-flex justify-content-end">
        <a href="{{ route('mensajeEmergencia.index') }}" class="btn btn-secondary ms-2 mb-3">
            <i class="fa-solid fa-arrow-left"></i>
            Regresar
        </a>

        <a href="{{ route('equipos.index') }}" class="btn btn-primary ms-2 mb-3">
            <i class="fa-solid fa-fire-extinguisher"></i>
            Ver Equipos
        </a>

        <form action="{{ route('cerrar') }}" method="POST" class="ms-2">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar sesión
            </button>
        </form>
    </div>

    @include('partials.alerts')

    <div class="d-flex justify-content-between align-items-center">
        <h4>Usuarios registrados</h4>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">
            <i class="fa-solid fa-plus"></i> Nuevo usuario
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>ADMINISTRADOR</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->is_admin ? 'Sí' : 'No' }}</td>
                    <td>
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

@endsection