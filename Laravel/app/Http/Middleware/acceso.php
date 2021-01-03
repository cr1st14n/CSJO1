<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use Session;



use Closure;

class acceso
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
       $acceso= Auth::user()->usu_acceso;
       if ( $acceso != '1') {
                Auth::logout();
                \Session::flash('flash_message_rechazado', '
Su sesión ha expirado porque su cuenta está desavilitada');
                return redirect()->to('/');
            //return redirect()->route('logout');
       }
        return $next($request);
    }
}
