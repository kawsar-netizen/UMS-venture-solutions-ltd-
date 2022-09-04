<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HODIVController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    
     public function ho_div_checker_authorize(Request $request){

        if ($request->ajax()) {
            try {

                $id =  $request->id;
                $request_id =  $request->req_id;
                $system_name =  $request->system_name;

                $date=date("Y-m-d H:i:s");
                $update_date=date("Y-m-d H:i:s");
                
                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_id')->where('sl',$id)->update(
                    [
                        'action_status_br_checker'=>1,
                        'br_checker'=>Auth::user()->id,
                        'br_checker_sts_update_date'=>$update_date

                    ]
                );


                 $this->common_func($request_id, Auth::user()->id, 3,$date, $request->ip());


                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;

                   $request_generator_id = $request_type_info->br_maker;
                  $maker_user_id = $request_type_info->maker_user_id;

                   $user_id=Auth::user()->id;

                   // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id." Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id    



                  $assigned_by = $request_type_info->assigned_by;


                  
                    $subject = "Head Office Division Checker Authorized  : $request_id";
                
                   

                     $request_sent_date=date('Y-m-d');

                     $branch_code=Auth::user()->branch;
                     if($branch_code) {

                      $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                      $branch_name = $br_info_data->name." ($branch_code) ";

                     }

                     $emp_id=Auth::user()->emp_id;
                    
                    $requested_by=$request_type_info->assigned_by."( $request_type_info->emp_id)";
                    $authorized_by="Authorized By: ".Auth::user()->name."( $emp_id )";
                   
                    
                      $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;

                   $role_name = "$request_type_name";

                    // for role name


                    $module_name="$system_name";

                  
                  
                   $data_users = DB::select(DB::raw("SELECT * FROM users where role='2' and division_name like '%IT Division%' "));


                  $data_users = DB::table('users')->where("role",2)->get();

                   foreach($data_users as $single_data_usr){
  

                     $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                }

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }

    }
}
