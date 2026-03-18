<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1>EDITAR LIBRO: {{ $libro->nombre }}</h1>

    <form action="{{ route('libros.update', $libro) }}" method="POST">

    <!-- OBLIGATORIO -->
        @csrf
        <!-- Indicar metodo para actualizar un registro -->
        @method('PUT')

        <input value="{{ $libro->nombre }}" type="text" name="nombre" placeholder="Nombre" class="form-control">
        <br><br>
        <input value="{{ $libro->autor }}" type="text" name="autor" placeholder="Autor" class="form-control">
        <br><br>
        <input value="{{ $libro->editorial }}" type="text" name="editorial" placeholder="Editorial" class="form-control">
        <br><br>
        <input value="{{ $libro->precio }}" type="text" name="precio" placeholder="Precio" class="form-control">
        <br><br>
        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-floppy-disk"></i>Guardar</button>
    </form>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('libros.index') }}" class="btn btn-danger">
           <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>

    </div>

    @endsection
</body>
</html>