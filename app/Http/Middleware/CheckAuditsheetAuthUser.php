<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckAuditsheetAuthUser
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

        if (Auth::user()->role=='2' || Auth::user()->role=='6') {
             return $next($request);
        }else{

            return back();
        }
       
    }
}
