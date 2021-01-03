<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Session;
class administracion
{

    protected $auth;
    public function _construct(Guard $auth){
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->usu_area != 'Administracion') {
            \Session::flash('flash_message_rechazado', 'Sin privilegios. Acceso denegado');
            return redirect()->back();
            
        }
        return $next($request);
    }
}
