<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoContraIncendio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_equipo',
        'tipo',
        'ubicacion_exacta',
        'fecha_ultima_recarga',
        'fecha_caducidad',
        'estado',
    ];
}
