<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path= $request->path();
        if((($path=='spc/login')||($path=='spc/register'))&&(Session::get('username'))){
            return redirect('/spc/dashboard');
        }elseif(($path!='spc/login')&&($path!='spc/register')&&(Session::get('username')==null)){
            return redirect('/spc/login');
        }

        return $next($request);
    }
}
