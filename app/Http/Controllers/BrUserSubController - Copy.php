<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BrUserSub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
date_default_timezone_set('Asia/Dhaka');


class BrUserSubController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function saveData(Request $request)
    {
       $rr = New BrUserSub();

       $rr->user_id = Auth::user()->id;
       $rr->user_name = Auth::user()->name;
       $rr->user_roll = Auth::user()->role;
       $rr->user_branch = Auth::user()->branch;


       $rr->input_user_id = $request->input_user_id;
       
       $rr->emp_id = $request->emp_id;
       $rr->branch = $request->branch;
       $rr->user_email = $request->user_email;
       $rr->domain_id = $request->domain_id;
       $rr->emp_name = $request->emp_name;
       $rr->designation = $request->designation;
       $rr->emp_mobile = $request->emp_mobile;
       

       
       
       $rr->ubs = $request->ubs;
       $rr->pbm = $request->pbm;
       $rr->cps = $request->cps;
       $rr->beftn = $request->beftn;
       $rr->rtgs = $request->rtgs;
       $rr->docudex = $request->docudex;
       $rr->newdbcube = $request->newdbcube;
       $rr->rbs = $request->rbs;
       $rr->gefu = $request->gefu;
       $rr->directbank = $request->directbank;
       $rr->bkash = $request->bkash;
       $rr->portal = $request->portal;
       $rr->rit = $request->rit;
       $rr->forex = $request->forex;
       $rr->csms = $request->csms;
       $rr->passport = $request->passport;
       $rr->nscreen = $request->nscreen;
       $rr->swift = $request->swift;



       $rr->newidcreate = $request->newidcreate;
       $rr->amendment = $request->amendment;
       $rr->transfer = $request->transfer;
       $rr->enable = $request->enable;
       $rr->disable = $request->disable;
       $rr->passreset = $request->passreset;

        $rr->new_u_id = $request->new_u_id;

      //for ubs checkbox

       $rr->manager = $request->manager;
       $rr->manops = $request->manops;
       $rr->genralbank_ubs = $request->genralbank_ubs;
       $rr->credit_ubs = $request->credit_ubs;
       $rr->foreigntrade = $request->foreigntrade;
       $rr->tellerorcash = $request->tellerorcash;
       $rr->view_ubs = $request->view_ubs;

  
      // for ubs input
      
       $rr->depart_ubs = $request->depart_ubs;
       $rr->exist_user_id_ubs = $request->exist_user_id_ubs;
       $rr->special_role_ubs = $request->special_role_ubs;

       //for rtgs

       $rr->depart_rtgs = $request->depart_rtgs;
       $rr->roles_rtgs = $request->roles_rtgs;

       //for cps

       $rr->depart_cps = $request->depart_cps;
       $rr->exist_user_id_cps = $request->exist_user_id_cps;
       $rr->roles_cps = $request->roles_cps;
       $rr->special_role_cps = $request->special_role_cps;

      
       //for beftn

       $rr->depart_beftn = $request->depart_beftn;
       $rr->exist_user_id_beftn = $request->exist_user_id_beftn;
       $rr->roles_beftn = $request->roles_beftn;
       $rr->special_role_beftn = $request->special_role_beftn;


       //for bkash

       $rr->depart_bkash = $request->depart_bkash;
       $rr->exist_user_id_bkash = $request->exist_user_id_bkash;
       $rr->roles_bkash = $request->roles_bkash;

       //for direct banking

       $rr->depart_directbank = $request->depart_directbank;
       $rr->exist_user_id_directbank = $request->exist_user_id_directbank;
       $rr->roles_directbank = $request->roles_directbank;


//extra

       // $rr->department = $request->department;
       // $rr->roles = $request->roles;
       // $rr->exist_user_id = $request->exist_user_id;
       // $rr->special_role = $request->special_role;

       // dd($rr);
      
      $rr->save();

      return redirect('/branch_maker')->with('message','Request Submitted successfully');
    }







   

       public function ajaxTry(Request $request)
        
        {

            // file_put_contents("hh.txt", json_encode($request->all()));

            $request_type= ['newidcreate'=>"1019",'amendment'=>"1022", 'transfer'=>"1020", 'enable'=>"1023", 'disable'=>"1021", 'new_u_id'=>"1024"];

              if ($request->ajax()) {

                DB::beginTransaction();

            try {
             
                //echo "hello";die;
              //request id insert part
               $request_string =  $request->form_serialize_data;
                
                
              $input=explode("&",$request_string);
             
              
              $sysArray=array();
              $requestTypeValueArra=array();
               foreach ($input as $input_key => $input_value) 
                {
                     if($input_key>0)
                     {
                       $val=explode("=", $input_value);

                  
                        
                       //request type id check
                       if($val[0]=='assign_person')
                       $assign_person_val = $val[1];
                       
                       $x=explode("radio",$val[0]);
                       
                       if(!empty($x[1]))
                       {
                         $request_type_name=$val[1];
                       $request_type_name_final =  urldecode($request_type_name);

                         $check_system_id=$x[1];

                        $data_request_type_and_name = DB::select(DB::raw("SELECT  [id]
                                  ,[system_id]
                                  ,[request_type_name]
                                  ,[status]
                                  ,[create_date]
                              FROM [request_type] where system_id='$check_system_id' and request_type_name='$request_type_name_final'"))[0];

                       $request_type_id = $data_request_type_and_name->id;
                       $sysId = $data_request_type_and_name->system_id;

                       $requestTypeValueArra[$sysId]= array('request_type_id'=> $request_type_id,'request_type_val'=>NULL);

                     

                         
                       }
                      
                       $x1=explode("new_u_",$val[0]);
                       if(!empty($x1[1]))
                       {
                        $paraId=$x1[1];
                        $data_request_type_and_name_1 = DB::select(DB::raw("SELECT  [id]
                                  ,[system_id]
                                  ,[request_type_name]
                                  ,[status]
                                  ,[create_date]
                              FROM [request_type] where id='$paraId' "))[0];
                        $sys_id_1 = $data_request_type_and_name_1->system_id;
                        $request_type_value=$val[1];

                        $requestTypeValueArra[$sys_id_1]['request_type_val']=$request_type_value;

                        

                       }
                       else
                       {
                        $request_type_value=NULL;
                       }
                      
                       if(!empty($val[1]) )//parameter check
                       {
                       
                         $para_id = $val[0];
                        $para_val = $val[1];    
                        $sys_parameter_info = DB::table('systems')->where('system_name', $para_id)->first();
                        if(!empty($sys_parameter_info))
                        {
                           $system_id = $sys_parameter_info->id;
                          array_push($sysArray, $system_id);
                        }
                        else
                        {
                          
                        }
                      
                        

                    
                     }
                  }
              
               }

                  

               $sysArray=array_unique(array_filter($sysArray));
               
               // print "<pre>";
               // print_r($sysArray);
               // die();
               //loop
               $ok=0;
               $notOk=0;
             $data_to_insert = [];
               foreach ($sysArray as $sysArray_key => $sysArray_value)//system loop 
              {
                   $system_id=$sysArray_value;
                 


                 $req_sl_data = DB::table('request_id')->orderBy('sl', 'desc')->first();

                 if($req_sl_data){
                   $request_sl = $req_sl_data->sl + 1;

                 }else{
                   $request_sl = 1;
                 }

                  $sys_request_id=$requestTypeValueArra[$system_id]['request_type_id'];

                  // print_r($sys_request_id);die;

                  $sys_request_id_val=$requestTypeValueArra[$system_id]['request_type_val'];


                  $request_id="REQ-$request_sl";


                 


                  $user_id=Auth::user()->id;
                  $branch=Auth::user()->branch;
                  $status=0;
                  $date=date("Y-m-d H:i:s");


                  $user_role = Auth::user()->role;
                  $division_id = Auth::user()->division_id;
                 

                 $sts1 = DB::table('request_id')->insert([
                    "req_id"=>"$request_id",
                    "status"=>"$status",
                    "branch_code"=>"$branch",
                    "br_maker"=>"$user_id",
                    "entry_date"=>"$date",
                    "request_type_id"=>"$sys_request_id",
                    "request_type_value"=>"$sys_request_id_val",
                    "br_checker_assign_manual_id"=>$assign_person_val,
                    "br_authorizer"=>$assign_person_val,
                    "ho_div_role_status"=>$user_role,
                    "ho_div_id"=>$division_id,
                    "ho_div_maker_id"=>$user_id,

                  ]);

                
                  
                    

                    // echo "<pre>";
                    // print_r($input);die;

                  
                     print_r($input);

                    foreach ($input as $input2_key => $input2_value) 
                    {
                         $val=explode("=", $input2_value);

                          $ok=0;
                         

                         if(!empty($val[1])  and (is_numeric($val[0]) or $val[0]=='rtgs_radio' or $val[0]=='rtgs2_radio'))//parameter check
                         {
                         
                          $para_id = $val[0];
                          $para_val = $val[1];  
                          if($para_id=='rtgs_radio' and !empty($para_val))
                          {
                             $para_id= $para_val;
                              $para_val =1;
                          }
                          if($para_id=='rtgs2_radio' and !empty($para_val))
                          {
                             $para_id= $para_val;
                              $para_val =1;
                          }


                           print "$para_id==$para_val<br>";  

                       //  $sys_parameter_info = DB::table('sys_parameters')->where('para_id', $para_id)->first();
                       // $system_id = $sys_parameter_info->system_id;

                        $check_para =  DB::select(DB::raw("SELECT * FROM sys_parameters where para_id='$para_id'
                           and system_id='$system_id' "));
                        

                        // $check_para = DB::table('sys_parameters')->where('para_id', $para_id)->where('system_id', $sys_request_id)->first();

                          if($check_para)
                          {
                            array_push($data_to_insert, [
                                'sys_id' => $system_id,
                                'para_id' => $para_id,
                                'value' => "$para_val",
                                'entry_date' => $date,
                                'request_id' => $request_id,
                                
                            ]);
                          }
                          else
                          {
                            
                          }
                        
                         }

                           
                  
                   }// loop end
                  

            $this->common_func($request_id, Auth::user()->id, 1,$date, $request->ip() );


             // $usr =  $request->assign_person;
             
                //for mailing
               $br_authorizer_info =  DB::table('users')->where('id',$assign_person_val)->first();
               $br_auth_email = $br_authorizer_info->email;

             $mail_to = $br_auth_email;
             // $mail_to = "rabiul.fci@gmail.com";

             $subject = "Assign For Request : $request_id";

              $assigned_by = Auth::user()->name;

              $request_id = "Request Id : $request_id";
              $assigned_by = "Assigned By : $assigned_by";

               // //for Request Type
               // $request_type_info = DB::select(DB::raw("SELECT rt.request_type_name

               //  FROM [request_id] r_id

               //    left join [request_type] rt on r_id.request_type_id = rt.id where r_id.req_id='$request_id' "))[0];

               //    $request_type_name = $request_type_info->request_type_name;

                if ($sys_request_id) {

                   // $request_type = "Request Type : $sys_request_id";

                    $request_type_id = $sys_request_id;
                    $request_type_data = DB::table('request_type')->where('id',$sys_request_id)->first();

                    $request_type = "Request Type : $request_type_data->request_type_name";



                }elseif($sys_request_id_val){

                     $request_type = "Request Type : $sys_request_id_val";
                }
                
                 // $request_type = "Request Type : test";

            $this->mail_send($mail_to, $subject, $request_id, $assigned_by, $request_type);
           
           }//system loop end
           
$sts2 =  DB::table('request')->insert($data_to_insert);
                 // file_put_contents("requestQuery.txt", json_encode($data_to_insert));
                 if($sts1 == true){
                   $ok++;
                   }else{
                     $notOk++;
                   }



                  


             if($ok>0 && $notOk==0){
              DB::commit();
               echo true;
             }else{
               DB::rollback();
              echo false;
             }

               
               
                // print_r($request_id);
              
                // die();
                
               

            } catch (\Exception $e) {
              DB::rollback();

                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }     
        }
    







    public function viewBrUserReqList()
    {
      
      //$requests = BrUserSub::where('user_id','=',Auth::user()->id)->orderBy('id','DESC')->get();

      $role = Auth::user()->role;
      // dd($role);


      if ($role == 1) 
      {

       $request_array = [];

          $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker],
   r_id.[entry_date],
   r.[sys_id],
   r.[para_id],
   r.[value],
   sys.[para_name],
   sys.[para_type],
   s.[system_name],
    sys.[system_id],
     sys.[para_type],
   u.[name] as branch_maker_name 
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
      on r_id.br_maker = u.id"));


      foreach($requests as $request){
        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
           "req_id" => $request->req_id,
          "status" => $request->status,
          "action_status" => $request->action_status,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "operation_name" => [],
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
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      
      
       return $request_array;
      
      
      
      
        // hasan code end

      
       $user_id = Auth::user()->id;
    

         return view('index',[
            'requests'=>$request_array
        ]);


      } // end if role = 1




      //start role 2 or ho maker

      elseif($role == 2)
      {
         $request_array = [];

          $checker_user_id = Auth::user()->id;
          $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker],
   [ho_checker_comment],
   r_id.[entry_date],
   r.[sys_id],
   r.[para_id],
   r.[value],
   sys.[para_name],
   sys.[para_type],
   s.[system_name],
   sys.[system_id],
   u.[name] as branch_maker_name 
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

    where r_id.br_checker<>''

     order by  status , r_id.sl desc 

      "));
      foreach($requests as $request){
        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "status" => $request->status,
          "action_status" => $request->action_status,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "ho_checker_comment" => $request->ho_checker_comment,

          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "operation_name" => [],
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
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      
      
       // return $request_array;
      
      
      
      
        // hasan code end

      
       $user_id = Auth::user()->id;
      // $requests = DB::select(DB::raw("SELECT *, users.name as users_table_name, br_user_subs.id as br_user_subs_id FROM br_user_subs LEFT JOIN users on  br_user_subs.br_authorizer= users.id  WHERE br_user_subs.user_id = '$user_id' order by br_user_subs.id desc"));

         return view('index',[
            'it_maker'=>$request_array
        ]);



      }

       //end role 2 or ho maker



        //start role 6 or ho checker

      elseif($role == 6)
      {
         $request_array = [];

          $checker_user_id = Auth::user()->id;
          $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker],
   [ho_checker_comment],
   r_id.[entry_date],
   r.[sys_id],
   r.[para_id],
   r.[value],
   sys.[para_name],
   sys.[para_type],
   s.[system_name],
   sys.[system_id],
   u.[name] as branch_maker_name 
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

    where r_id.br_checker<>''

      "));
      foreach($requests as $request){
        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "status" => $request->status,
          "action_status" => $request->action_status,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "ho_checker_comment" => $request->ho_checker_comment,

          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "operation_name" => [],
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
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      
      
       // return $request_array;
      
      
      
      
        // hasan code end

      
       $user_id = Auth::user()->id;
      // $requests = DB::select(DB::raw("SELECT *, users.name as users_table_name, br_user_subs.id as br_user_subs_id FROM br_user_subs LEFT JOIN users on  br_user_subs.br_authorizer= users.id  WHERE br_user_subs.user_id = '$user_id' order by br_user_subs.id desc"));

         return view('index',[
            'it_checker'=>$request_array
        ]);



      }

      //end role 6 or ho checker

      elseif($role == 5)
      {
          $request_array = [];

          $checker_user_id = Auth::user()->id;
          $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker],
   r_id.[entry_date],
   r.[sys_id],
   r.[para_id],
   r.[value],
   sys.[para_name],
   sys.[para_type],
   s.[system_name],
   sys.[system_id],
   u.[name] as branch_maker_name 
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

      where r_id.br_authorizer ='$checker_user_id' 

      "));
      foreach($requests as $request){
        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "status" => $request->status,
          "action_status" => $request->action_status,
          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "operation_name" => [],
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
        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      
      
       return $request_array;
      
      
      
      
        // hasan code end

      
       $user_id = Auth::user()->id;
      // $requests = DB::select(DB::raw("SELECT *, users.name as users_table_name, br_user_subs.id as br_user_subs_id FROM br_user_subs LEFT JOIN users on  br_user_subs.br_authorizer= users.id  WHERE br_user_subs.user_id = '$user_id' order by br_user_subs.id desc"));

         return view('index',[
            'br_checker'=>$request_array
        ]);

    } // end elseif role = 5 or branch checker

      else
      {
        return redirect('/');
      }
      
      
    }









   


   public function user_authorize(Request $request){

      if ($request->ajax()) {

            try {

                $row_id =  $request->row_id;
               

                $single_fetch_data = DB::table('br_user_subs')
          
            ->where('br_user_subs.id', $row_id)
            ->first();

           

                $view = view('single_fetch_data', compact('single_fetch_data'))->render();
                return response()->json(['html' => $view]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }


    }


    public function assign_person(Request $request){

      if ($request->ajax()) {

            try {

                  $date=date("Y-m-d H:i:s");

                $update_date = date('Y-m-d');

                $usr =  $request->usr;

                //for mailing
               $br_authorizer_info =  DB::table('users')->where('id',$usr)->first();
               $br_auth_email = $br_authorizer_info->email;

                $hidden_id_assign =  $request->hidden_id_assign;
                $request_id =  $request->hidden_request_id;


                //for Request Type
               $request_type_info = DB::select(DB::raw("SELECT rt.request_type_name

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id where r_id.req_id='$request_id' "))[0];

                  $request_type_name = $request_type_info->request_type_name;



                   $single_fetch_data = DB::table('request_id')->where('sl', $hidden_id_assign)->update([

                    'br_checker_assign_manual_id'=>$usr,
                    'br_authorizer'=>$usr,
                    'update_date'=>$update_date,
                    'action_status_br_checker'=>''
                 
                ]);



                   $assigned_by = Auth::user()->name;
                   

                   $request_id = "Request Id : $request_id";
                   $assigned_by = "Assigned By : $assigned_by";

                  

                   $request_type = "Request Type : $request_type_name";


                    $this->common_func($request_id, Auth::user()->id, 2,$date, $request->ip() );//for audit log

                    $mail_to = $br_auth_email;
                    $subject = "Assign For Request : $request_id";//assign 

                    // $this->mail_send();

                    $this->mail_send($mail_to, $subject, $request_id, $assigned_by, $request_type);

                return back()->with('message','Assigned Successfully ! ');
             

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    }



    public function cancel_reason_submit(Request $request){

      if ($request->ajax()) {
            try {

                 $update_date = date('Y-m-d');
                 
                $id =  $request->id;
                $cancel_reason =  $request->cancel_reason;
                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                    'action_status'=>7,
                    'status'=>7,
                    'br_maker_cancel_sts_date'=>$update_date,
                    'cancel_reason'=>$cancel_reason,

                  ]
                );

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }

    }


    public function branch_maker_edit(Request $request){

        if ($request->ajax()) {
            try {

                $row_id =  $request->row_id;
               

                $single_fetch_data = DB::table('br_user_subs')
          
            ->where('br_user_subs.id', $row_id)
            ->first();

           

                $view = view('single_fetch_edit_data', compact('single_fetch_data'))->render();
                return response()->json(['html' => $view]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    }


  

}
