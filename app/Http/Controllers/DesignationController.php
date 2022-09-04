<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('parameter_setup.designation_setup');
    }


    public function designation_edit_data(Request $request){


         if ($request->ajax()) {


            try {

                $id =  $request->id;
                
               $get_data = DB::table('designation')->where('sl', $id)->first();

             
            
               $view = view('single_page_fetch_designation_edit_data', compact('get_data'))->render();

                return response()->json(['html' => $view]);
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }



    public function update_designation_title(Request $request){



    	$this->validate($request, [

    		'edit_designation_name' =>'required'

    	]);
    		
    	

         if ($request->ajax()) {


            try {

                $id =  $request->hidden_id;
               
                


                $edit_designation_name =  $request->edit_designation_name;


               $update_data = DB::table('designation')->where('sl', $id)->update(
                [

                    
                    'designation_name'=>$edit_designation_name


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


    public function degingation_submit(Request $request)
    {


    	$this->validate($request, [

    		'designation_name' =>'required'

    	]);


    	if ($request->ajax()) {
            try {

                $today_date = date('Y-m-d');

                
                $designation_name =  $request->designation_name;
                

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('designation')->insert(
                  [

                    
                    'designation_name'=>$designation_name,
                    

                  ]
                );

                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }
    }



}
