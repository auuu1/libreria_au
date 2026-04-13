<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeEmergenciaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoContraIncendioController;
use App\Http\Controllers\UsuarioController;

    Route::get('/', function () {
        return view('welcome');
    });

    // Rutas para el formulario de autenticación
    Route::get('/registro', [
        AuthController::class, 'registerForm'
    ])->name('registro');

    Route::post('/registro', [
        AuthController::class, 'register'
    ])->name('registro.store');

    Route::get('/acceso', [
        AuthController::class, 'loginForm'
    ])->name('acceso');
    Route::post('/acceso', [
        AuthController::class, 'login'
    ])->name('acceso.store');

    // Rutas protegidas (cualquier usuario con sesión activa)
    Route::middleware(['verifica'])->group(function () {
        
        Route::get('/inicio', function () {
                return view('inicio');
            })->name('inicio');

        // Ruta para cerrar sesión
        Route::post('/cerrar', [
            AuthController::class, 'logout'
        ])->name('cerrar');

        // Rutas de Mensaje de Emergencia
        Route::resource('mensajeEmergencia', MensajeEmergenciaController::class)
            ->parameters(['mensajeEmergencia' => 'mensajeEmergencia']);
            
        // Rutas manuales para actualización de Mensaje de Emergencia
        Route::get('/mensajeEmergencia/{id}/edit', [
            MensajeEmergenciaController::class, 'edit'
        ])->name('mensajeEmergencia.edit');
        Route::put('/mensajeEmergencia/{id}', [
            MensajeEmergenciaController::class, 'update'
        ])->name('mensajeEmergencia.update');

        // ---> RUTA NUEVA PARA EL CRUD DE EQUIPOS CONTRA INCENDIOS <---
        Route::resource('equipos', EquipoContraIncendioController::class);

    });

    // Rutas solo para administrador
    Route::middleware(['verifica', 'admin'])->group(function () {
        Route::get('/admin-dashboard', [
            AuthController::class, 'adminDashboard'
        ])->name('admin-dashboard');
        Route::resource('usuarios', UsuarioController::class);
    });

    // Ruta de bienvenida
    Route::get('/usuarios/{id}/bienvenida', [
        UsuarioController::class, 'enviarBienvenida'
    ])->name('usuarios.bienvenida');