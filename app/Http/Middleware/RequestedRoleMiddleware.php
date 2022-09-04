<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class RequestedRoleMiddleware
{
    
    public function handle($request, Closure $next)
    {   

         if(!Auth::check())
        {
          return redirect()->route('login');
        }


        if (Auth::user()->role==5 || Auth::user()->role==6 || Auth::user()->role==10 ||  Auth::user()->role==11 || Auth::user()->role==12) {
            

            return $next($request);

        }else{

            return back();
            
        }
        
    }
}
