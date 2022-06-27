<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // echo "Hi from Middleware";
        $path=$request->path();
        if(($path=="login" || $path=="register") && Session::get('user'))
        {
            return redirect('/');
        }
        else if(($path!="login" && !Session::get('user')) && ($path!="register" && !Session::get('user')))
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
