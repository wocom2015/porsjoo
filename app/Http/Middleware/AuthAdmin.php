<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::guest()) {
            return redirect()->guest('/login');
        }else{
            if(!Auth::user()->hasRole('super_admin'))
            {
                return redirect()->guest('/login');
            }
        }
        return $next($request);
    }
}
