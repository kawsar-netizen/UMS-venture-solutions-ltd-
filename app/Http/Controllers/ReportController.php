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

   




    public function user_report_data(Request $request){
    
    $conditionSql = "";
        
       $branch_code = $request->select_branch;
       $sub_branch = $request->sub_branch;
     
       $systems = $request->module;
       $division = str_replace('url_and', '&', $request->division);
       $status = $request->status;
       $user_id = $request->user_id;
       $request_type = $request->request_type;


       $get_frm_date = $request->frm_date;
       $get_to_date = $request->to_date;
     
     // branch sql 
     if(!empty($branch_code)){

       $branchSql = " and  r_id.branch_code='$branch_code'  ";

     }else{

       if(Auth::user()->role == '1' or Auth::user()->role == '5' or ((Auth::user()->role == '9' or Auth::user()->role == '10') && !empty(Auth::user()->division_name) && Auth::user()->division_name !='Internal Control Compliance Division') ){



               $current_branch_code = Auth::user()->branch;
               $branchSql = " and  r_id.branch_code='$current_branch_code'  ";

         
        
       }elseif(Auth::user()->role == '1' or Auth::user()->role == '5' or ((Auth::user()->role == '9' or Auth::user()->role == '10') && !empty(Auth::user()->division_name) && Auth::user()->division_name =='Internal Control Compliance Division')){

          $branchSql = "";

       }else{
        $branchSql = ""; 
       }
       
     }
     
     // module sql 
     if(!empty($systems)){ // if module selected
       $moduleSql = " and  rt.[system_id]='$systems'  ";
     }else{ // module not select
       $moduleSql = "";
     }


     // enhancement sql 
     if(!empty($request_type)){ // if module selected
       $requestTypeSql = " and   r_id.request_type_id='$request_type' ";

     }else{ // module not select
       $requestTypeSql = "";
     }
     
     // division sql
     if(!empty($division)){ // division select
       $divisionSql = " and  dl.log_division='$division' ";
     }else{
       if(Auth::user()->role == '9' or Auth::user()->role == '10'){

        if (!empty(Auth::user()->division_name) && Auth::user()->division_name !='Internal Control Compliance Division') {  //check audit division
              
               $current_division = Auth::user()->division_name;
              $divisionSql = " and   dl.log_division='$current_division'  ";

          }else{
            $divisionSql = ""; 
          }

         
       }else{
         $divisionSql = "";
       }
       
     }
     
     // user id sql 
     if(!empty($user_id)){ // user id found
      $userIDSql = " and u.user_id='$user_id'  ";
     }else{
       $userIDSql = "";
     }
     
     // status sql
     if(!empty($status)){
       
       if($status == '4'){  //cancel

         $statusSql = " and  r_id.status='7' and r_id.action_status='7' ";

       }elseif($status == '6'){ //Decline

        $statusSql = " and r_id.status='6' ";

     }elseif($status == '3'){ //on hold

          $statusSql = " and r_id.status='3' and r_id.action_status_ho_checker='5' ";

       }elseif($status == '2'){ //completed

          $statusSql = " and r_id.status='2' and r_id.action_status_ho_checker='5' ";

       }elseif($status == '1'){ //processing

          $statusSql = " and  r_id.status<>'7'  and r_id.status='0'   and (r_id.action_status_ho_maker<>'' and r_id.action_status_ho_maker<>8) and ( r_id.action_status_ho_maker='3' or r_id.action_status_ho_maker<>'4')  and (r_id.action_status_ho_checker IS NULL or r_id.action_status_ho_checker='') ";

       }elseif($status == '5'){ //Waiting For Authorization

          $statusSql = " and  r_id.status<>'7'  and (r_id.status='0' or r_id.status='2' or r_id.status='3' or r_id.status='4' )  and  (r_id.action_status_br_checker IS NOT NULL and r_id.action_status_ho_maker='4' ) and (r_id.action_status_ho_checker IS NULL or r_id.action_status_ho_checker='') ";

       }elseif($status == '10'){ //initiate
        
          $statusSql = " and r_id.status<>'7' and r_id.status='0'  and ((r_id.action_status_br_checker='1' or r_id.action_status_br_checker IS  NULL or r_id.action_status_br_checker='') and (r_id.action_status_ho_maker IS NULL or r_id.action_status_ho_maker<>'3' ) ) ";
       }      
       
     }else{
       $statusSql = "";
     }



    // starting Date Finding Sql Section Start
    if(!empty($get_frm_date)){ // select starting date 
      $starting_date = date('Y-m-d H:i:s.v', strtotime($get_frm_date));
      $startingDateSql = " and  r_id.entry_date >= '$starting_date' ";
    }else{ // empty starting date
      $startingDateSql = "";
    }
    // starting Date Finding Sql Section End
    
    
    // Ending Date Finding Sql Section Start
    if(!empty($get_to_date)){ // select ending date 
      $ending_date = date('Y-m-d 23:59:00.000', strtotime($get_to_date));
      $endingDateSql = " and r_id.entry_date <= '$ending_date' ";
    }else{ // empty starting date
      $endingDateSql = "";
    }
    // Ending Date Finding Sql Section End
    
    // operation division enhancement role
    if(Auth::user()->role == 8){
      $rtgsEnhancementSql = " and  rt.[system_id]='6' and r_id.[request_type_id]= '33' ";
    }else{
      $rtgsEnhancementSql = '';
    }
    
    
    $conditionSql = $branchSql . $moduleSql . $requestTypeSql . $divisionSql .$userIDSql .  $statusSql .  $startingDateSql . $endingDateSql . $rtgsEnhancementSql;
  
    
    $sql  = "SELECT
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
   dl.[log_req_maker_role_id] as user_role,
   u.[division_id],
   dl.[log_division] as division_name,
   dl.[log_user_designation] as designation,
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
      designation_log dl 
      on r_id.req_id = dl.log_reguest_id 
   left join
      [request_type] rt 
      on r_id.request_type_id = rt.id 
where
   r_id.sl != ''
    $conditionSql  order by r_id.sl desc";
  
  

          $requests = DB::select(DB::raw($sql));
  
$request_array = [];

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
          "remarks"=>[],
          "parameterList"=>$requestsPara
        ];

      }
      
     foreach($requests as $request){
        if ($request->system_id=='') {
            
            array_push($request_array[$request->req_id]["request_type"], urldecode($request->value));

        }else{

          array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));
        }

        if ($request->para_name=='Remarks') {
          array_push($request_array[$request->req_id]["remarks"], urldecode($request->value));
        }
          
      }
      
      foreach($requests as $request){
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);

        $request_array[$request->req_id]["final_remarks"] = implode(",", $request_array[$request->req_id]["remarks"]);

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
          
          if (Auth::user()->division_name=='Internal Control Compliance Division') {
           
           $condition=NULL;

        }else{

          $condition="  and r_id.br_maker='$my_user_auth_id'";
        }
           
        


     }elseif(Auth::user()->role=='5' || Auth::user()->role=='10'){  // branch Checker or division checker
        if (Auth::user()->division_name=='Internal Control Compliance Division') {
           
           $condition=NULL;

        }else{

         $condition="  and r_id.br_checker_assign_manual_id='$my_user_auth_id'";
        }

     }elseif(Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='11' || Auth::user()->role=='12' || Auth::user()->division_name=='Internal Control Compliance Division'){



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
    r_id.[pk_for_sub_br],

        sys.[para_type],
       u.[name] as branch_maker_name, 
       u.[role] as user_role,
       u.[division_id],
      
       dl.[log_division] as division_name,
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

        left join 
        designation_log dl 
        on r_id.req_id=dl.log_reguest_id

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
          "pk_for_sub_br"=>$request->pk_for_sub_br,

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
      ,usr.[user_id]

  FROM [dbfive].[dbo].[user_audit_log] ual left join [flag_status] fs on ual.operation = fs.audit_flag left join users usr on
  ual.operation_user= usr.id where ual.[request_id]='$req_id' "));

       return view('report.user_audit_log_report_data_table', compact('user_audit_log_data'));


    }




    public function single_user_report(){

       return view('report.single_user_report');
    }


    public function single_user_report_get_data(Request $request){

        $domain_id = $request->domain_id;
        $branch = $request->branch;

        if ($domain_id && $branch) {

         $get_user_data = DB::table('users')->where('user_id',$domain_id)->where('branch',$branch)->get();

        }elseif ($domain_id) {

          $get_user_data = DB::table('users')->where('user_id',$domain_id)->get();

        }elseif ($branch) {

          $get_user_data = DB::table('users')->where('branch',$branch)->get();
        }

        
        
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


   

  public function ubs_unlock_request_report(){
    $branch_data = DB::table('branch_info')->get();
    $division_data = DB::select("SELECT division_name from users where branch='202' and division_name<>'' group by division_name;");
    return view('report.ubs_unlock_report.ubs_unlock_request_report_data_table',compact('branch_data','division_data'));
  }

  public function ubs_unlock_report_data(Request $request){
    $from_date = date('Y-m-d',strtotime($request->from_date));
    $to_date = date('Y-m-d',strtotime($request->to_date));
    $branch = $request->branch;
    $division = $request->division;
    $status = $request->status;
    $user = $request->user;

    $date="";
    $branch1 = "";
    $division1 = "";
    $status1 = "";
    $user1 = "";

    if($from_date=="" || $to_date=="")
    {
      
      echo "<font size='5pt' color='red'>Please select the date fields both...</font>";
      exit();
    }
    else
    {
      $date=$date."(CONVERT(Date,entry_date,120) between '$from_date' and '$to_date')";
    }

    if($branch != ""){
      $branch1 = $branch1." and br_code='$branch'";
    }

    if($division != ""){
      $division1 = $division1." and division_id='$division'";
    }
    if($status != ""){
      $status1 = $status1." and status='$status'";
    }
    if($user != ""){
      $user1 = $user1." and req_name='$user'";
    }

    $data =DB::select("SELECT * from ubs_unlock_request where ".$date.$branch1.$division1.$status1.$user1);
  
     return view('report.ubs_unlock_report.ubs_unlock_request_generate_data',compact('data'));
  }






}
