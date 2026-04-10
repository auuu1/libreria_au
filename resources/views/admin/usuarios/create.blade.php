@extends('layouts.app')

@section('content')

    <h1>Crear Usuario</h1>
    @include('partials.alerts')


    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <label>Nombre:</label>
        <input type="text" name="name" placeholder="Nombre" class="form-control mb-2">

        <label>Email:</label>
        <input type="email" name="email" placeholder="Email" class="form-control mb-2">

        <label>Contraseña:</label>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2">
        <small class="text-muted">La contraseña debe tener al menos 8 caracteres.</small>

        <div class="form-check mb-2">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input">
            <label for="is_admin" class="form-check-label">¿Es administrador?</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

    <div class="mt-2">
        <a href="{{ route('admin-dashboard') }}" class="btn btn-danger">
            Regresar
        </a>
    </div>

@endsection