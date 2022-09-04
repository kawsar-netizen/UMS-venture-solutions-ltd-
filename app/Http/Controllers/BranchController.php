<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function index()
    {
    	return view('parameter_setup.branch_add');
    }


    public function branch_submit(Request $request){

    		$branch_name = $request->branch_name;
    		$branch_code = $request->branch_code;

    		DB::table('branch_info')->insert([
    			"name"=>$branch_name,
    			"bnk_br_id"=>$branch_code,
    			"br_code"=>$branch_code,
    			"brinfo_flag"=>1,
    		]);


    	return back()->with('status', 'Data inserted Successfull ');	
    }


   public function sub_branch_submit(Request $request){

   		$select_main_branch = $request->select_main_branch;
   		$sub_branch_name = $request->sub_branch_name;

   		DB::table('branch_info')->insert([

   				"name"=>$sub_branch_name,
    			"bnk_br_id"=>$select_main_branch,
    			"br_code"=>$select_main_branch,
    			"brinfo_flag"=>2,

   		]);

   		DB::table('branch_info')->where('bnk_br_id',$select_main_branch)->where('brinfo_flag',1)->update([

   				"has_sub_branch"=>1,
    			
    			
   		]);


   		return back()->with('message', 'Data inserted Successfull ');



   }

   public function branch_edit($id){

    return view('parameter_setup/branch_edit',compact('id'));
   }

   public function branch_update(Request $request){
      $id = $request->hidden_branch_id;
      $branch_name = $request->branch_name;
      $branch_code = $request->branch_code;

      DB::table('branch_info')->where('agent_br_key',$id)->update([

          "name"=>$branch_name,
          "bnk_br_id"=>$branch_code,
          "br_code"=>$branch_code,
      ]);


      return back()->with('status','Data updated Successfully !');
   }



   public function sub_branch_update(Request $request){
      $id = $request->sub_branch_hidden_id;
      $branch_code = $request->select_main_branch;
      $sub_branch_name = $request->sub_branch_name;


       DB::table('branch_info')->where('agent_br_key',$id)->update([

          
          "bnk_br_id"=>$branch_code,
          "name"=>$sub_branch_name,
      ]);

        return back()->with('message','Data updated Successfully !');

   } 


}
