<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
    $idEmployee = $request->route('id_employee');
    $authenticatedUserId = auth('employee')->user()->id_employee;

    if ($idEmployee != $authenticatedUserId) {
        // Jika pengguna yang mencoba mengakses profil bukan pemiliknya, kembalikan response 403 Forbidden
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
    }
}
