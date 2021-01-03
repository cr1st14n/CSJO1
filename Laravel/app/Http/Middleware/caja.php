<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
class caja
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $area=Auth::user()->usu_area;
        if ($area != 'Caja' ) {
            \Session::flash('flash_message_rechazado', 'Sin privilegios. Acceso denegado');
            return redirect()->back();
        }
        return $next($request);
    }
}
