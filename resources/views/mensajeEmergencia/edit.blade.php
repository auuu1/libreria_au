<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mensaje</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')

    <h1> Editar Mensaje: {{ $mensajeEmergencia->tipo_emergencia }} </h1>

    <form action="{{ route('mensajeEmergencia.update', $mensajeEmergencia) }}" method="POST">
    @csrf
    @method('PUT')

        <label>Tipo de Emergencia:</label>
        <input value="{{ $mensajeEmergencia->tipo_emergencia }}" type="text" name="tipo_emergencia" placeholder="Tipo de emergencia" class="form-control mb-2">
        <br> 

        <label>Servicio Destinatario:</label>
        <input value="{{ $mensajeEmergencia->servicio_destinatario }}" type="text" name="servicio_destinatario" placeholder="Servicio destinatario" class="form-control mb-2">
        <br> 

        <label>Medio de Envío:</label>
        <input value="{{ $mensajeEmergencia->medio_envio }}" type="text" name="medio_envio" placeholder="Medio de envío" class="form-control mb-2">
        <br> 

        <label>Contenido del Mensaje:</label>
        <textarea name="contenido" class="form-control mb-2" rows="3">{{ $mensajeEmergencia->contenido }}</textarea>
        <br>

        <label>Ubicación:</label>
        <input value="{{ $mensajeEmergencia->ubicacion }}" type="text" name="ubicacion" placeholder="Ubicación" class="form-control mb-2">
        <br>

        <label>Estado del Mensaje:</label>
        <select name="estado_envio" class="form-control mb-2">
            <option value="pendiente" {{ $mensajeEmergencia->estado_envio == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="enviado" {{ $mensajeEmergencia->estado_envio == 'enviado' ? 'selected' : '' }}>Enviado</option>
            <option value="fallido" {{ $mensajeEmergencia->estado_envio == 'fallido' ? 'selected' : '' }}>Fallido</option>
        </select>
        <br>

        <button type="submit" class="btn btn-outline-primary">Guardar Cambios</button>
        <br><br>
    </form>

    <div>
        <a href="{{ route('mensajeEmergencia.index') }}" class="btn btn-danger">
            Regresar
        </a>
    </div>

    @endsection

</body>
</html>