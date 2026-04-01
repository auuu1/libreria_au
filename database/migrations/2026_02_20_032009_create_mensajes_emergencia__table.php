<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajes_emergencia', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_emergencia'); 
            $table->string('servicio_destinatario'); 
            $table->string('medio_envio'); 
            $table->text('contenido');
            $table->string('ubicacion');
            $table->dateTime('fecha_envio');
            $table->enum('estado_envio', ['enviado', 'pendiente', 'fallido']);
            
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes_emergencia_');
    }
};
