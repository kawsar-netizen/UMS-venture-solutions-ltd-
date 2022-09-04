<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BranchCheckerController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    { 
    
      $my_branch =  Auth::user()->branch;
         $my_id =  Auth::user()->id;

      $requests_id =   DB::select(DB::raw("select * from request_id where status='0' and branch_code = '$my_branch' and br_maker <> '$my_id'  "));

      // $requests = DB::table('br_user_subs')->where('user_roll',1)->where('user_branch',Auth::user()->branch)->orderBy('id','DESC')->get();

        $my_arr=[];

      foreach ($requests_id as $key => $value) {
            
            $req_id=$value->req_id;
            $status=$value->status;
            $branch_code=$value->branch_code;
            $br_maker=$value->br_maker;
            $br_checker=$value->br_checker;
            $ho_maker=$value->ho_maker;
            $ho_checker=$value->ho_checker;
            $entry_date=$value->entry_date;


           $br_maker_data = DB::table('users')->where('id',$br_maker)->first();

           echo "<pre>";
           print_r($br_maker_data);
           
       }


       

      //return view('index5');
    }


    public function branch_checker_authorize(Request $request){

      if ($request->ajax()) {
            try {

                $id =  $request->id;
                $request_id =  $request->req_id;
                $system_name =  $request->system_name;

                $date=date("Y-m-d H:i:s");
                $update_date=date("Y-m-d H:i:s");

                $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.emp_id , r_id.request_type_value

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                  $request_type_name = $request_type_info->request_type_name;
                  $assigned_by = $request_type_info->assigned_by;
                  $request_generator_id = $request_type_info->br_maker;
                 
                  

                 

                $br_pk_id = Auth::user()->br_pk_id;
               $sub_br_code="";

                if ($br_pk_id && ($br_pk_id!=NULL || $br_pk_id!='') && $br_pk_id!='0' ) {

                  $sub_br_code=$br_pk_id;
                  
               }else{

                 $sub_br_code="";

               }


               // ubs unlock user
               if ($request_type_info->request_type_system_id=='1' && $request_type_name=='Unlock user') {
                   $user_id = $request_type_info->request_type_value;
                   if($this->checkUBSAduser($user_id) === true){ // ubs user found 
                      
                         //$single_blog = Blog::find($row_id);
                      $single_blog = DB::table('request_id')->where('sl',$id)->update(
                        [
                              'action_status_ho_checker'=>5,
                              'status'=>2,
                              'br_checker'=>Auth::user()->id,
                              'pk_for_sub_br_checker'=>$sub_br_code,
                              'br_checker_sts_update_date'=>$update_date

                        ]
                      );


                   }else{
                      //$single_blog = Blog::find($row_id);
                      $single_blog = DB::table('request_id')->where('sl',$id)->update(
                        [
                              'action_status_br_checker'=>1,
                              'br_checker'=>Auth::user()->id,
                              'pk_for_sub_br_checker'=>$sub_br_code,
                              'br_checker_sts_update_date'=>$update_date

                        ]
                      );
                   }

               }else{
                  //$single_blog = Blog::find($row_id);
                  $single_blog = DB::table('request_id')->where('sl',$id)->update(
                    [
                          'action_status_br_checker'=>1,
                          'br_checker'=>Auth::user()->id,
                          'pk_for_sub_br_checker'=>$sub_br_code,
                          'br_checker_sts_update_date'=>$update_date

                    ]
                  );
               }
                
                


                 $this->common_func($request_id, Auth::user()->id, 3,$date, $request->ip() );


                    $subject = "Branch Checker Authorized  : $request_id";
                    
                     $request_sent_date=date('Y-m-d');

                     $branch_code=Auth::user()->branch;
                     if ($branch_code) {


                      //check sub branch

                      $br_pk_id = Auth::user()->br_pk_id;

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

                       
                        
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                        $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                        $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch
                      

                     }

                     $emp_id=Auth::user()->emp_id;
                    
                    $requested_by=$assigned_by." (".$request_type_info->emp_id.")";
                    $authorized_by="Authorized By: ".Auth::user()->name."( $emp_id )";
                    $user_id=Auth::user()->id;
                    

                    // for role name
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];

                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $maker_user_id = $request_type_info->maker_user_id;

                   $request_type_system_id = $request_type_info->request_type_system_id;


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

                  
                  if ($module_name=="RTGS" && $request_type_name=="Enhancement") {
                      
                       $data_users = DB::select(DB::raw("SELECT * FROM users where role='8' and division_name like '%Operations Division%' "));

                       foreach($data_users as $single_data_usr){

                       
                        $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                      }

                  }else{

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


     public function branch_checker_decline(Request $request){

      if ($request->ajax()) {
            try {

                 $date=date("Y-m-d H:i:s");
                 $update_date=date("Y-m-d");

                 $id =  $request->id;
                 $request_id =  $request->req_id;
                 $br_checker_decline_reason =  $request->br_checker_decline_reason;
                 $system_name_recheck =  $request->system_name_recheck;

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                      'action_status_br_checker'=>2,
                        'rechecker'=>Auth::user()->id,
                      
                        'br_checker_recheck_reason'=>$br_checker_decline_reason,
                        'recheck_status'=>1
                  ]

                );

                 $this->common_func($request_id, Auth::user()->id, 4, $date, $request->ip() );


                 //for mailing function

                $user_data = DB::select(DB::raw("SELECT 
                    usr.[name] as req_generator_name, usr.email
                      FROM [dbfive].[dbo].[request_id] r_id

                      left join users usr on r_id.br_maker= usr.id where r_id.req_id='$request_id'"))[0];



                $mail_to = $user_data->email;

                  $subject = "Branch Checker Recheck  : $request_id";
                  

                $assigned_by = "$user_data->req_generator_name";



               // for role name
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.req_id='$request_id' "))[0];


                     
                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_generator_id = $request_type_info->br_maker;
                  $maker_user_id = $request_type_info->maker_user_id;
                  $request_type_system_id = $request_type_info->request_type_system_id;

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


                   $role_name = "$request_type_name";





                    $request_sent_date=date('Y-m-d');
               $branch_code=Auth::user()->branch;
               if ($branch_code) {

                  //check sub branch

                      $br_pk_id = Auth::user()->br_pk_id;

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                        $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                        $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch

                

               }

               $emp_id=Auth::user()->emp_id;
              
              // $requested_by=Auth::user()->name."( $emp_id )";
               $requested_by=$assigned_by." (".$request_type_info->emp_id.")";

               $rechecked_by="Rechecked By : ".Auth::user()->name."( $emp_id )";
             
             

             
             
                  $module_name = $system_name_recheck;

              


                  // $this->mail_send($mail_to, $subject, $request_id, $assigned_by, $request_type);

                    $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$rechecked_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);


            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }

    } //end function branch_checker_decline


    public function ho_release_authorize(Request $request){

       if ($request->ajax()) {
            try {

                $id =  $request->id;
              $req_id =  $request->req_id;
               


                DB::table('request_id')->where('sl',$id)->update([
                    
                    "br_checker_assign_manual_id"=>'',
                    "br_authorizer"=>'',
                    
                ]);


             

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    } // end ho_release_authorize function


    public function branch_checker_authorize_all(Request $request){

        if ($request->ajax()) {

            $date=date("Y-m-d H:i:s");
            $update_date=date("Y-m-d H:i:s");

             $br_pk_id = Auth::user()->br_pk_id;
               $sub_br_code="";

                if ($br_pk_id && ($br_pk_id!=NULL || $br_pk_id!='') && $br_pk_id!='0' ) {

                  $sub_br_code=$br_pk_id;
                  
               }else{

                 $sub_br_code="";

               }





           $join_sl_with_coma = $request->join_sl_with_coma;

          $join_sl_with_coma_exp = explode(',', $join_sl_with_coma);

          foreach($join_sl_with_coma_exp as $single_data_get){


             $single_blog = DB::table('request_id')->where('sl',$single_data_get)->update(
                  [
                        'action_status_br_checker'=>1,
                        'br_checker'=>Auth::user()->id,
                        'pk_for_sub_br_checker'=>$sub_br_code,
                        'br_checker_sts_update_date'=>$update_date

                  ]
                  
                );



                $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, r_id.req_id, 
                    usr.name as assigned_by, usr.emp_id , usr.user_id as  maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.sl='$single_data_get' "))[0];

                  $request_type_name = $request_type_info->request_type_name;
                  $request_id = $request_type_info->req_id;
                  $assigned_by = $request_type_info->assigned_by;
                  $request_generator_id = $request_type_info->br_maker;
                  $request_type_system_id = $request_type_info->request_type_system_id;



                  $maker_user_id = $request_type_info->maker_user_id;

                
                   $this->common_func($request_id, Auth::user()->id, 3,$date, $request->ip() ); // audit log

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


                 $get_system_info = DB::table('systems')->where('id',$request_type_system_id)->first();

                $module_name = $get_system_info->system_name;

                if (Auth::user()->role==5) {

                   $subject = "Branch Checker Authorized  : $request_id";

                }elseif (Auth::user()->role==10) {

                   $subject = "Head Office Division Checker Authorized  : $request_id";

                }elseif (Auth::user()->role==6) {

                   $subject = "IT Checker Authorized  : $request_id";

                }

                  
                    
                     $request_sent_date=date('Y-m-d');

                     $branch_code=Auth::user()->branch;
                     if ($branch_code) {


                      //check sub branch

                      $br_pk_id = Auth::user()->br_pk_id;

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

                       
                        
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                        $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                        $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch
                      

                     }

                     $emp_id=Auth::user()->emp_id;
                    
                    $requested_by=$assigned_by." (".$request_type_info->emp_id.")";
                    $authorized_by="Authorized By: ".Auth::user()->name."( $emp_id )";
                    $user_id=Auth::user()->id;
                    


              if ($request_type_system_id=="6" && $request_type_name=="Enhancement") {
                      
                       $data_users = DB::select(DB::raw("SELECT * FROM users where role='8' and division_name like '%Operations Division%' "));

                       foreach($data_users as $single_data_usr){

                       
                        $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                      }

                  }else{

                        $data_users = DB::select(DB::raw("SELECT * FROM users where role='2' and division_name like '%IT Division%' "));

                       foreach($data_users as $single_data_usr){

                       
                        $this->mail_send($single_data_usr->email, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                      }

                  }



          }

        }else{
            echo "This is not ajax Request";
        }

    }  //end multiple authorize function


    public function branch_checker_decline_all(Request $request){

         if ($request->ajax()){


            $date=date("Y-m-d H:i:s");
            $update_date=date("Y-m-d");


            $join_sl_with_coma = $request->join_sl_with_coma;
            $decline_reason_all = $request->decline_reason_all;

            $join_sl_with_coma_exp = explode(',', $join_sl_with_coma);


            foreach($join_sl_with_coma_exp as  $single_data_sl){

                $single_blog = DB::table('request_id')->where('sl',$single_data_sl)->update(
                  [
                      'action_status_br_checker'=>2,
                        'rechecker'=>Auth::user()->id,
                      
                        'br_checker_recheck_reason'=>$decline_reason_all,
                        'recheck_status'=>1
                  ]

                );

            


             $user_data = DB::select(DB::raw("SELECT 
                    usr.[name] as req_generator_name, usr.email, r_id.req_id
                      FROM [dbfive].[dbo].[request_id] r_id

                      left join users usr on r_id.br_maker= usr.id where r_id.sl='$single_data_sl'"))[0];



                $mail_to = $user_data->email;
                $request_id = $user_data->req_id;


                if (Auth::user()->role==5) {
                  
                  $subject = "Branch Checker Decline  : $request_id";

                }elseif (Auth::user()->role==10) {

                  $subject = "Head Office Division Checker Decline  : $request_id";

                }elseif (Auth::user()->role==6) {

                  $subject = "IT Checker Decline  : $request_id";
                }
                  
                  

                $assigned_by = "$user_data->req_generator_name";

                $this->common_func($request_id, Auth::user()->id, 4, $date, $request->ip() );



                 // for role name
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker, usr.name as assigned_by, usr.user_id as  maker_user_id, usr.emp_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id where r_id.sl='$single_data_sl' "))[0];




                
                 $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_generator_id = $request_type_info->br_maker;
                  $maker_user_id = $request_type_info->maker_user_id;
                  $request_type_system_id = $request_type_info->request_type_system_id;

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


                   $role_name = "$request_type_name";





                    $request_sent_date=date('Y-m-d');
               $branch_code=Auth::user()->branch;
               if ($branch_code) {

                  //check sub branch

                      $br_pk_id = Auth::user()->br_pk_id;

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                        $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                        $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch

                

               }

               $emp_id=Auth::user()->emp_id;
              
              // $requested_by=Auth::user()->name."( $emp_id )";
               $requested_by=$assigned_by." (".$request_type_info->emp_id.")";

               $rechecked_by="Rechecked By : ".Auth::user()->name."( $emp_id )";
             
             
                
                    

                $get_system_info = DB::table('systems')->where('id',$request_type_system_id)->first();

                $module_name = $get_system_info->system_name;
             
                

                $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$rechecked_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

            

            } // end foreach
            

         }


    } // end branch_checker_decline_all function


    // cheeck user id to user exist in cbs ad or not 
    public function checkUBSAduser($user_id){
      return false;
    }

  
}
