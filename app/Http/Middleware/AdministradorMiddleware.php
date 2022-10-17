<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministradorMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->rol == "administrador") {
                return $next($request);
            } else {
                return back()->with('rol', 'Acceso denegado');
            }
        } else {
            return redirect('/login')->with('ingresar', 'Debe iniciar sesión');
        }
    }
}
