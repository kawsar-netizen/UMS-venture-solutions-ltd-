<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Exception;
use Mail;

class ReportController extends Controller
{   


    public function __construct()
    {
        $this->middleware('auth');
    }

   






//    public function activities_report(){

//       return view('report.activities_report');

//     }


//    public function activities_report_data_table(Request $request){


//        $branch_code = $request->select_branch;
//        $sub_branch = $request->sub_branch;
     
//        $systems = $request->module;
//        $division = $request->division;
//        $status = $request->status;
//        $user_id = $request->user_id;
//        $request_type = $request->request_type;


//        $get_frm_date = $request->frm_date;
//        $get_to_date = $request->to_date;

     
     
        
//         $condition="";

//        if ($branch_code && $systems && $division && $status && $user_id &&  $get_frm_date && $get_to_date) {
         
//           $frm_date = date('Y-m-d', strtotime($get_frm_date));
//           $to_date = date('Y-m-d', strtotime($get_to_date));



//           $condition ="  where r_id.status='$status'   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and 
// u.division_name='$division' 
//    and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

//        }elseif ($branch_code && $systems && $division && $status && $user_id &&  $get_frm_date) {
        
//          $frm_date = date('Y-m-d', strtotime($get_frm_date));
//           $to_date = date('Y-m-d');



//           $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division' 
//    and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


//            if ($status=='7') {
                  
                 

//                       $condition ="  where (r_id.status='7' and r_id.action_status='7') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//          and u.division_name='$division' 
//        and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


//              }elseif ($status=='3') {
                  
                 

//                    $condition ="  where (r_id.status='3' and r_id.action_status_ho_checker='5') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//          and u.division_name='$division' 
//        and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";

//              }elseif ($status=='2') {
                  
                 

//                     $condition ="  where (r_id.status='2' and r_id.action_status_ho_checker='5') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//          and u.division_name='$division' 
//        and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

//              }elseif ($status=='1') {
                  
                 
//                      $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//          and u.division_name='$division' 
//        and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

//              }elseif($status=='10'){

               

//                    $condition ="  where  r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL) and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//          and u.division_name='$division' 
//        and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


//              }


//        }elseif ($branch_code && $systems && $division && $status && $user_id) {


//          if ($status=='7') {
              
              


//                  $condition =" where ( r_id.status='7' and r_id.action_status='7')  and     r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division'  order by r_id.sl desc ";

//          }elseif ($status=='3') {
              
             

//                $condition =" where ( r_id.status='3' and r_id.action_status_ho_checker='5')   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division'  order by r_id.sl desc ";

//          }elseif ($status=='2') {
              
             

//                 $condition =" where (r_id.status='2' and r_id.action_status_ho_checker='5' )   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division'  order by r_id.sl desc ";

//          }elseif ($status=='1') {
              
            

//                 $condition =" where (r_id.status='0' and r_id.action_status_br_checker='1'  )    and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division'  order by r_id.sl desc ";

//          }elseif($status=='10'){

            

//               $condition =" where  r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)    and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
//      and u.division_name='$division'  order by r_id.sl desc ";

//          }
        
      
        


//        }elseif ($branch_code && $systems && $division && $status ) {

//                if ($status=='7') {
                  
                

//                     $condition ="  where (r_id.status='7' and r_id.action_status='7')    and r_id.branch_code='$branch_code' and s.id='$systems'
//          and u.division_name='$division'  order by r_id.sl desc ";


//              }elseif ($status=='3') {
                  
                  


//                     $condition ="   where (r_id.status='3' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'
//          and u.division_name='$division'  order by r_id.sl desc ";


//              }elseif ($status=='2') {
                  
                 

//                     $condition ="  where  (r_id.status='2' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'
//          and u.division_name='$division'  order by r_id.sl desc ";

//              }elseif ($status=='1') {
                  
                 
//                      $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1')  and r_id.branch_code='$branch_code' and s.id='$systems'
//          and u.division_name='$division'  order by r_id.sl desc ";

//              }elseif($status=='10'){



//                   $condition ="   where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)   and r_id.branch_code='$branch_code' and s.id='$systems'
//          and u.division_name='$division'  order by r_id.sl desc ";



//              }
        
     
        

//        }elseif ($branch_code && $systems  && $status ) {

//                if ($status=='7') {
                  
                

//                     $condition ="  where (r_id.status='7' and r_id.action_status='7')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


//              }elseif ($status=='3') {
                  
                  


//                     $condition ="   where (r_id.status='3' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


//              }elseif ($status=='2') {
                  
                 

//                     $condition ="  where  (r_id.status='2' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";

//              }elseif ($status=='1') {
                  
                 
//                      $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1')  and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";

//              }elseif($status=='10'){



//                   $condition ="   where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)   and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";



//              }
        
     
        

//        }elseif ($branch_code && $systems && $division ) {
        
        
//           $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems'
//      and u.division_name='$division'  order by r_id.sl desc";


//        }elseif ($branch_code && $systems) {
        
        
//           $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


//        }elseif ($branch_code && ($sub_branch=="" || $sub_branch==NULL || $sub_branch=="0")) {

           

            
        
//          if(Auth::user()->role=='1' ){

//              $auth_my_branch =  Auth::user()->branch;
//              $br_maker =  Auth::user()->id;

//              $condition ="  where  r_id.branch_code='$auth_my_branch' and r_id.br_maker='$br_maker'  ";
          

//           }elseif(Auth::user()->role=='5' ){

//              $auth_my_branch =  Auth::user()->branch;
//              $br_maker =  Auth::user()->id;

//              $condition ="  where  r_id.branch_code='$auth_my_branch'  ";

//           }else{

//               $condition ="  where  r_id.branch_code='$branch_code'   order by r_id.sl desc ";
//           }
          


       

          
//        }elseif ($branch_code && $sub_branch) {

//              $condition ="  where  r_id.pk_for_sub_br='$sub_branch'  order by r_id.sl desc ";



          
//        }elseif ($systems and $request_type !='33' ) {
        
//           $condition ="  where   s.id='$systems'   order by r_id.sl desc ";
      

//        }elseif ($systems=='6' and $request_type=='33' ) {
        
//           $condition ="  where   s.id='$systems'  and  r_id.request_type_id='$request_type' order by r_id.sl desc";
      

//        }elseif ($division) {
        
       
//           $condition ="  where  u.division_name='$division'  order by r_id.sl desc";
      

//        }elseif ($status) {

      
        
//          if ($status=='7') {
              
//                $condition ="  where  r_id.status='7' and r_id.action_status='7'  order by r_id.sl desc";

//          }elseif ($status=='3') {
              
//                $condition ="  where  r_id.status='3' and r_id.action_status_ho_checker='5'  order by r_id.sl desc";

//          }elseif ($status=='2') {
              
//                $condition ="  where  r_id.status='2' and r_id.action_status_ho_checker='5'  order by r_id.sl desc";

//          }elseif ($status=='1') {
              
//                $condition ="  where r_id.status='0' and r_id.action_status_br_checker='1'  order by r_id.sl desc";

//          }elseif($status=='10'){

//              $condition ="  where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL) order by r_id.sl desc ";
//          }
         
      
//        }elseif ($user_id) {

//        $get_user_data = DB::table('users')->where('user_id',$user_id)->first();
          

//            // if ($get_user_data->id) {
//            //      $user_pk_id =  $get_user_data->id;
//            //   $condition ="   where r_id.br_maker='$user_pk_id'  ";
//            // }

//            if ($get_user_data->id) {
//                 $user_pk_id =  $get_user_data->id;

//               $get_system_user_data =  DB::table('system_user_id')->where('user',$user_pk_id)->first();

//               if ($get_system_user_data->user) {

//                  $system_user_id_table_user_id =  $get_system_user_data->user;
                  
//                   $condition ="   where r_id.br_maker='$system_user_id_table_user_id'  order by r_id.sl desc";

//               }
             
//            }
          
      

//        }elseif($request_type){

//          $condition ="   where r_id.request_type_id='$request_type'  order by r_id.sl desc";

//        }elseif ($get_frm_date) {

//          $frm_date = date('Y-m-d', strtotime($get_frm_date));
//           $to_date = date('Y-m-d');
               
//           $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'   order by r_id.sl desc";
      

//        }elseif ($get_to_date) {

//          $frm_date = date('Y-m-d');
//           $to_date = date('Y-m-d');
               
//           $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc";
      

//        }elseif ($get_frm_date && $get_to_date) {

//          $frm_date = date('Y-m-d',strtotime($get_frm_date));
//           $to_date = date('Y-m-d',strtotime($get_to_date));
               
//           $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc";
      

//        }else{

//           $maker_user_id = Auth::user()->id;
          
//           if(Auth::user()->role=='1'){

//             $auth_branch = Auth::user()->branch;

//              $condition ="  where  r_id.branch_code='$auth_branch'  and r_id.br_maker='$maker_user_id'  order by r_id.sl desc";

//           }elseif(Auth::user()->role=='5'){
//             $auth_branch = Auth::user()->branch;

//             $condition ="  where  r_id.branch_code='$auth_branch' order by r_id.sl desc ";

//           }else{
//               $condition = " order by r_id.sl desc";
//           }

         
//        }

      
      
// // r_id.status='$status'   and r_id.branch_code='$branch_code' and s.id='$systems' u.division_name

//        $request_array = [];





//           $requests = DB::select(DB::raw("SELECT
//        r_id.[sl],
//        [req_id],
//        r_id.[status],
//        r_id.[action_status],
//        r_id.[action_status_br_checker],
//        r_id.[br_checker_assign_manual_id],
//        r_id.[br_authorizer],
//        r_id.[recheck_status],
//        r_id.[ho_chkr_aprove_sts_update_date],
//        r_id.[ho_checker_comment],
//        r_id.[ho_decliner],
//        r_id.[br_checker_sts_update_date],
//        [branch_code],
//        [br_maker],
//        [br_checker],
//        [ho_maker],
//        [ho_checker],
//        r_id.[entry_date],
//        r_id.[action_status_ho_maker],
//        r_id.[action_status_ho_checker],
//        r_id.[pk_for_sub_br],
//        r.[sys_id],
//        r.[para_id],
//        r.[value],
//        sys.[para_name],
//        sys.[para_type],
//        s.[system_name],
//         sys.[system_id],

//         r_id.[request_type_id],
//     rt.[request_type_name],
//     rt.[system_id] as rt_system_id,
//     r_id.[request_type_value],
//     r_id.[created_user_id],
//     r_id.[created_password],
//     r_id.[ho_maker_remarks],
//     r_id.[ho_authorizer],
//     r_id.[ho_authorize_status],
//     r_id.[canceled_by],
//     r_id.[cancel_reason],
//     r_id.[rechecker],
//     r_id.[br_checker_recheck_reason],

//         sys.[para_type],
//        u.[name] as branch_maker_name, 
//        u.[role] as user_role,
//        u.[division_id],
//        u.[division_name],
//        u.[user_id],
//        u.[id] as user_pk_id,
//        u.[br_pk_id]

//     FROM
//        [dbo].[request_id] as r_id 
//        left join
//           request as r 
//           on r.request_id = r_id.req_id 
//        left join
//           [sys_parameters] as sys 
//           on r.para_id = sys.para_id 
//        left join
//           [systems] as s 
//           on s.id = r.sys_id 
//        left join
//           [users] as u 


//           on r_id.br_maker = u.id

//         left join 
//         [request_type] rt

//         on r_id.request_type_id = rt.id


//     $condition  "));

//       foreach($requests as $request){ //pk_for_sub_br is request_id table column

//         $request_array[$request->req_id] = [

//           "request_id" => $request->sl,
//           "req_id" => $request->req_id,
//           "para_id" => $request->para_id,
//           "br_maker" => $request->br_maker,
//            "entry_date" => $request->entry_date,
//           "request_type_system_id" => $request->rt_system_id,

//           "system_id" => $request->sys_id,
//           "request_type_id" => $request->request_type_id,
//           "ho_checker_comment" => $request->ho_checker_comment,
//           "ho_decliner" => $request->ho_decliner,
//           "br_checker_sts_update_date" => $request->br_checker_sts_update_date,
//           "action_status_ho_maker" => $request->action_status_ho_maker,
//           "action_status_ho_checker" => $request->action_status_ho_checker,
//           "user_pk_id" => $request->user_pk_id,
//           "pk_for_sub_br" => $request->pk_for_sub_br,
          
         
//           "status" => $request->status,
//           "action_status" => $request->action_status,
//           "action_status_br_checker" => $request->action_status_br_checker,
//           "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
//           "br_authorizer" => $request->br_authorizer,
//           "rechecker" => $request->rechecker,
//           "br_checker_recheck_reason" => $request->br_checker_recheck_reason,
//           "br_pk_id" => $request->br_pk_id,

//           "ho_authorizer" => $request->ho_authorizer,
//           "ho_authorize_status" => $request->ho_authorize_status,

//           "user_name" => $request->branch_maker_name,
//           "br_maker_domain_id" => $request->user_id,
//           "br_checker" => $request->br_checker,
//           "recheck_status" => $request->recheck_status,

//           "ho_maker" => $request->ho_maker,
//           "ho_checker" => $request->ho_checker,
//           "branch_code" => $request->branch_code,
//           "system_name" => $request->system_name,
//           "input_value" => $request->system_name,
//           "request_type_name" => $request->request_type_name,
//           "request_type_value" => $request->request_type_value,
//           "created_user_id" => $request->created_user_id,
//           "created_password" => $request->created_password,
//           "ho_maker_remarks" => $request->ho_maker_remarks,
//           "user_role_id" => $request->user_role,
//           "division_id" => $request->division_id,
//           "division_name" => $request->division_name,
//           "canceled_by" => $request->canceled_by,
//           "cancel_reason" => $request->cancel_reason,
//           "ho_chkr_aprove_sts_update_date"=>$request->ho_chkr_aprove_sts_update_date,

//           "operation_name" => [],
//           "para_list" => [

//           ],
//           "request_type" => [],
//         ];

//       }
      
//      foreach($requests as $request){
//         if ($request->system_id=='') {
            
//             array_push($request_array[$request->req_id]["request_type"], urldecode($request->value));
//         }else{

//           array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));
//         }
          
//       }
      
//       foreach($requests as $request){
//         $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
//         $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
//       }
      
      
      

      
      
//       //return $request_array;


     

//        return view('report.activities_report_data_table',[
//             'requests'=>$request_array
//         ]);
    



//     }  // end activities report









    public function user_report_data(Request $request){




       $branch_code = $request->select_branch;
       $sub_branch = $request->sub_branch;
     
       $systems = $request->module;
       $division = $request->division;
       $status = $request->status;
       $user_id = $request->user_id;
       $request_type = $request->request_type;


       $get_frm_date = $request->frm_date;
       $get_to_date = $request->to_date;

     
     
        
        $condition="";

       if ($branch_code && $systems && $division && $status && $user_id &&  $get_frm_date && $get_to_date) {
         
          $frm_date = date('Y-m-d', strtotime($get_frm_date));
          $to_date = date('Y-m-d', strtotime($get_to_date));



          $condition ="  where r_id.status='$status'   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and 
u.division_name='$division' 
   and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

       }elseif ($branch_code && $systems && $division && $status && $user_id &&  $get_frm_date) {
        
         $frm_date = date('Y-m-d', strtotime($get_frm_date));
          $to_date = date('Y-m-d');



          $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division' 
   and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


           if ($status=='7') {
                  
                 

                      $condition ="  where (r_id.status='7' and r_id.action_status='7') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
         and u.division_name='$division' 
       and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


             }elseif ($status=='3') {
                  
                 

                   $condition ="  where (r_id.status='3' and r_id.action_status_ho_checker='5') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
         and u.division_name='$division' 
       and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";

             }elseif ($status=='2') {
                  
                 

                    $condition ="  where (r_id.status='2' and r_id.action_status_ho_checker='5') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
         and u.division_name='$division' 
       and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

             }elseif ($status=='1') {
                  
                 
                     $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1') and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
         and u.division_name='$division' 
       and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' order by r_id.sl desc ";

             }elseif($status=='10'){

               

                   $condition ="  where  r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL) and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
         and u.division_name='$division' 
       and  r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'  order by r_id.sl desc ";


             }


       }elseif ($branch_code && $systems && $division && $status && $user_id) {


         if ($status=='7') {
              
              


                 $condition =" where ( r_id.status='7' and r_id.action_status='7')  and     r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division'  order by r_id.sl desc ";

         }elseif ($status=='3') {
              
             

               $condition =" where ( r_id.status='3' and r_id.action_status_ho_checker='5')   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division'  order by r_id.sl desc ";

         }elseif ($status=='2') {
              
             

                $condition =" where (r_id.status='2' and r_id.action_status_ho_checker='5' )   and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division'  order by r_id.sl desc ";

         }elseif ($status=='1') {
              
            

                $condition =" where (r_id.status='0' and r_id.action_status_br_checker='1'  )    and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division'  order by r_id.sl desc ";

         }elseif($status=='10'){

            

              $condition =" where  r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)    and r_id.branch_code='$branch_code' and s.id='$systems' and  r_id.br_maker='$user_id' 
     and u.division_name='$division'  order by r_id.sl desc ";

         }
        
      
        


       }elseif ($branch_code && $systems && $division && $status ) {

               if ($status=='7') {
                  
                

                    $condition ="  where (r_id.status='7' and r_id.action_status='7')    and r_id.branch_code='$branch_code' and s.id='$systems'
         and u.division_name='$division'  order by r_id.sl desc ";


             }elseif ($status=='3') {
                  
                  


                    $condition ="   where (r_id.status='3' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'
         and u.division_name='$division'  order by r_id.sl desc ";


             }elseif ($status=='2') {
                  
                 

                    $condition ="  where  (r_id.status='2' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'
         and u.division_name='$division'  order by r_id.sl desc ";

             }elseif ($status=='1') {
                  
                 
                     $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1')  and r_id.branch_code='$branch_code' and s.id='$systems'
         and u.division_name='$division'  order by r_id.sl desc ";

             }elseif($status=='10'){



                  $condition ="   where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)   and r_id.branch_code='$branch_code' and s.id='$systems'
         and u.division_name='$division'  order by r_id.sl desc ";



             }
        
     
        

       }elseif ($branch_code && $systems  && $status ) {

               if ($status=='7') {
                  
                

                    $condition ="  where (r_id.status='7' and r_id.action_status='7')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


             }elseif ($status=='3') {
                  
                  


                    $condition ="   where (r_id.status='3' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


             }elseif ($status=='2') {
                  
                 

                    $condition ="  where  (r_id.status='2' and r_id.action_status_ho_checker='5')    and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";

             }elseif ($status=='1') {
                  
                 
                     $condition ="  where (r_id.status='0' and r_id.action_status_br_checker='1')  and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";

             }elseif($status=='10'){



                  $condition ="   where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL)   and r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";



             }
        
     
        

       }elseif ($branch_code && $systems && $division ) {
        
        
          $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems'
     and u.division_name='$division'  order by r_id.sl desc";


       }elseif ($branch_code && $systems) {
        
        
          $condition ="  where  r_id.branch_code='$branch_code' and s.id='$systems'  order by r_id.sl desc";


       }elseif ($branch_code && ($sub_branch=="" || $sub_branch==NULL || $sub_branch=="0")) {

           

            
        
         if(Auth::user()->role=='1' ){

             $auth_my_branch =  Auth::user()->branch;
             $br_maker =  Auth::user()->id;

             $condition ="  where  r_id.branch_code='$auth_my_branch' and r_id.br_maker='$br_maker'  ";
          

          }elseif(Auth::user()->role=='5' ){

             $auth_my_branch =  Auth::user()->branch;
             $br_maker =  Auth::user()->id;

             $condition ="  where  r_id.branch_code='$auth_my_branch'  ";

          }else{

              $condition ="  where  r_id.branch_code='$branch_code'   order by r_id.sl desc ";
          }
          


       

          
       }elseif ($branch_code && $sub_branch) {

             $condition ="  where  r_id.pk_for_sub_br='$sub_branch'  order by r_id.sl desc ";



          
       }elseif ($systems and $request_type !='33' ) {
        
          $condition ="  where   s.id='$systems'   order by r_id.sl desc ";
      

       }elseif ($systems=='6' and $request_type=='33' ) {
        
          $condition ="  where   s.id='$systems'  and  r_id.request_type_id='$request_type' order by r_id.sl desc";
      

       }elseif ($division) {
        
       
          $condition ="  where  u.division_name='$division'  order by r_id.sl desc";
      

       }elseif ($status) {

      
        
         if ($status=='7') {
              
               $condition ="  where  r_id.status='7' and r_id.action_status='7'  order by r_id.sl desc";

         }elseif ($status=='3') {
              
               $condition ="  where  r_id.status='3' and r_id.action_status_ho_checker='5'  order by r_id.sl desc";

         }elseif ($status=='2') {
              
               $condition ="  where  r_id.status='2' and r_id.action_status_ho_checker='5'  order by r_id.sl desc";

         }elseif ($status=='1') {
              
               $condition ="  where r_id.status='0' and r_id.action_status_br_checker='1'  order by r_id.sl desc";

         }elseif($status=='10'){

             $condition ="  where r_id.status='0' and   (r_id.action_status_br_checker='' or r_id.action_status_br_checker=NULL) order by r_id.sl desc ";
         }
         
      
       }elseif ($user_id) {

       $get_user_data = DB::table('users')->where('user_id',$user_id)->first();
          

           // if ($get_user_data->id) {
           //      $user_pk_id =  $get_user_data->id;
           //   $condition ="   where r_id.br_maker='$user_pk_id'  ";
           // }

           if ($get_user_data->id) {
                $user_pk_id =  $get_user_data->id;

              $get_system_user_data =  DB::table('system_user_id')->where('user',$user_pk_id)->first();

              if ($get_system_user_data->user) {

                 $system_user_id_table_user_id =  $get_system_user_data->user;
                  
                  $condition ="   where r_id.br_maker='$system_user_id_table_user_id'  order by r_id.sl desc";

              }
             
           }
          
      

       }elseif($request_type){

         $condition ="   where r_id.request_type_id='$request_type'  order by r_id.sl desc";

       }elseif ($get_frm_date && $get_to_date) {

         $frm_date = date('Y-m-d',strtotime($get_frm_date));
          $to_date = date('Y-m-d',strtotime($get_to_date));


           if(Auth::user()->role=='1' ){

             $auth_my_branch =  Auth::user()->branch;
             $br_maker =  Auth::user()->id;

            
            
             $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' and r_id.branch_code='$auth_my_branch' and r_id.br_maker='$br_maker'  order by r_id.sl desc";

          }elseif(Auth::user()->role=='5' ){

             $auth_my_branch =  Auth::user()->branch;
             $br_checker =  Auth::user()->id;

             $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59' and r_id.branch_code='$auth_my_branch' and r_id.br_checker_assign_manual_id='$br_checker'  order by r_id.sl desc";

          }else{

              $condition ="  where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'    order by r_id.sl desc ";
          }

               
         
      

       }elseif ($get_frm_date) {

         $frm_date = date('Y-m-d', strtotime($get_frm_date));
          $to_date = date('Y-m-d');
               
          $condition ="   where r_id.entry_date  between '$frm_date 00:00:00' and '$to_date 23:59:59'   order by r_id.sl desc";
      

       }else{

          $maker_user_id = Auth::user()->id;
          
          if(Auth::user()->role=='1'){

            $auth_branch = Auth::user()->branch;

             $condition ="  where  r_id.branch_code='$auth_branch'  and r_id.br_maker='$maker_user_id'  order by r_id.sl desc";

          }elseif(Auth::user()->role=='5'){
            $auth_branch = Auth::user()->branch;

            $condition ="  where  r_id.branch_code='$auth_branch' order by r_id.sl desc ";

          }else{
              $condition = " order by r_id.sl desc";
          }

         
       }

      
      
// r_id.status='$status'   and r_id.branch_code='$branch_code' and s.id='$systems' u.division_name

       $request_array = [];





          $requests = DB::select(DB::raw("SELECT
       r_id.[sl],
       [req_id],
       r_id.[status],
       r_id.[action_status],
       r_id.[action_status_br_checker],
       r_id.[br_checker_assign_manual_id],
       r_id.[br_authorizer],
       r_id.[recheck_status],
       r_id.[ho_chkr_aprove_sts_update_date],
       r_id.[ho_checker_comment],
       r_id.[ho_decliner],
       r_id.[br_checker_sts_update_date],
       [branch_code],
       [br_maker],
       [br_checker],
       [ho_maker],
       [ho_checker],
       r_id.[entry_date],
       r_id.[action_status_ho_maker],
       r_id.[action_status_ho_checker],
       r_id.[pk_for_sub_br],
       r.[sys_id],
       r.[para_id],
       r.[value],
       sys.[para_name],
       sys.[para_type],
       s.[system_name],
        sys.[system_id],

        r_id.[request_type_id],
    rt.[request_type_name],
    rt.[system_id] as rt_system_id,
    r_id.[request_type_value],
    r_id.[created_user_id],
    r_id.[created_password],
    r_id.[ho_maker_remarks],
    r_id.[ho_authorizer],
    r_id.[ho_authorize_status],
    r_id.[canceled_by],
    r_id.[cancel_reason],
    r_id.[rechecker],
    r_id.[br_checker_recheck_reason],

        sys.[para_type],
       u.[name] as branch_maker_name, 
       u.[emp_id] as branch_maker_emp_id, 
       u.[role] as user_role,
       u.[division_id],
       u.[division_name],
       u.[designation],
       u.[user_id],
       u.[id] as user_pk_id,
       u.[br_pk_id]

    FROM
       [dbo].[request_id] as r_id 
       left join
          request as r 
          on r.request_id = r_id.req_id 
       left join
          [sys_parameters] as sys 
          on r.para_id = sys.para_id 
       left join
          [systems] as s 
          on s.id = r.sys_id 
       left join
          [users] as u 


          on r_id.br_maker = u.id

        left join 
        [request_type] rt

        on r_id.request_type_id = rt.id


    $condition  "));

      foreach($requests as $request){ 

        $req= $request->req_id;
 $requestsPara = DB::select(DB::raw("SELECT * FROM request req left join sys_parameters para on req.para_id=para.para_id WHERE  req.request_id='$req'"));
 // print "<pre>";
 // print_r($requestsPara);
      //pk_for_sub_br is request_id table column

        $request_array[$request->req_id] = [

          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "para_id" => $request->para_id,
          "br_maker" => $request->br_maker,
           "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
          "branch_maker_emp_id" => $request->branch_maker_emp_id,

          "system_id" => $request->sys_id,
          "request_type_id" => $request->request_type_id,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_decliner" => $request->ho_decliner,
          "br_checker_sts_update_date" => $request->br_checker_sts_update_date,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,
          "user_pk_id" => $request->user_pk_id,
          "pk_for_sub_br" => $request->pk_for_sub_br,
          
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          "action_status_br_checker" => $request->action_status_br_checker,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,
          "br_pk_id" => $request->br_pk_id,

          "ho_authorizer" => $request->ho_authorizer,
          "ho_authorize_status" => $request->ho_authorize_status,

          "user_name" => $request->branch_maker_name,
          "br_maker_domain_id" => $request->user_id,
          "br_checker" => $request->br_checker,
          "recheck_status" => $request->recheck_status,

          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "request_type_name" => $request->request_type_name,
          "request_type_value" => $request->request_type_value,
          "created_user_id" => $request->created_user_id,
          "created_password" => $request->created_password,
          "ho_maker_remarks" => $request->ho_maker_remarks,
          "user_role_id" => $request->user_role,
          "division_id" => $request->division_id,
          "division_name" => $request->division_name,
          "canceled_by" => $request->canceled_by,
          "cancel_reason" => $request->cancel_reason,
          "ho_chkr_aprove_sts_update_date"=>$request->ho_chkr_aprove_sts_update_date,
          "designation"=>$request->designation,

          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
          "parameterList"=>$requestsPara
        ];

      }
      
     foreach($requests as $request){
        if ($request->system_id=='') {
            
            array_push($request_array[$request->req_id]["request_type"], urldecode($request->value));
        }else{

          array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));
        }
          
      }
      
      foreach($requests as $request){
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      

     

       return view('report.user_wise_report_data_table',[
            'requests'=>$request_array
        ]);
      
    } // end user wise report function






    public function request_id(){

        return view('report.request_report');
    }

    public function request_report_data_table(Request $request){

         $request_id = $request->request_id;

         $my_user_auth_id = Auth::user()->id;


      if (Auth::user()->role=='1' || Auth::user()->role=='8' || Auth::user()->role=='9') { // branch Maker or division maker or special role
          
           
        $condition="  and r_id.br_maker='$my_user_auth_id'";


     }elseif(Auth::user()->role=='5' || Auth::user()->role=='10'){  // branch Checker or division checker

         $condition="  and r_id.br_checker_assign_manual_id='$my_user_auth_id'";

     }elseif(Auth::user()->role=='2' || Auth::user()->role=='6'){

         $condition=NULL;
     }



       $requests = DB::select(DB::raw("SELECT
       r_id.[sl],
       [req_id],
       r_id.[status],
       r_id.[action_status],
       r_id.[action_status_br_checker],
       r_id.[br_checker_assign_manual_id],
       r_id.[br_authorizer],
       r_id.[recheck_status],
       r_id.[ho_chkr_aprove_sts_update_date],
       r_id.[ho_checker_comment],
       r_id.[ho_decliner],
       r_id.[br_checker_sts_update_date],
       [branch_code],
       [br_maker],
       [br_checker],
       [ho_maker],
       [ho_checker],
       r_id.[entry_date],
       r_id.[action_status_ho_maker],
       r_id.[action_status_ho_checker],
       r.[sys_id],
       r.[para_id],
       r.[value],
       sys.[para_name],
       sys.[para_type],
       s.[system_name],
        sys.[system_id],

        r_id.[request_type_id],
    rt.[request_type_name],
    rt.[system_id] as rt_system_id,
    r_id.[request_type_value],
    r_id.[created_user_id],
    r_id.[created_password],
    r_id.[ho_maker_remarks],
    r_id.[ho_authorizer],
    r_id.[ho_authorize_status],
    r_id.[canceled_by],
    r_id.[cancel_reason],
    r_id.[rechecker],
    r_id.[br_checker_recheck_reason],

        sys.[para_type],
       u.[name] as branch_maker_name, 
       u.[role] as user_role,
       u.[division_id],
       u.[division_name],
       u.[user_id],
       u.[id] as user_pk_id,
       u.[br_pk_id]

    FROM
       [dbo].[request_id] as r_id 
       left join
          request as r 
          on r.request_id = r_id.req_id 
       left join
          [sys_parameters] as sys 
          on r.para_id = sys.para_id 
       left join
          [systems] as s 
          on s.id = r.sys_id 
       left join
          [users] as u 


          on r_id.br_maker = u.id

        left join 
        [request_type] rt

        on r_id.request_type_id = rt.id 

    where r_id.req_id='$request_id'   $condition "));


     if (!empty($requests)) {
     
    

       foreach($requests as $request){

         $request_array[$request->req_id] = [

          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "para_id" => $request->para_id,
          "br_maker" => $request->br_maker,
           "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,

          "system_id" => $request->sys_id,
          "request_type_id" => $request->request_type_id,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_decliner" => $request->ho_decliner,
          "br_checker_sts_update_date" => $request->br_checker_sts_update_date,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,
          "user_pk_id" => $request->user_pk_id,
          
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          "action_status_br_checker" => $request->action_status_br_checker,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,
          "br_pk_id" => $request->br_pk_id,

          "ho_authorizer" => $request->ho_authorizer,
          "ho_authorize_status" => $request->ho_authorize_status,

          "user_name" => $request->branch_maker_name,
          "br_maker_domain_id" => $request->user_id,
          "br_checker" => $request->br_checker,
          "recheck_status" => $request->recheck_status,

          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "request_type_name" => $request->request_type_name,
          "request_type_value" => $request->request_type_value,
          "created_user_id" => $request->created_user_id,
          "created_password" => $request->created_password,
          "ho_maker_remarks" => $request->ho_maker_remarks,
          "user_role_id" => $request->user_role,
          "division_id" => $request->division_id,
          "division_name" => $request->division_name,
          "canceled_by" => $request->canceled_by,
          "cancel_reason" => $request->cancel_reason,
          "ho_chkr_aprove_sts_update_date"=>$request->ho_chkr_aprove_sts_update_date,

          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }


      foreach($requests as $request){
        if ($request->system_id=='') {
            
            array_push($request_array[$request->req_id]["request_type"], urldecode($request->value));
        }else{

          array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));
        }
          
      }
      
      foreach($requests as $request){
        $request_array[$request->req_id]["final_operation_name"] = implode(", ", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(", ", $request_array[$request->req_id]["request_type"]);
      }


      $result_null=0;

    }else{
     $request_array=array();
     $result_null=1;
    }
      
     

      // return $request_array;


     

       return view('report.request_report',[

            'requests'=>$request_array,
            'result_null'=>$result_null
        ]);



      
    }

    public function user_audit_log_report(Request $request){

        $req_id = $request->req_id;

      $user_audit_log_data =  DB::select(DB::raw("SELECT ual.[id]
      ,ual.[request_id]
      ,ual.[operation_user]
      ,ual.[operation]
      ,ual.[operation_date_time]
      ,ual.[ip_address]
      ,fs.[title]
      ,usr.[name]

  FROM [dbfive].[dbo].[user_audit_log] ual left join [flag_status] fs on ual.operation = fs.audit_flag left join users usr on
  ual.operation= usr.id where ual.[request_id]='$req_id' order by ual.[id] desc "));

       return view('report.user_audit_log_report_data_table', compact('user_audit_log_data'));


    }




    public function single_user_report(){

       return view('report.single_user_report');
    }


    public function single_user_report_get_data(Request $request){

        $domain_id = $request->domain_id;

        $get_user_data = DB::table('users')->where('user_id',$domain_id)->first();
        
        return view('report.single_user_report_data_table', compact('get_user_data'));

    }


    public function audit_sheet_report(){

        return view('report.audit_sheet_report');

    }


     public function audit_sheet_report_data(Request $request){
        $get_frm_date = $request->frm_date;
        $get_to_date = $request->to_date;

         $frm_date = date('Y-m-d',strtotime($get_frm_date));
          $to_date = date('Y-m-d',strtotime($get_to_date));

          $condition="";
          
          if ($get_frm_date && $get_to_date) {
              
              $condition=" and ai.entry_date between '$frm_date' and '$to_date'  ";

          }elseif ($get_frm_date) {
              
               $to_date = date('Y-m-d');
              $condition=" and ai.entry_date between '$frm_date' and '$to_date'  ";

          }else{
            $condition="";
          }

        $get_audit_data = DB::select(DB::raw("SELECT ai.branch_name,ai.branch_code, ai.division_name,ai.entry_date,ai.maker,ai.checker, maker_usr.name as maker_name, checker_usr.name as checker_name  FROM audit_id ai left join users maker_usr on ai.maker=maker_usr.id left join users checker_usr on ai.checker = checker_usr.id where (ai.[status]='1')  $condition "));

         return view('report.audit_sheet_report_data', compact('get_audit_data'));

    }



// ==============================================================






    // after when need report



    public function date_wise_report(Request $request){

      return view('report.date_wise_report');

    }



    public function date_wise_report_data_table(Request $request){

      // echo "string";die;

       $start_date = $request->start_date;
      

       $end_date = $request->end_date;


      $branch_data = DB::select(DB::raw("SELECT *
  FROM [dbo].[br_user_subs]

  where  created_at between '$start_date 00:00:000' and '$end_date 23:59:000' ORDER BY id DESC"  ));



    

   // echo "<pre>";
   // print_r($ho_data);die;
      
      return view('report.date_wise_report_data_table', compact('branch_data'));


    }


    public function user_wise_report(){

      // return view('report.date_wise_report');

      return view('report.user_wise_report');
    }





    public function system_wise_report(){


       return view('report.system_wise_report');

    }


    public function system_wise_report_data_table(Request $request ){

          $system =  $request->system;


            $system_data = DB::select(DB::raw("SELECT *
  FROM [dbo].[br_user_subs]

  where   Manager ='$system' OR genralbank_ubs='$system' OR credit_ubs='$system' "  ));


    return view('report.system_wise_report_data_table', compact('system_data'));



    }


    public function status_wise_report(Request $request){

       return view('report.status_wise_report');

    }

    public function status_wise_report_data_table(Request $request){

          $status =  $request->status;

           $system_data = DB::select(DB::raw("SELECT *
  FROM [dbo].[br_user_subs]

  where   change_status='$status' "  ));

       return view('report.status_wise_report_data_table', compact('system_data'));

    }


   



}
