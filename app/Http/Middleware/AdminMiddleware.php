<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // si no hay sesión activa, redirigir al login
        if (!Auth::check()) {
            return redirect()->route('acceso')
                ->with('error', 'Debes iniciar sesión');
        }

        // si hay sesión pero no es admin, redirigir a mensajes
        if (!Auth::user()->is_admin) {
            return redirect()->route('mensajeEmergencia.index')
                ->with('error', 'No cuentas con permisos de administrador');
        }

        return $next($request);
    }
}