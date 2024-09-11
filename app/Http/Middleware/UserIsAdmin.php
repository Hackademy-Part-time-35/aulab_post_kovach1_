<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserIsAdmin
{
    // Verifica si el usuario autenticado es administrador
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->is_admin) {
            return $next($request);
        }
        
        // Redirige a la página de inicio si no es autorizado
        return redirect(route('homepage'))->with('alert', 'non sei autorizzato');
    }
}
