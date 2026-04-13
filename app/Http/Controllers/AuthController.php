<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //metodo para regresar vista del formulario
    public function registerForm(){
        return view('auth.register');
    }


    //metodo para guardar la informacion en la base de datos
    public function register(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return back()->with('error', 'El correo ya está registrado o los datos son incorrectos.');
        }   

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        Auth::login($user);

        return redirect()->route('inicio');
    }


    //metodo para regresar vista de inicio de sesion
    public function loginForm(){
        return view('auth.login');

    }

    //metodo para verificar el inicio de sesion

    public function login(Request $request){

        // Validar los datos que se obtienen del formulario
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Se realiza una validación para generar la sesión
        if(Auth::attempt($data)){
            // Generar la sesión
            $request->session()->regenerate();

            // Enviar correo de inicio de sesión
            $usuario = Auth::user();
            \Mail::to($usuario->email)->send(new \App\Mail\InicioSesionMail($usuario));

            // Redireccionar al usuario
            return redirect()->route('inicio');
        }

        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    public function logout(Request $request){
        
        //cierre de sesion
        Auth::logout();

        //Cierre de credenciales en sesiones
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/acceso');
    }


    public function adminDashboard(){
        $usuarios = \App\Models\User::all();
        return view('admin.dashboard', compact('usuarios'));
    }


}
