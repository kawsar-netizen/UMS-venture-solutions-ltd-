<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class RequestFormMiddleware
{
    
    public function handle($request, Closure $next)
    {
         if(!Auth::check())
        {
          return redirect()->route('login');
        }



        if (Auth::user()->role==11 || Auth::user()->role==12) {
            
           return back();

        }else{
            
            
            return $next($request);
        }




    }
}
