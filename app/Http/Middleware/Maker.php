<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Maker
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
        // return $next($request);


        if(!Auth::check())
        {
          return redirect()->route('login');
        }

     //role 1 = branch user

        if(Auth::user()->role == 1)
        {
            return redirect()->route('branchUser');
            
        }



        //role 2 = head office user

        if(Auth::user()->role == 2)
        {
            return redirect()->route('headUser');
        }


        //role 3 = maker

        if(Auth::user()->role == 3)
        {
            return $next($request);

        }



        //role 4 = checker

        if(Auth::user()->role == 4)
        {
            return redirect()->route('checker');
        }


        //role 5 = branch checker

        if(Auth::user()->role == 5)
        {
            
            return redirect()->route('branchChecker');
            
            
        }

        //role 6 = head checker


        if(Auth::user()->role == 6)
        {
            
            return redirect()->route('headChecker');
        
            
        }





    }
}
