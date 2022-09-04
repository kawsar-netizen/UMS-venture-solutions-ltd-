<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class singleUserReportMiddleware
{
    
    public function handle($request, Closure $next)
    {

        if(!Auth::check())
        {
          return redirect()->route('login');
        }



        if (Auth::user()->role==2 || Auth::user()->role==6 || Auth::user()->role==11 || Auth::user()->role==12 || Auth::user()->division_name=='Internal Control Compliance Division'){

             return $next($request);
             
        }else{
            
            return back();
        }
       
    }
}
