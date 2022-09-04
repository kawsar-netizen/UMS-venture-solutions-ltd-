<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class parameterSetupController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function system_form(){

    	return view('parameter_setup.system');
    }


    public function request_type_edit_data(Request $request){

         if ($request->ajax()) {


            try {

                $id =  $request->id;
                
               $get_data = DB::table('request_type')->where('id', $id)->first();

             
            
               $view = view('single_page_fetch_request_type_edit_data', compact('get_data'))->render();

                return response()->json(['html' => $view]);
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }



    public function update_request_type(Request $request){


         if ($request->ajax()) {


            try {

                $id =  $request->hidden_id;
               
                if ($request->edit_system_name) {

                     $edit_system_name =  $request->edit_system_name;
                }else{

                   $get_request_type_data = DB::table('request_type')->where('id',$id)->first();
                   $edit_system_name = $get_request_type_data->system_id;
                }
               
                if ($request->show_parameter) {
                     $show_parameter =  $request->show_parameter;

                }else{
                     $get_request_type_data = DB::table('request_type')->where('id',$id)->first();
                    $show_parameter = $get_request_type_data->status;
                }
               
                if ($request->show_input_field) {

                     $show_input_field =  $request->show_input_field;
                     
                }else{

                      $get_request_type_data = DB::table('request_type')->where('id',$id)->first();
                    $show_input_field = $get_request_type_data->show_input_field;
                }


                $edit_request_type_name =  $request->edit_request_type_name;


               $update_data = DB::table('request_type')->where('id', $id)->update(
                [

                    'system_id'=>$edit_system_name,
                    'request_type_name'=>$edit_request_type_name,
                    'status'=>$show_parameter,
                    'show_input_field'=>$show_input_field


            ]);

             if ($update_data) {
               echo "1";
             }
            
                
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    }


    public function system_submit(Request $request){

    	 $system_name = $request->system_name;
    	$system_id = $request->system_id;

    	$date = date('Y-m-d');

    	$system_id_count = DB::table('systems')->where('sys_id', $system_id)->count();

    	if ($system_id_count > 0) {

    		return back()->with('status_warning', 'This system Id already exists !');
    		
    	}else{

	    	DB::table('systems')->insert([
	    		"system_name"=>$system_name,
	    		"entry_date"=>$date,
	    		"entry_by"=>Auth::user()->id,
	    		"sys_id"=>$system_id,
	    		"sys_status"=>'1'
	    	]);


    	return back()->with('status_success', 'Data Inserted Successfully !');

    	}
    }


    public function system_parameter(){

    		return view('parameter_setup.system_parameter');
    }



    public function system_parameter_submit(Request $request){

    	$system = $request->system;
    	$para_type = $request->para_type;
    	$parameter_name = $request->parameter_name;
        $user_role = $request->user_role;

    	$today_date =date('Y-m-d');

    	DB::table('sys_parameters')->insert([
    		"system_id"=>$system,
    		"para_name"=>$parameter_name,
    		"para_type"=>$para_type,
    		"entry_date"=>$today_date,
    		"entry_by"=>Auth::user()->id,
    		"para_status"=>'1',
            "user_role"=>$user_role,
    	]);


    	return back()->with('status_success','Data Inserted Successfully !');

    }

    public function request_type(){

    	return view('parameter_setup.request_type');
    }

    //coding by kawsar

    public function request_delete($id){
        DB::table('request_type')->where('id',$id)->delete();
        return back();
    }


    public function request_type_submit(Request $request){

    	if ($request->ajax()) {
            try {

                $today_date = date('Y-m-d');

                $system =  $request->system;
                $para_type =  $request->para_type;
                $request_type_name =  $request->request_type_name;
                

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_type')->insert(
                  [

                    'system_id'=>$system,
                    'request_type_name'=>$request_type_name,
                    'status'=>$para_type,
                    
                    'create_date'=>$today_date,

                  ]
                );

                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }
    }


    public function approve_system(){

        return view('parameter_setup.approve_system');
    }


}
