<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Generar rutas de todos los métodos 
    Route::resource('libros', LibroController::class);
});

//crear ruta para la vista de actualizacion de un registro 
Route::get('/libros/{id}/edit', [
    LibroController::class,'edit'
])->name ('libros.edit');


// crear ruta para actualizar 
Route::put('/libros/{id}', [
    LibroController::class,'update'
])->name ("libros.update");

// Ruta para el formulario de registro
Route::get('/registro', [
    AuthController::class, 'registerForm'
])->name('registro'); 

//Ruta para ejecutar el formulario
Route::post('/registro', [
    AuthController::class, 'register'
])->name('registro.store');

Route::get('/login', [
    AuthController::class, 'loginForm'
])->name('login');

//Ruta para manejar los datos de inicio de sesión
Route::post('/acceso', [
    AuthController::class, 'login'
])->name('acceso.store');

// Ruta para cerrar sesión
Route::post('/salir', [
    AuthController::class, 'logout'
])->name('cerrar');

Route::middleware(['auth', 'admin'])->group(function () {
    // Rutas protegidas para administradores
    Route::get('/admin-dashboard', [
        AuthController::class, 'adminDashboard'
    ])->name('admin.dashboard');
});