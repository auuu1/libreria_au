<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index(){
        $usuarios = User::all();
        return view('admin.dashboard', compact('usuarios'));
    }

    // Formulario para crear usuario
    public function create(){
        return view('admin.usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin-dashboard')
            ->with('success', 'Usuario creado correctamente');
    }

    // Formulario para editar usuario
    public function edit($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
// Actualizar usuario
public function update(Request $request, $id){
    $usuario = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
    ]);

    $wasAdmin = $usuario->is_admin;
    $isNowAdmin = $request->has('is_admin');

    $usuario->update([
        'name' => $request->name,
        'email' => $request->email,
        'is_admin' => $isNowAdmin,
    ]);

    if($wasAdmin != $isNowAdmin){
        return redirect()->route('admin-dashboard')
            ->with('warning', 'Se modificaron los permisos de administrador del usuario');
    }

    return redirect()->route('admin-dashboard')
        ->with('success', 'Usuario actualizado correctamente');
}
    // Eliminar usuario
    public function destroy($id){
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin-dashboard')
            ->with('warning', 'Usuario eliminado correctamente');
    }
}