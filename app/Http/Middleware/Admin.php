<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Admin
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
            return redirect()->route('maker');
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


         //role 8 = head auth


        if(Auth::user()->role == 8)
        {

            return redirect()->route('headAuth');
              
            
        }

        if(Auth::user()->role == 9)
        {

            return redirect()->route('ho_div_maker');
            
            
        }


        //role 9 = head div maker


        if(Auth::user()->role == 10)
        {


            return redirect()->route('ho_div_checker');
            
           
            
        }

        if(Auth::user()->role == 11)
        {

            return redirect()->route('superadmin');
            
            
        }


        if(Auth::user()->role == 12)
        {
            

             if (Auth::user()->status_id==0) {
                 Auth::logout();
                 Session::flush();
                return redirect('/')->with('status','Your Account Is Not Activated !');
          }else{

            return $next($request);
          }


            
        }
    }
}
