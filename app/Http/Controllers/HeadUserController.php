<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\HdUserSub;

class HeadUserController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('index2');
    }

}
