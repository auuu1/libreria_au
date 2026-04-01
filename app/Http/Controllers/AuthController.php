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
        $request->validate([
       // 'name' => 'required',
       // 'email' => 'required|email|unique:users',
       // 'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([

        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_admin' => $request -> has('is_admin'),
        ]);

        //iniciar sesion de forma automatica
        Auth::login($user);

        return redirect()->route('mensajeEmergencia.index');
    }
    //metodo para regresar vista de inicio de sesion
    public function loginForm(){
        return view('auth.login');

    }

    //metodo para verificar el inicio de sesion
    public function login(Request $request){
        //validar los datos que se obtienen del formulario
        $data = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        //se realiza una validacion para generar la sesion
        if(Auth::attempt($data)){
            //generar sesion
            $request -> session()->regenerate();
            
            //Redireccionar al usuario a cualquier ruta del sistema 
            //despues de iniciar sesion
            return redirect()->route('mensajeEmergencia.index');
        }

        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ]);

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
        return view('admin-dashboard');
    }

}
