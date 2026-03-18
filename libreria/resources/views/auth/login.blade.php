@extends('layouts.app')

@section('content')

<h1>INICIO DE SESIÓN</h1>

<form action="{{ route('acceso.store') }}" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Email" class="form-control">
    <br>
    <input type="password" name="password" placeholder="Contraseña" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

</form>

@endsection