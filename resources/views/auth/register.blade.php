<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')


    <h1>Registro de usuario:</h1>
    <h2>Bienvenido a WALL-E -> ingresa tus datos</h2>
    @include('partials.alerts')

    <form action = "{{route('registro.store') }}" method = "POST">

        @csrf

        <input type="text" name="name" placeholder="Nombre" class="form-control">
        <br><br>
        <input type="email" name="email" placeholder="Email" class="form-control">
        <br><br>
        <input type="password" name="password" placeholder="Contraseña" class="form-control">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="form-control">
        <br>


        @if(auth()->check() && auth()->user()->is_admin)
            <div class="form-check">
                <input type="checkbox" name="is_admin" id="is_admin" value="1">
                <label for="is_admin"> Es administrador </label>
            </div>
        @endif

        <br>
        <button type= "submit" class="btn btn-primary">Registrar</button>
        <br><br>
        <p>¿Ya tienes una cuenta?</p>
        <a href="{{ route('acceso') }}" class="btn btn-secondary">
            Iniciar sesión
        </a>

    </form>
    @endsection
</body>
</html>