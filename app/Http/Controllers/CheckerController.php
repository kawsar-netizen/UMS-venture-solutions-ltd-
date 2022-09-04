<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckerController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	// return view('index4');
    	$my_id = Auth::user()->id;

    	 $requests = DB::table('br_user_subs')->where('assign_person',$my_id)->orderBy('id','DESC')->get();

         return view('index4',[
            'requests'=>$requests
        ]);
    }
}
