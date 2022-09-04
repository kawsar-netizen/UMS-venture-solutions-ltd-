<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('parameter_setup.division_setup');
    }


    public function division_edit_data(Request $request){


         if ($request->ajax()) {


            try {

                $id =  $request->id;
                
               $get_data = DB::table('division')->where('sl', $id)->first();

             
            
               $view = view('single_page_fetch_division_edit_data', compact('get_data'))->render();

                return response()->json(['html' => $view]);
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }


    public function update_division_title(Request $request){



    	$this->validate($request, [

    		'edit_designation_name' =>'required'

    	]);
    		
    	

         if ($request->ajax()) {


            try {

                $id =  $request->hidden_id;
               
                


                $edit_designation_name =  $request->edit_designation_name;


               $update_data = DB::table('division')->where('sl', $id)->update(
                [

                    
                    'division'=>$edit_designation_name


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



    public function division_submit(Request $request)
    {


    	$this->validate($request, [

    		'designation_name' =>'required'

    	]);


    	if ($request->ajax()) {
            try {

                $today_date = date('Y-m-d');

                
                $designation_name =  $request->designation_name;
                

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('division')->insert(
                  [

                    
                    'division'=>$designation_name,
                    

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
