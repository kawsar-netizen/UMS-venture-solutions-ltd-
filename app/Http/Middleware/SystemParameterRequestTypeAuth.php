<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class SystemParameterRequestTypeAuth
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
        if (Auth::user()->role=='6' || Auth::user()->role=='11' || Auth::user()->role=='12') {
             return $next($request);
        }else{

            return back();
        }
    }
}
