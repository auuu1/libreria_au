@extends('layouts.app')

@section('content')

    <h1>Editar Usuario: {{ $usuario->name }}</h1>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="name" value="{{ $usuario->name }}" class="form-control mb-2">

        <label>Email:</label>
        <input type="email" name="email" value="{{ $usuario->email }}" class="form-control mb-2">

        <div class="form-check mb-2">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input"
                {{ $usuario->is_admin ? 'checked' : '' }}>
            <label for="is_admin" class="form-check-label">¿Es administrador?</label>
        </div>

        <button type="submit" class="btn btn-outline-primary">Guardar Cambios</button>
    </form>

    <div class="mt-2">
        <a href="{{ route('admin-dashboard') }}" class="btn btn-danger">
            Regresar
        </a>
    </div>

@endsection