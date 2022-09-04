<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HdUserSub;

class MakerController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	// return view('index3');
    	$requests = DB::table('br_user_subs')->orderBy('id','DESC')->get();

    	// dd($requests);

         return view('index3',[
            'requests'=>$requests
        ]);
    }
}
