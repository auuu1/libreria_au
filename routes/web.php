<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeEmergenciaController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// rutas de todos los métodos del controlador (index, store, create, destroy, etc.)
Route::middleware(['auth'])->group(function () {
    Route::resource('mensajeEmergencia', MensajeEmergenciaController::class)
    ->parameters(['mensajeEmergencia' => 'mensajeEmergencia']);
    
});

// ruta para la vista de actualización de un registro
Route::get('/mensajeEmergencia/{id}/edit', [
    MensajeEmergenciaController::class, 'edit'
])->name('mensajeEmergencia.edit');

// crear ruta para actualizar el registro
Route::put('/mensajeEmergencia/{id}', [
    MensajeEmergenciaController::class, 'update'
])->name("mensajeEmergencia.update");

//ruta para el formulario de autenticacion
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

//Ruta para cerrar sesion
Route::post('/cerrar',[
    AuthController::class,'logout'
])->name('cerrar');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard',[
        AuthController::class, 'adminDashboard'
    ])->name('admin-dashboard');    
});
