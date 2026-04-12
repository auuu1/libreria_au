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
        Schema::create('equipo_contra_incendios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_equipo')->unique(); // Para que no haya dos EXT-01
            $table->string('tipo'); // Extintor CO2, Polvo Químico, etc.
            $table->string('ubicacion_exacta');
            $table->date('fecha_ultima_recarga')->nullable(); // nullable por si es equipo nuevo
            $table->date('fecha_caducidad')->nullable();
            $table->enum('estado', ['Funcional', 'En reparación', 'Caducado'])->default('Funcional');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_contra_incendios');
    }
};
