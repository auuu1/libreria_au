<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>Inicio de sesión WALL-E</h1>

    @include('partials.alerts')
    
    <form action="{{ route('acceso.store') }}" method="POST">

    @csrf

    <input type="text" name="email" placeholder="Correo Electronico" class="form-control">
    <br>
    <input type="password" name="password" placeholder="Contraseña" class="form-control">
    <br>

    <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
    <br><br>

    </form>
    <p>¿No tienes cuenta?</p>
    <a href="{{ route('registro') }}" class="btn btn-secondary">
        Registrarse
    </a>
    @endsection
</body>
</html>