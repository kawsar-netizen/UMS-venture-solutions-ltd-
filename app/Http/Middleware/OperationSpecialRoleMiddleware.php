<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;


class OperationSpecialRoleMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
          return redirect()->route('login');
        }



        if (Auth::user()->role==11 || Auth::user()->role==12) {
            
            return $next($request);
        }else{
            
            return back();
        }



    }
}
