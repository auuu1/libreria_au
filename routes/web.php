<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeEmergenciaController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

//rutas para el formulario de autenticacion
Route::get('/registro', [
    AuthController::class,'registerForm'
])->name('registro');

//ruta para ejecutar el formulario
Route::post('/registro', [
    AuthController::class, 'register'
])->name('registro.store');

Route::get('/acceso',[
    AuthController::class, 'loginForm'
])->name('acceso');

//Ruta para manejar los datos de inicio de sesion
Route::post('/acceso', [
    AuthController::class, 'login'
])->name('acceso.store');

// rutas protegidas (cualquier usuario con sesion activa)
Route::middleware(['verifica'])->group(function () {

    //Ruta para cerrar sesion
    Route::post('/cerrar',[
        AuthController::class,'logout'
    ])->name('cerrar');

    // rutas de todos los métodos del controlador (index, store, create, destroy, etc.)
    Route::resource('mensajeEmergencia', MensajeEmergenciaController::class)
        ->parameters(['mensajeEmergencia' => 'mensajeEmergencia']);

    // ruta para la vista de actualización de un registro
    Route::get('/mensajeEmergencia/{id}/edit', [
        MensajeEmergenciaController::class, 'edit'
    ])->name('mensajeEmergencia.edit');

    // crear ruta para actualizar el registro
    Route::put('/mensajeEmergencia/{id}', [
        MensajeEmergenciaController::class, 'update'
    ])->name("mensajeEmergencia.update");

});


// rutas solo para administrador
Route::middleware(['verifica', 'admin'])->group(function () {
    Route::get('/admin-dashboard',[
        AuthController::class, 'adminDashboard'
    ])->name('admin-dashboard');

    Route::resource('usuarios', \App\Http\Controllers\UsuarioController::class);
});


Route::get('/usuarios/{id}/bienvenida', [
    \App\Http\Controllers\UsuarioController::class, 'enviarBienvenida'
])->name('usuarios.bienvenida');