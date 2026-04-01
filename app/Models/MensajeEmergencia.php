<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeEmergencia extends Model
{
    protected $table = 'mensajes_emergencia';
    public $timestamps = false;

    protected $fillable=['tipo_emergencia','servicio_destinatario','medio_envio',
        'contenido','ubicacion','fecha_envio','estado_envio'];
}
