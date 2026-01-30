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
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verificar si el usuario tiene rol admin (role_id = 1)
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Acceso denegado. Solo los administradores pueden acceder a esta sección.');
        }

        return $next($request);
    }
}