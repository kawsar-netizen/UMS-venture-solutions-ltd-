<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


   


    public function redirectTo()
    {


      
        switch (Auth::user()->role) {
            case 1:
               
               $this->redirectTo ='/dashboard1';
               return $this->redirectTo;
                break;

                case 2:
               
               $this->redirectTo ='/dashboard2';
               return $this->redirectTo;
                break;

              
               case 3:
               
               $this->redirectTo ='/maker';
               return $this->redirectTo;
                break;

            
               case 4:
               
               $this->redirectTo ='/checker';
               return $this->redirectTo;
                break;


                case 5:
               
               $this->redirectTo ='/dashboard5';
               return $this->redirectTo;
                break;


                case 6:
               
               $this->redirectTo ='/dashboard6';
               return $this->redirectTo;
                break;


                case 8:
               
               $this->redirectTo ='/dashboard8';
               return $this->redirectTo;
                break;


                case 9:
               
               $this->redirectTo ='/dashboard9';
               return $this->redirectTo;
                break;

                case 10:
               
               $this->redirectTo ='/dashboard10';
               return $this->redirectTo;
                break;


                case 11:
               
               $this->redirectTo ='/dashboard11';
               return $this->redirectTo;
               break;


              case 12:
               
               $this->redirectTo ='/dashboard12';
               return $this->redirectTo;
               break;
            
            default:
                 $this->redirectTo ='/login';
                 return $this->redirectTo;
                break;
        }
    }




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

}
