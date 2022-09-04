<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\HdUserSub;
use App\BrUserSub;

use Illuminate\Support\Facades\DB;

class HdUserSubController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    




public function viewHdUserReqList()
    {

     


      $requests = DB::select(DB::raw("SELECT br_user_subs.*, br_user_subs.id as br_user_id, users.name as usr_name   FROM br_user_subs left join users on br_user_subs.assign_person = users.id  WHERE br_user_subs.user_roll='1'  AND  br_user_subs.action_status='1' or  br_user_subs.action_status='3' or  br_user_subs.action_status='4' or  br_user_subs.change_status='5' or  br_user_subs.change_status='6'  order by br_user_id desc"));
     
        return view('index2',[
            'requests'=>$requests
        ]);
    }


public function ho_maker_accept(Request $request){

      if ($request->ajax()) {
            try {

              $my_user_id = Auth::user()->id;

                $date = date("Y-m-d H:i:s");
                $id =  $request->id;
                $request_id =  $request->req_id;
                $system_id =  $request->system_id;

               $approve_sys_data = DB::table('approve_sys_table')->where('sys_id',$system_id)->count();

               $get_request_data_info = DB::table('request_id')->where('sl',$id)->first();
               $action_status_ho_maker = $get_request_data_info->action_status_ho_maker;
               $ho_maker = $get_request_data_info->ho_maker;

               if ($ho_maker) {
                $get_data_usr = DB::table('users')->where('id', $ho_maker)->first();
                $ho_maker_name = $get_data_usr->name;
                
               }else{
                 $ho_maker_name ="";

               }
               

               //check this request already accept
               

               if ( !empty($ho_maker) && $my_user_id != $ho_maker) {
                 echo "$ho_maker_name";

                 die;
               }



               if ($approve_sys_data==1) {

                  $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                    'action_status_ho_maker'=>3,
                    'ho_maker'=>Auth::user()->id

                  ]
                );

               }elseif($approve_sys_data==0) {
                   
                    $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                    'action_status_ho_maker'=>3,
                    'ho_maker'=>Auth::user()->id

                  ]
                );

               }
                

                 $this->common_func($request_id, Auth::user()->id, 5, $date, $request->ip() );

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }

} // end ho_maker_accept function


public function ho_maker_change_status(Request $request){

       if ($request->ajax()) {
            try {

                $request_sl =  $request->request_sl;
                $request_id =  $request->request_id;
                $system_name =  $request->system_name;
                $final_request_type =  $request->final_request_type;
                $ho_maker_remarks =  $request->ho_maker_remarks;
               

                $single_fetch_data = DB::table('request_id')
            ->where('sl', $request_sl)
            ->first();

              $action_status_ho_maker = $single_fetch_data->action_status_ho_maker;
              $ho_maker = $single_fetch_data->ho_maker;

               if ($ho_maker) {
                $get_data_usr = DB::table('users')->where('id', $ho_maker)->first();
                $ho_maker_name = $get_data_usr->name;
                
               }else{
                 $ho_maker_name ="";

               }


             

                $view = view('single_fetch_data', compact('request_sl','request_id','system_name','final_request_type','ho_maker_remarks','single_fetch_data'))->render();

                return response()->json(['html' => $view]);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

}


public function ho_maker_change_status_submit(Request $request)
{

       if ($request->ajax()) {
            try {

             

             
                $date=date("Y-m-d H:i:s");
                 $update_date = date('Y-m-d');

                $hidden_id =  $request->hidden_id;
                 $request_id =  $request->req_id;

               $request_id_data = DB::table('request_id')->where('sl',"$hidden_id")->first();
                $branch_code = $request_id_data->branch_code;
               $br_pk_id = $request_id_data->pk_for_sub_br;

                $system_name =  $request->system_name;

             
                  $change_status = $request->change_status;
                  $user_id = $request->user_id;

                  if($request->user_password){

                     $password = $request->user_password;
                  
                  }elseif($request->reset_password){

                      $password = $request->reset_password;
                  }else{
                    
                     $password="";
                  }
                 
                 
                  $ho_maker_remarks = $request->ho_maker_remarks;

                  if ($change_status=='4') {
                      
                      $single_fetch_data = DB::table('request_id')->where('sl', $hidden_id)->update([

                        'status'=>7,
                        'action_status'=>7,
                        'action_status_ho_maker'=>4,
                        'action_status_ho_checker'=>'',
                        'ho_checker'=>'',
                        'update_date'=>$update_date,
                        'created_user_id'=>$user_id,
                        'created_password'=>$password,
                        'ho_maker_remarks'=>$ho_maker_remarks,
                        
                     
                    ]);

                  }else{

                        $single_fetch_data = DB::table('request_id')->where('sl', $hidden_id)->update([

                        'status'=>$change_status,
                        'action_status_ho_maker'=>4,
                        'action_status_ho_checker'=>'',
                        'ho_checker'=>'',
                        'update_date'=>$update_date,
                        'created_user_id'=>$user_id,
                        'created_password'=>$password,
                        'ho_maker_remarks'=>$ho_maker_remarks,
                        
                     
                    ]);

                  }
                   


                 $this->common_func($request_id, Auth::user()->id, 6, $date, $request->ip() );


                  $subject = "IT Maker Change Status : $request_id";
                    
                     $request_sent_date=date('Y-m-d');

                     

                     //check sub branch

                      // $br_pk_id = Auth::user()->br_pk_id;

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL && !empty($br_pk_id)) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                         $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                         $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch


                    //  $emp_id=Auth::user()->emp_id;
                    
                    
                    // $authorized_by="Authorized By: ".Auth::user()->name."( $emp_id )";
                    $user_id=Auth::user()->id;
                    

                    // for role name
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id,r_id.req_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.sl='$hidden_id' "))[0];



                $request_id="Request No : $request_type_info->req_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;
                   $maker_user_id = $request_type_info->maker_user_id;
                  $request_generator_id = $request_type_info->br_maker;


                  $br_checker_user_id = $request_type_info->br_checker;

                  $br_checker_user_data = DB::table('users')->where('id',$br_checker_user_id)->first();

                  $authorized_by="Authorized By: ".$br_checker_user_data->name."($br_checker_user_data->emp_id)";

                  // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id." Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id  

                  $requested_by=$request_type_info->assigned_by."(".$request_type_info->emp_id.")";

                   $role_name = "$request_type_name";


                    $module_name="$system_name";

                  
                  
                   //$data_users = DB::table('users')->where("role",2)->get();
                   $data_users = DB::select(DB::raw("SELECT * FROM users where role='6' and division_name like '%IT Division%' "));

                   foreach($data_users as $single_data_usr){

                  
                    $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                }


                return back()->with('message','Request Change Successfully ! ');
             
              

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }



}


public function assign_person_url(Request $request){

    if ($request->ajax()) {
            try {

                    
                $request_id = $request->id;
                $req_id = $request->req_id;
                $system_name = $request->system_name;
                $final_request_type = $request->final_request_type;

               $final_request_type_exp = explode(',',$final_request_type);
                $final_request_type_exp_0 = $final_request_type_exp[0];

             $role = Auth::user()->role;
             $branch = Auth::user()->branch;
             $user_id = Auth::user()->id;
              $division_name = Auth::user()->division_name;

             if ($role=='9') {
                $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='10' and division_name='$division_name'  and  [status_id]='1' "));

                // echo"<pre>";
                // print_r($db_data);die;

             }elseif($role=='2'){

                  $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='6' and division_name='$division_name' and  [status_id]='1'   "));

             }elseif($role=='6'){

                  $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='6' and division_name='$division_name' and  [status_id]='1'   "));

             }elseif($role=='10'){

                  $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='10' and division_name='$division_name'  and  [status_id]='1' "));

             }elseif (Auth::user()->division_name=='Operations Division') { //special role
                  
                   $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where division_name='Operations Division' and  role='10' and  [status_id]='1' "));

                  

              }elseif($role=='11'){

                $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        "));

              }else{

                 $db_data = DB::select(DB::raw("SELECT *
                  FROM [dbo].[users]
                    where role='5' and branch='$branch'  and  [status_id]='1' "));
                 
             }

             


              
                $view = view('single_fetch_data_assign_person', compact('db_data','request_id','req_id','system_name','final_request_type_exp_0'))->render();

                return response()->json(['html' => $view]);
             
              

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

} // end function assign_person_url


function my_branch_assgin_person(Request $request){

    if ($request->ajax()) {
            try {

               $branch = Auth::user()->branch;
              
              $role = Auth::user()->role; 
              $division_name = Auth::user()->division_name;
              $user_id = Auth::user()->id;


              if ($division_name && $role=='2') {

                $db_data = DB::select(DB::raw("SELECT *
  FROM [users]

  where division_name='$division_name' and [role]='6' and  [status_id]='1' "));
                  
              }elseif($division_name && $role=='6'){

                 $db_data = DB::select(DB::raw("SELECT *
  FROM [users]

  where division_name='$division_name' and [role]='6' and  [status_id]='1' "));


              }elseif ($role=='9') {
                  
                   $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='10' and division_name='$division_name'  and  [status_id]='1'"));

                  

              }elseif ($role=='10') {
                  
                   $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where role='10' and division_name='$division_name'  and  [status_id]='1'"));

                  

              }elseif (Auth::user()->division_name=='Operations Division') {
                  
                   $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        where division_name='Operations Division' and  role='10' and  [status_id]='1' "));

                  

              }elseif($role=='11'){

                $db_data = DB::select(DB::raw("SELECT *
                      FROM [users]
                        "));

              }else{

                 $db_data = DB::select(DB::raw("SELECT *
  FROM [users]
    where role='5' and branch='$branch' and  [status_id]='1'"));

                

              }

             

              // echo "<pre>";
              // print_r($db_data);

            
              
                $view = view('my_branch_assign_person', compact('db_data'))->render();




                return response()->json(['html' => $view]);
             
              

            } catch (\Exception $e) {
                echo $e->getMessage();
        }


        } else {
            echo 'This request is not ajax !';
        }
}


    
    public function ho_authorize_submit(Request $request){

         if ($request->ajax()) {
            try {

                $sl =  $request->sl;
                $request_id =  $request->req_id;
                 $system_name =  $request->system_name;

                $today_date=date('Y-m-d');
                 $update_date=date("Y-m-d");
                

                $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id as br_maker_emp_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                  $request_type_name = $request_type_info->request_type_name;


                   $user_id=Auth::user()->id;

                  $request_type_system_id = $request_type_info->request_type_system_id;
                  $br_checker = $request_type_info->br_checker;
                  $br_maker_emp_id = $request_type_info->br_maker_emp_id;

                  $br_checker_data = DB::table('users')->where('id',$br_checker)->first();

                  $br_checker_name = $br_checker_data->name;
                  $br_checker_emp_id = $br_checker_data->emp_id;

                   $request_generator_id = $request_type_info->br_maker;
                  $maker_user_id = $request_type_info->maker_user_id;


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


                DB::table('request_id')->where('sl',$sl)->update([
                    "action_status_ho_maker"=>8,
                    "ho_authorize_status"=>1,
                    "ho_authorize_sts_date"=>$today_date,
                    "ho_authorizer"=>Auth::user()->id
                ]);


                


                  $subject = "Head Office Division Checker Authorized  : $request_id";
                    
                     $request_sent_date=date('Y-m-d');

                     $branch_code=Auth::user()->branch;
                     if ($branch_code) {

                      $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                      $branch_name = $br_info_data->name." ($branch_code) ";

                     }


                        $emp_id=$br_maker_emp_id;
                    
                    $requested_by=$assigned_by."( $emp_id )";
                    $authorized_by="Authorized By: ".$br_checker_name."( $br_checker_emp_id )";
                   


                     // for role name
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;

                   $request_generator_id = $request_type_info->br_maker;
                  $maker_user_id = $request_type_info->maker_user_id;

                  if ($request_type_system_id=='6' && $request_type_name=='Enhancement') {

                       $this->common_func($request->req_id, Auth::user()->id, 10, date('Y-m-d h:i:s'), $request->ip() );

                  }else{
                    $this->common_func($request->req_id, Auth::user()->id, 3, date('Y-m-d h:i:s'), $request->ip() );
                  }
                   

                  // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id." Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id    

                   $role_name = "$request_type_name";

                    // for role name

                    $module_name="$system_name";

                    if ($module_name=="RTGS" && $role_name=="Enhancement") {

                       $subject = "Head Office Operations Division  Authorized  : $request_id";

                      $operations_div_auth = "Operations division authorizer : ".Auth::user()->name;

                       $data_users = DB::select(DB::raw("SELECT * FROM users where role='2' and division_name like '%IT Division%' "));

                         foreach($data_users as $single_data_usr){

                         
                          $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth,$final_user_id,$role_name,$module_name);

                      }

                      
                    }else{

                      $operations_div_auth="";

                      $data_users = DB::select(DB::raw("SELECT * FROM users where role='2' and division_name like '%IT Division%' "));

                      

                         foreach($data_users as $single_data_usr){

                         
                          $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                      }

                    }

                 


            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }


    public function ho_authorize_decline_submit(Request $request){

        if ($request->ajax()) {
            try {

                $sl =  $request->sl;
                $request_id =  $request->req_id;
                $today_date=date('Y-m-d');

                DB::table('request_id')->where('sl',$sl)->update([
                    "action_status_ho_maker"=>'',
                    "ho_authorize_status"=>'0',
                    "action_status_br_checker"=>'',
                    "ho_authorize_sts_date"=>$today_date
                ]);


                 $this->common_func($request_id, Auth::user()->id, 1, $today_date, $request->ip() );

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    }


    public function ho_release_submit(Request $request){

        if ($request->ajax()) {
            try {

                $sl =  $request->sl;
                $request_id =  $request->request_id;
               


                DB::table('request_id')->where('sl',$sl)->update([
                    
                    "ho_maker"=>'',
                    "action_status_ho_maker"=>'',
                    
                ]);


                 $this->common_func($request_id, Auth::user()->id, 1, $date, $request->ip() );

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }


   

  

}
