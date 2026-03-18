<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm(){
        // Método para regresar vista del formulario
        return view('auth.register');
    }
    // M´wtodo paara guardar la información en la base de datos
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            "is_admin" => $request->has('is_admin'),
        ]);
        // Inicia sesión de forma automática
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    //Método para regresar visat de inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }

    //Método para verificar el inicio de sesión
    public function login(Request $request){
        // Validar los datos del formulario
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Se realiza una validación para generar la sesión
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
             // redireccionar al usuario a cualquier ruta del sistema
             //en ese caso en la ruta de libros
            return redirect()->route('libros.index');
        }
        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
            //Cierre de sesión
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
