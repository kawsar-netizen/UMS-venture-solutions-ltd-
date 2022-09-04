<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HeadCheckerController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       $requests = DB::select(DB::raw("SELECT br_user_subs.*, br_user_subs.id as br_user_id, users.name as usr_name   FROM br_user_subs left join users on br_user_subs.assign_person = users.id  WHERE br_user_subs.user_roll='1' and br_user_subs.change_status='2' or br_user_subs.change_status='5' or br_user_subs.change_status='6' order by br_user_id desc"));

       // echo "<pre>";

       // print_r($requests);die;
     
       return view('index6',[
            'requests'=>$requests
        ]);

      
    }


    public function ho_checker_approved(Request $request){

       if ($request->ajax()) {
            try {

                 $date=date("Y-m-d H:i:s");
                 
                 $update_date=date("Y-m-d h:i:s");

                $id =  $request->id;
                $request_id =  $request->req_id;
                $system_name =  $request->system_name;


                 $request_id_data = DB::table('request_id')->where('req_id',"$request_id")->first();

               $branch_code = $request_id_data->branch_code;
               $br_pk_id = $request_id_data->pk_for_sub_br;

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                    'action_status_ho_checker'=>5,
                   
                    'ho_checker'=>Auth::user()->id,
                    'ho_chkr_aprove_sts_update_date'=>$update_date

                  ]

                );


                 $this->common_func($request_id, Auth::user()->id, 7, $date, $request->ip() );

                

                $request_generator_data = DB::select(DB::raw("SELECT 
    usr.[name] as req_generator, usr.[email]

  FROM [dbfive].[dbo].[request_id] r_id

  left join users usr on r_id.br_maker=usr.id where r_id.req_id='$request_id'"))[0];


           $mail_to = $request_generator_data->email;

             $subject = "Request Approved From IT Checker : $request_id";
                    
                     $request_sent_date=date('Y-m-d');

                    
                    //check sub branch

                    
                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                         $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                         $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch

                  



                    $user_id=Auth::user()->id;
                    


                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.emp_id, usr.user_id as maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id left join [users] br_checker_user  on r_id.br_checker=br_checker_user.id  where r_id.req_id='$request_id' "))[0];

                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;

                   $maker_user_id = $request_type_info->maker_user_id;
                  $request_generator_id = $request_type_info->br_maker;

                  $br_checker_user_id = $request_type_info->br_checker;

                  $br_checker_user_data = DB::table('users')->where('id',$br_checker_user_id)->first();

                  $authorized_by="Authorized By: ".$br_checker_user_data->name."($br_checker_user_data->emp_id )";


                   $requested_by=$request_type_info->assigned_by."(".$request_type_info->emp_id.")";

                   // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id."Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id  


                   $role_name = "$request_type_name";



                    $module_name="$system_name";

                

                 $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        } else {
            echo 'This request is not ajax !';
        }



    } // ho_checker_approved function end



    public function it_checker_approve_all(Request $request){

      if ($request->ajax()) {

         $date=date("Y-m-d H:i:s");        
         $update_date=date("Y-m-d h:i:s");

        $join_sl_with_coma =  $request->join_sl_with_coma;

        $join_sl_with_coma_exp = explode(',', $join_sl_with_coma);

        foreach ($join_sl_with_coma_exp as  $sl) {
            
           $single_blog = DB::table('request_id')->where('sl',$sl)->update(
                  [
                    'action_status_ho_checker'=>5,
                   
                    'ho_checker'=>Auth::user()->id,
                    'ho_chkr_aprove_sts_update_date'=>$update_date

                  ]

                );



                $request_generator_data = DB::select(DB::raw("SELECT 
    usr.[name] as req_generator, usr.[email], r_id.[req_id], r_id.[pk_for_sub_br], r_id.[branch_code]

  FROM [request_id] r_id

  left join users usr on r_id.br_maker=usr.id where r_id.sl='$sl'"))[0];

          $request_id = $request_generator_data->req_id;

           $mail_to = $request_generator_data->email;

             $subject = "Request Approved From IT Checker : $request_id";
                    
              $request_sent_date=date('Y-m-d');



             $this->common_func($request_id, Auth::user()->id, 7, $date, $request->ip() );

            $branch_code = $request_generator_data->branch_code;
            $br_pk_id = $request_generator_data->pk_for_sub_br;


            //check sub branch or branch

                    
                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                         $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                         $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch




                  $user_id=Auth::user()->id;
                    


                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.emp_id, usr.user_id as maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id left join [users] br_checker_user  on r_id.br_checker=br_checker_user.id  where r_id.sl='$sl' "))[0];

                $request_id="Request No : $request_id";

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;

                   $maker_user_id = $request_type_info->maker_user_id;
                  $request_generator_id = $request_type_info->br_maker;

                  $br_checker_user_id = $request_type_info->br_checker;

                  $br_checker_user_data = DB::table('users')->where('id',$br_checker_user_id)->first();

                  $authorized_by="Authorized By: ".$br_checker_user_data->name."($br_checker_user_data->emp_id )";


                   $requested_by=$request_type_info->assigned_by."(".$request_type_info->emp_id.")";

                   // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id."Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id  


                   $role_name = "$request_type_name";


                  $get_system_info = DB::table('systems')->where('id',$request_type_system_id)->first();
                  $system_name = $get_system_info->system_name;

                    $module_name="$system_name";

                

                 $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);



        }


      }else{

        echo "This is not ajax request";

      }
    } // end it_checker_approve_all

  

    public function ho_chkr_decline_comment_submit(Request $request){

        if ($request->ajax()) {
            try {
                 $date=date("Y-m-d H:i:s");
                  $update_date=date('Y-m-d');

                $hidden_id =  $request->hidden_id;
                $comment =  $request->comment;
                $request_id =  $request->request_id;

                 $request_id_data = DB::table('request_id')->where('req_id',"$request_id")->first();

               $branch_code = $request_id_data->branch_code;
               $br_pk_id = $request_id_data->pk_for_sub_br;


                $decline_system_name =  $request->decline_system_name;

                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_id')->where('sl',$hidden_id)->update(
                  [
                    'ho_checker_comment'=>$comment,
                     'action_status_ho_checker'=>6,
                    'status'=>6,
                    'ho_decliner'=>Auth::user()->id,
                     'ho_chkr_recheck_sts_update_date'=>$update_date
                    
                  ]

                );

                 $this->common_func($request_id, Auth::user()->id, 8, $date, $request->ip() );


                 //for mailing function


                 $user_data = DB::select(DB::raw("SELECT 
                    usr.[name] as req_generator_name, usr.email
                      FROM [dbfive].[dbo].[request_id] r_id

                      left join users usr on r_id.ho_maker= usr.id where r_id.req_id='$request_id'"))[0];



                 
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.emp_id, usr.user_id as maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id left join [users] br_checker_user  on r_id.br_checker=br_checker_user.id  where r_id.req_id='$request_id' "))[0];



                $user_id=Auth::user()->id;

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;


                     $maker_user_id = $request_type_info->maker_user_id;
                  $request_generator_id = $request_type_info->br_maker;


                    // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id."Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id  

                   $role_name = "$request_type_name";

                

                  $mail_to = $user_data->email;
                $subject = "Decline from IT Checker  : $request_id";


                $request_id = "Request No : $request_id";

                 $request_sent_date=date('Y-m-d');

                 // $branch_code=Auth::user()->branch;

                     //check sub branch

                    
                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                         $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                         $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch


                    $emp_id=Auth::user()->emp_id;
                  
                  $requested_by=$request_type_info->assigned_by."(".$request_type_info->emp_id.")";
                  $authorized_by="Declined By: ".Auth::user()->name."( $emp_id )";
                 

                

                    $module_name="$decline_system_name";



                 $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

                 


            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        } else {
            echo 'This request is not ajax !';
        }

    } // end function ho_chkr_decline_comment_submit


    public function it_checker_decline_all(Request $request){

      if ($request->ajax()) {

          $date=date("Y-m-d H:i:s");
          $update_date=date('Y-m-d');

          $join_sl_with_coma = $request->join_sl_with_coma;
          $it_checker_decline_reason_all = $request->it_checker_decline_reason_all;


           $join_sl_with_coma_exp = explode(',', $join_sl_with_coma);

        foreach ($join_sl_with_coma_exp as  $sl) {

           $single_blog = DB::table('request_id')->where('sl',$sl)->update(
                  [
                    'ho_checker_comment'=>$it_checker_decline_reason_all,
                     'action_status_ho_checker'=>6,
                    'status'=>6,
                    'ho_decliner'=>Auth::user()->id,
                     'ho_chkr_recheck_sts_update_date'=>$update_date
                    
                  ]

                );


               $user_data = DB::select(DB::raw("SELECT 
                    usr.[name] as req_generator_name, usr.email, r_id.[req_id], r_id.[pk_for_sub_br],r_id.[branch_code]
                      FROM [dbfive].[dbo].[request_id] r_id

                      left join users usr on r_id.ho_maker= usr.id where r_id.sl='$sl'"))[0];



                 
                     $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name, r_id.br_maker,r_id.br_checker, usr.name as assigned_by, usr.emp_id, usr.user_id as maker_user_id

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id left join [users] usr on r_id.br_maker = usr.id left join [users] br_checker_user  on r_id.br_checker=br_checker_user.id  where r_id.sl='$sl' "))[0];


                $request_id = $user_data->req_id;
                $br_pk_id = $user_data->pk_for_sub_br;
                $branch_code = $user_data->branch_code;

                $this->common_func($request_id, Auth::user()->id, 8, $date, $request->ip() );



                 $user_id=Auth::user()->id;

                  $request_type_name = $request_type_info->request_type_name;
                  $request_type_system_id = $request_type_info->request_type_system_id;


                     $maker_user_id = $request_type_info->maker_user_id;
                  $request_generator_id = $request_type_info->br_maker;


                    // system mapping user id
                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $request_generator_id)->first();

                         

                           if (isset($system_data_get)) {

                             $final_user_id ="User Id :".$system_data_get->sys_user_id."Domain ID: $maker_user_id";

                           }else{

                              $final_user_id =" Domain ID: $maker_user_id";

                           }

                      } // system mapping user id  

                   $role_name = "$request_type_name";

                

                  $mail_to = $user_data->email;
                $subject = "Decline from IT Checker  : $request_id";


                $request_id = "Request No : $request_id";

                 $request_sent_date=date('Y-m-d');

                 // $branch_code=Auth::user()->branch;



                     //check sub branch or branch

                      if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

 
                       $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                       $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                      }else{

                         $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                         $branch_name = $br_info_data->name." ($branch_code) ";

                      }

                      //end check sub branch


                    $emp_id=Auth::user()->emp_id;
                  
                  $requested_by=$request_type_info->assigned_by."(".$request_type_info->emp_id.")";
                  $authorized_by="Declined By: ".Auth::user()->name."( $emp_id )";
                 

                  $get_system_info = DB::table('systems')->where('id',$request_type_system_id)->first();

                  $decline_system_name = $get_system_info->system_name;
                    $module_name="$decline_system_name";



                 $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);





              } // end foreach

        }

    } // end function it_checker_decline_all

    
}
