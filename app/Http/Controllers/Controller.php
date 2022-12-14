<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use PDF;
use Exception;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    
    public $mail_to = "";
    public $subject = "";

    public $request_id = "";
    public $request_sent_date = "";
    public $branch_name = "";
    public $requested_by = "";
    public $authorized_by = "";
    public $operations_div_auth = "";

    public $user_id = "";
    public $requested_role = "";
    public $module_name = "";

    public $mailled_by = "";
    public $role_name = "";
    public $audit_id = "";

   public function common_func($request_id, $user_id, $flag, $date, $ip_address){

         //$var = $request_id.' '.$user_id.' '. $flag.' '.$date.' '.$ip_address;


         DB::table('user_audit_log')->insert([

            'request_id'=>$request_id,
            'operation_user'=>$user_id,
            'operation'=>$flag,
            'operation_date_time'=>$date,
            'ip_address'=>$ip_address

         ]);

   
    }


    public function mail_send($mail_to, $subject,$request_id, $request_sent_date,$branch_name, $requested_by,$authorized_by,$operations_div_auth='', $user_id,$requested_role,$module_name){
      
     
    


        $this->mail_to = $mail_to;
        $this->subject = $subject; 

        $this->request_id = $request_id;   
        $this->request_sent_date = $request_sent_date;   
        $this->branch_name = $branch_name;   
        $this->requested_by = $requested_by;  

        $this->authorized_by = $authorized_by;
        $this->operations_div_auth = $operations_div_auth;   
        $this->user_id = $user_id;   
        $this->requested_role = $requested_role;   
        $this->module_name = $module_name; 
        




            try{



            
                 $data = array('request_id'=>"$request_id", 'request_sent_date'=>"$request_sent_date",'branch_name'=>"$branch_name",'requested_by'=>"$requested_by",'authorized_by'=>"$authorized_by",'operations_div_auth'=>"$operations_div_auth",'user_id'=>"$user_id",'requested_role'=>"$requested_role",'module_name'=>"$module_name");


                //   file_put_contents('mailmm2.txt',$this->mail_to.','.'subject'.$this->subject);

                // file_put_contents('mailmm.txt',json_encode($data));
                 

                  Mail::send('email-template', $data, function($message) {
                     $message->to($this->mail_to, 'User Management System')->subject($this->subject);       
                  });

     



            


            }catch(Exception $e){

                file_put_contents('Exception.txt', $e->getMessage());
                return $e->getMessage();

            }

            
        } //end mail_send function





    //     public function mail_send_ho_auth($mail_to, $subject,$request_id, $request_sent_date,$branch_name, $requested_by,$authorized_by,$operations_div_auth, $user_id,$requested_role,$module_name){


         


    //     $this->mail_to = $mail_to;
    //     $this->subject = $subject; 

    //     $this->request_id = $request_id;   
    //     $this->request_sent_date = $request_sent_date;   
    //     $this->branch_name = $branch_name;   
    //     $this->requested_by = $requested_by;  

    //     $this->authorized_by = $authorized_by;   
    //     $this->operations_div_auth = $operations_div_auth;   
    //     $this->user_id = $user_id;   
    //     $this->requested_role = $requested_role;   
    //     $this->module_name = $module_name;


    //       try{

            
    //              $data = array('request_id'=>"$request_id", 'request_sent_date'=>"$request_sent_date",'branch_name'=>"$branch_name",'requested_by'=>"$requested_by",'authorized_by'=>"$authorized_by",'operations_div_auth'=>"$operations_div_auth",'user_id'=>"$user_id",'requested_role'=>"$requested_role",'module_name'=>"$module_name");


                

    //               Mail::send('email-template', $data, function($message) {
    //                  $message->to($this->mail_to, 'User Management System')->subject($this->subject);       
    //               });
            


    //         }catch(Exception $e){

               
    //             return $e->getMessage();

    //         }  


    //     }



        public function audit_sheet_mail_send($mail_to, $subject,  $request_sent_date,$branch_name,$mailled_by,$user_id,$role_name, $audit_id){

        

              $this->mail_to = $mail_to;
              $this->subject = $subject; 

             
              $this->request_sent_date = $request_sent_date;   
              $this->branch_name = $branch_name;   
              $this->mailled_by = $mailled_by;   
              $this->user_id = $user_id;   
              $this->role_name = $role_name;   
              $this->audit_id = $audit_id;   
             

              $data = array( 'request_sent_date'=>"$request_sent_date",'branch_name'=>"$branch_name",'mailled_by'=>"$mailled_by",'user_id'=>"$user_id",'role_name'=>"$role_name","$audit_id");


                // pdf file atttached



              $audit_simple_data = DB::table('audit_id')->where('id', $this->audit_id)->first();
    $email = $audit_simple_data->email;
    $remarks_system = $audit_simple_data->remarks_system;

    $maker_id = $audit_simple_data->maker;
    $checker_id = $audit_simple_data->checker;

     $sub_br_pk="";
     $branch_name="";

    if ($audit_simple_data->sub_br_pk) {

      $sub_br_pk = $audit_simple_data->sub_br_pk;

      $sub_br_pk_data = DB::table('branch_info')->where('agent_br_key',$sub_br_pk)->first();

     
       $branch_name= "<p>Branch Name: $sub_br_pk_data->name</p>";

    }else{

     

       $branch_name= "<p>Branch Name: $audit_simple_data->branch_name</p>";

    }
    



   $maker_info = DB::table('users')->where('id',$maker_id)->first();

   $maker_name = $maker_info->name;
   $maker_designation = $maker_info->designation;

   $checker_name="";
   $checker_designation="";

   if ($checker_id) {
      
      $checker_info = DB::table('users')->where('id',$checker_id)->first();

       $checker_name = $checker_info->name;
       $checker_designation = $checker_info->designation;

   }

   if ($audit_simple_data->division_name) {

     $division_name="<p>Division Name: $audit_simple_data->division_name</p>";
   }else{
     $division_name="";
   }
   


    $yes_checked_change_req="";
    $no_checked_change_req="";

    if ($audit_simple_data->change_req=='Yes') {
        
        $yes_checked_change_req = "checked";

    }elseif ($audit_simple_data->change_req=='No') {

       $no_checked_change_req = "checked";

    }

    $yes_checked_change_exe="";
    $no_checked_change_exe="";

    if($audit_simple_data->change_exe=='Yes'){
     
        $yes_checked_change_exe = "checked";

    }elseif($audit_simple_data->change_exe=='No'){

       $no_checked_change_exe = "checked";
    }

    $data_audit_system = DB::select(DB::raw("SELECT 
      distinct aus.system_id

  FROM [audit_system] aus where audit_id='$this->audit_id'"));

    $system_name_info ='';

    $system_audit_table_info='';

    $system_exist_this_audit_id=[];

  foreach($data_audit_system as $single_data_audit_system){

       

    $system_id = $single_data_audit_system->system_id;

     array_push($system_exist_this_audit_id, $single_data_audit_system->system_id);
    
    $system_name_data = DB::table('systems')->where('id', $system_id)->first();
    $system_name = $system_name_data->system_name;
  
  
  $system_audit_table_info.= "<tr>
         <td style='border:none; padding:12px;padding-left:0px;' 
          width=''><b> $system_name </b></td>
       </tr> 
     
     <tr>
        <th style='border: 1px solid; font-size:12px; padding:5px; text-align:center;' width='20%'>USER ID</th>
        <th style='border: 1px solid; font-size:12px;text-align:center;' width='30%'>NAME</th>
        <th style='border: 1px solid; font-size:12px; text-align:center;' width='15%'>ACTIONS</th>
        <th style='border: 1px solid; font-size:12px;text-align:center;' width='20%'>DISABLE PERIOD</th>
        <th style='border: 1px solid; font-size:12px; text-align:center;' width='15%'>REMARKS</th>
  
   </tr>";

  

     $audit_system_info = DB::select(DB::raw("SELECT 
      *
  FROM [audit_system] aus where aus.audit_id='$this->audit_id' and aus.system_id='$system_id'"));

     foreach($audit_system_info as $single_audit_system_info){

        $paddingBox = "padding:2px";

        if(empty($single_audit_system_info->user_id)){
          $paddingBox = "padding:10px";
        }


         $system_audit_table_info.="<tr style='border:1px solid black;'>
         <td style='border: 1px solid black; $paddingBox ;text-align:center;'
          width='20%'>$single_audit_system_info->user_id</td>

         <td style='border:1px solid black;text-align:center;'
          width='30%'>$single_audit_system_info->name</td>

        <td style='border:1px solid black;text-align:center;' 
        width='15%'>$single_audit_system_info->action</td>

         <td style='border:1px solid black;text-align:center;' 
        width='20%'>$single_audit_system_info->disable_period</td>


         <td style='border:1px solid black; text-align:center;'
          width='15%'>$single_audit_system_info->remarks</td>

       </tr>";

     }

 

  }

  $checked_system_ubs="";
  if (in_array('1', $system_exist_this_audit_id)) {

     $checked_system_ubs="checked";
  }else{
     $checked_system_ubs= "";
  }


   $checked_system_rtgs="";
  if (in_array('6', $system_exist_this_audit_id)) {

     $checked_system_rtgs="checked";
  }else{
     $checked_system_rtgs= "";
  }


   $checked_system_cps="";
  if (in_array('4', $system_exist_this_audit_id)) {

     $checked_system_cps="checked";
  }else{
     $checked_system_cps= "";
  }

    $checked_system_eftn="";
  if (in_array('5', $system_exist_this_audit_id)) {

     $checked_system_eftn="checked";
  }else{
     $checked_system_eftn= "";
  }

    $checked_system_gefu="";
  if (in_array('1012', $system_exist_this_audit_id)) {

     $checked_system_gefu="checked";
  }else{
     $checked_system_gefu= "";
  }


    $checked_system_passport="";
  if (in_array('1002', $system_exist_this_audit_id)) {

     $checked_system_passport="checked";
  }else{
     $checked_system_passport= "";
  }

      $checked_system_bkash="";
  if (in_array('1001', $system_exist_this_audit_id)) {

     $checked_system_bkash="checked";
  }else{
     $checked_system_bkash= "";
  }

     $checked_system_utility_bill="";
  if (in_array('1003', $system_exist_this_audit_id)) {

     $checked_system_utility_bill="checked";
  }else{
     $checked_system_utility_bill= "";
  }

     $checked_system_remitbook="";
  if (in_array('2', $system_exist_this_audit_id)) {

     $checked_system_remitbook="checked";
  }else{
     $checked_system_remitbook= "";
  }

     $checked_system_dbcube="";
  if (in_array('3', $system_exist_this_audit_id)) {

     $checked_system_dbcube="checked";
  }else{
     $checked_system_dbcube= "";
  }


               $data["email"]=$this->mail_to;
              $data["client_name"]='';
              $data["subject"]='User Access Audit Sheet Acknowledgement Form';
              $data["content"]= '<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title></title>
      <style>
         .parent {
         margin: 1rem;
         padding: 2rem 2rem;
         text-align: center;
         }
         .child {
         display: inline-block;
         padding: 1rem 1rem;
         vertical-align: middle;
         }
         .child1{
         margin-left: 7px;
         }
         .child2{
         margin-left: 200px;
         }


      </style>
   </head>
   <body>
    <img width="200px" height="50px" style="margin-left:71%" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QAiRXhpZgAATU0AKgAAAAgAAQESAAMAAAABAAEAAAAAAAD/4THoaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pg0KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyI+PHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj48cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0idXVpZDpmYWY1YmRkNS1iYTNkLTExZGEtYWQzMS1kMzNkNzUxODJmMWIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyI+PHhtcDpDcmVhdG9yVG9vbD5XaW5kb3dzIFBob3RvIEVkaXRvciAxMC4wLjEwMDExLjE2Mzg0PC94bXA6Q3JlYXRvclRvb2w+PHhtcDpDcmVhdGVEYXRlPjIwMjEtMDQtMTFUMTE6NTM6MTguMjk2PC94bXA6Q3JlYXRlRGF0ZT48L3JkZjpEZXNjcmlwdGlvbj48L3JkZjpSREY+PC94OnhtcG1ldGE+DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8P3hwYWNrZXQgZW5kPSd3Jz8+/9sAQwACAQECAQECAgICAgICAgMFAwMDAwMGBAQDBQcGBwcHBgcHCAkLCQgICggHBwoNCgoLDAwMDAcJDg8NDA4LDAwM/9sAQwECAgIDAwMGAwMGDAgHCAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwM/8AAEQgAOwDiAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/VD/AILCft4+IP8AgnB+xjefEzwzoejeItVt9a0/S0s9VkljtitxNsZiY/nyB0x3PIPSvypP/B3X8ZiP+SQ/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"/>

  <p>
    <span style="text-transform:uppercase;font-size:10px;margin-left:72%;">Information Technology Division</span>
  </p>

  <h3 align="center">User Access Audit Sheet Acknowledgement Form</h3>

      <form>

            <label style="margin-top:40px;display:none;">Email To:</label>

           <input style="width:600px; height:25px;margin-top:10px;margin-left:10px;display:none;" type="text"  name="email_to" value="'.$email.'"> 


           <p>&nbsp;</p>
            <span style="">Branch Code: '.$audit_simple_data->branch_code.'</span>

            <span style="text-align:right;float:right;">Date : '.$audit_simple_data->date.'</span>

           

             '.$branch_name.'

             '.$division_name.'
            
             <p style="margin-top:-12px;">Received Date: '.$audit_simple_data->received_date.'</p>

             <p>Dear Sir, <br>
Thank you for providing User Access Audit Sheet for the month of '.$audit_simple_data->previous_month.'
We have received user access audit sheet from your Branch/Division for following systems:
</p>    
    
     <input type="checkbox" value="1" name="UBS" id="UBS" '.$checked_system_ubs.' style="margin-top:5px;"> UBS

     &nbsp;
       <input type="checkbox" value="6" name="RTGS" id="RTGS"  '.$checked_system_rtgs.' style="margin-top:5px;"> RTGS &nbsp;

      <input type="checkbox" value="4" name="CPS" id="CPS"  '.$checked_system_cps.' style="margin-top:5px;"> CPS &nbsp;
      
      <input type="checkbox" value="5" name="EFTN" id="EFTN" '.$checked_system_eftn.' style="margin-top:5px;"> EFTN &nbsp;

      <input type="checkbox" value="7" name="GEFU" id="GEFU"  '.$checked_system_gefu.' style="margin-top:5px;"> GEFU &nbsp;

      <input type="checkbox" value="8" name="Passport" '.$checked_system_passport.' id="Passport"  style="margin-top:5px;"> Passport &nbsp;

      <input type="checkbox" value="9" name="BKash" id="BKash" '.$checked_system_bkash.' style="margin-top:5px;"> BKash &nbsp;

      <input type="checkbox" value="10" name="Utility_Bill" 
      '.$checked_system_utility_bill.' id="Utility_Bill"  style="margin-top:5px;"> Utility Bill &nbsp;

      <input type="checkbox" value="2" name="remitbook" '.$checked_system_remitbook.' id="remitbook" style="margin-top:5px;"> Remitbook &nbsp;

      <input type="checkbox" value="3" name="dbcube" 
       '.$checked_system_dbcube.'  id="dbcube" style="margin-top:5px;"> New Dbcube &nbsp;

      <p><b>Change Requested :  </b>  <input type="checkbox" value="Yes"  style="margin-top:5px;" id="change_req_yes" name="change_req_yes" '.$yes_checked_change_req.'>&nbsp; Yes

      <input type="checkbox" style="margin-top:5px;" value="No" id="change_req_no" name="change_req_no" '.$no_checked_change_req.'>&nbsp; NO
      </p>


       <p style="margin-top:-15px;"><b>Change Executed :  </b>

         <input type="checkbox"  style="margin-top:5px;" value="Yes" id="change_exe_yes" name="change_exe_yes" style="margin-top:5px;"  '.$yes_checked_change_exe.'>&nbsp; Yes


        <input type="checkbox" style="margin-top:5px;" value="No" id="change_exe_no" name="change_exe_no"  '.$no_checked_change_exe.'>&nbsp; NO

      </p>


        </form>  

           <p>As per your request we have made following changes:</p> 

      '.$system_name_info.'



     <table width="100%" style="border-bottom: 1px;">  
    '.$system_audit_table_info.'
  </table>
  <p><b>Remarks:</b> Please note that we did not receive User Access Audit Sheet of '.$remarks_system.'. You are requested to send the
    file as early as possible.</p>



      <div class="parent">
         <div class="child child1">
            <span style="font-weight:bold;">Maker</span><br>
            <span style="font-weight:bold;">'.$maker_name.'</span> <br>
            <span>'.$maker_designation.'</span>
         </div>
         <div class="child child2">
            <span style="font-weight:bold;">Cheker</span><br>
            <span style="font-weight:bold;">'.$checker_name.'</span> <br>
            <span>'.$checker_designation.'</span>
         </div>
      </div>

<hr>
          <p style="font-weight:bold">Information Technology Division, 71, Purana Paltan Lane, Dhaka-1000, Bangladesh
Tel: 58314424, Fax: 880-2-58314419, Website: www.dhakabankltd.com ,E-mail : info@dhakabank.com.bd
    </p>
   </body>
</html>
     ';

              $pdf = PDF::loadView('mails.mail', $data);

              try{
                  Mail::send('mails.body', $data, function($message)use($data,$pdf) {
                  $message->to($data["email"], $data["client_name"])
                  ->subject($data["subject"])
                  ->attachData($pdf->output(), "audit_sheet.pdf");
                  });
                  return "mail check";
              }catch(Exception $e){
                 return $e->getMessage(); 
              }
                // pdf file atttached

                  Mail::send('email-template_audit_sheet', $data, function($message) {
                     $message->to($this->mail_to, 'User Management System')->subject($this->subject);       
                  });
            
             

        }


     public function mail_send_ho_checker(){

           file_put_contents('gfgfgdfsfd.txt', 'test data');

      }
            

}
