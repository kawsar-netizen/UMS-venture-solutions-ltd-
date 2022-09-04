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


    
       public function ajaxTry(Request $request)
        
        {

          $sts1='';

         //return json_encode($request->all());

           $input_system_id      = $request->input('sysList');
           $input_request_list   = $request->input('requestList');
           $input_parameter_list = $request->input('parameterList');

           $new_request_list   = $this->setRequestList($input_system_id, $input_request_list);
           $new_parameter_list = $this->setParameterList($input_system_id, $input_parameter_list);

          // return json_encode($request->all());

          if($this->rtgsEnhanceMentDateTimeValidation($request->input('form_serialize_data')) === false){
            $response_request_type = [
                "type"       => "warning",
                "status"     => 400,
                "success"    => false,
                "buttonText" => "Okay",
                "message"    => "Please select rtgs  enchancement expired date and time"
            ];
            return response()->json($response_request_type);
          } 



           // check rtgs validaiton
           if($this->checkRTGSValidation($input_system_id, $input_request_list, $input_parameter_list) == false){
                $response_request_type = [
                    "type"       => "warning",
                    "status"     => 400,
                    "success"    => false,
                    "buttonText" => "Okay",
                    "message"    => "Please select at-least 1 enchancement checker limit"
                ];
                return response()->json($response_request_type);
           }

           //return $request->all();


            // parameter
              $sysList = $request->sysList;
              // print_r($sysList);
              $system_array = explode(',', $sysList);
              //print_r($system_array);
              //echo 'sdf';
              $parameterList = $new_parameter_list;


              $parameter_array = explode(',', $parameterList);
              $sysParaList=array();
              
			  

                foreach($parameter_array as $key=>$val){
					
					echo $val;

                      $paraInfo=explode("-",$val);
                      
                      
                      if(!empty($paraInfo[0]) )
                        $para_sys= $paraInfo[0];
                      else
                        $para_sys= NULL; 
                     if(!empty($paraInfo[1]) )
                        $para_id= $paraInfo[1];
                      else
                        $para_id= NULL; 
                      if(!empty($sysParaList[$para_sys]))
                        array_push($sysParaList[$para_sys], $para_id);
                    else
                    {
                        $sysParaList[$para_sys]=array();
                        array_push($sysParaList[$para_sys], $para_id);
                    }

                }
				
				//echo json_encode($sysParaList);
        
        //return json_encode($parameter_array);


            
             //end testing parameter


            $request_type= ['newidcreate'=>"1019",'amendment'=>"1022", 'transfer'=>"1020", 'enable'=>"1023", 'disable'=>"1021", 'new_u_id'=>"1024"];

              if ($request->ajax()) {

                DB::beginTransaction();

            try {
             
                //echo "hello";die;
              //request id insert part

                $request_string =  $request->form_serialize_data;

            $sysList = $request->sysList;
            $sysList_array = explode(',', $sysList);
            $sysList_count = count($sysList_array);

            $request_type = $new_request_list;
            $request_type_array  = explode(',', $request_type);
            // echo "<pre>";
             print_r ($request_type_array);


           

            if ($request_type_array[0] !='' ){
              echo "ache rer";
            }else{
               $response_request_type = [
                        "type"=>"warning",
                        "status" => 400,
                        "success_requesttype" => false,
                        "buttonText"=> "Okay",
                        "message" => "Please select at-least  Request Type before submit"
                    ];
                    return response()->json($response_request_type);
            }
			
             $request_type_count = count($request_type_array);

             if($sysList_count == $request_type_count)
             {
                echo "";

             }else{
                echo "not ok";
             }




              foreach($request_type_array as $key=>$val)  // start parameter foreach
             {
                $req=explode("-",$val);
        
        

                $req_sys=$req[0];
                $req_id=$req[1];
                
                $req_check_count = DB::select(DB::raw("SELECT  [id]
                                  ,[system_id]
                                  ,[request_type_name]
                                  ,[status]
                                  ,[create_date]
                              FROM [request_type] where system_id='$req_sys' and id='$req_id' and status='0'"));

				
                
                
        if(count($req_check_count) > 0){
          $req_check = DB::select(DB::raw("SELECT  [id]
                                  ,[system_id]
                                  ,[request_type_name]
                                  ,[status]
                                  ,[create_date]
                              FROM [request_type] where system_id='$req_sys' and id='$req_id' and status='0'"))[0];
          
          if($req_check->id!=NULL and !empty($req_check->id)){
             if(empty($sysParaList[$req_sys])){
              print "Para Missing";

              $response = [
              "type"=>"warning",
              "status" => 400,
              "success_parameter" => false,
              "buttonText"=> "Okay",
              "message" => "Please select Parameter before submit"
            ];
            return response()->json($response);

             }    

          }         
        }                
             } 

              //end foreach parameter


                     
              $input=explode("&",$request_string);
        
       // return json_encode($input);
             
              
              $sysArray=array();
              $requestTypeValueArra=array();
               foreach ($input as $input_key => $input_value) 
                {
                     if($input_key>0)
                     {
                       $val=explode("=", $input_value);
             
            // file_put_contents('h.txt', json_encode($val)."\n", FILE_APPEND);

                  
                        
                       //request type id check
                       if($val[0]=='assign_person')
                       $assign_person_val = $val[1];
                       
                       $x=explode("radio",$val[0]);
            // file_put_contents('h.txt', json_encode($x)."\n================\n", FILE_APPEND);
                       
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
                         
                          

                           if (is_numeric($para_val)) {

                             
                            $sys_parameter_info = DB::table('systems')->where('id',"$para_val")->first();

                        }


                      

                        if(!empty($sys_parameter_info))
                        { 
                            $system_id = $sys_parameter_info->id;

                           
                            
                          array_push($sysArray, $system_id);
                        }
                        else
                        {
                          
                        }
                      
                        

                      
                        

                    
                     }  // end parameter check
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


              if ($sysList) {

                  echo "string test";

               }else{

                    $response = [
                        "type"=>"warning",
                        "status" => 400,
                        "success_system" => false,
                        "buttonText"=> "Okay",
                        "message" => "Please select at-least 1 system before submit"
                    ];
                    return response()->json($response);

               }



             


                 $sysList = $request->sysList;
            $sysList_array = explode(',', $sysList);
            $sysList_count = count($sysList_array);

            $request_type = $new_request_list;
            $request_type_array  = explode(',', $request_type);

             $request_type_count = count($request_type_array);

             if($sysList_count == $request_type_count)
             {
                echo "";

             }else{
                echo "not ok";

                 $response_request_type = [
                        "type"=>"warning",
                        "status" => 400,
                        "success_requesttype" => false,
                        "buttonText"=> "Okay",
                        "message" => "Please select   Request Type before submit"
                    ];
                    return response()->json($response_request_type);

              
             }


            //return json_encode($sysArray);

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
                 

              

                try {
                    $sts1 = DB::table('request_id')->insert([
                    "req_id"                      => "$request_id",
                    "status"                      => "$status",
                    "branch_code"                 => "$branch",
                    "br_maker"                    => "$user_id",
                    "entry_date"                  => "$date",
                    "request_type_id"             => "$sys_request_id",
                    "request_type_value"          => "$sys_request_id_val",
                    "br_checker_assign_manual_id" => $assign_person_val,
                    "br_authorizer"               => $assign_person_val,
                    "ho_div_role_status"          => $user_role,
                    "ho_div_id"                   => $division_id,
                    "ho_div_maker_id"             => $user_id
                  ]);
        
       
                } catch(Exception $e) {
                   // file_put_contents('hhhhh.txt', $e->getMessage()."\n");
                }


                 
                    

                    // echo "<pre>";
                    // print_r($input);die;

                  
                   
                    foreach ($input as $input2_key => $input2_value) 
                    {
                         $val=explode("=", $input2_value);
             
            
                          $ok=0;
                         
              
                         //if(!empty($val[1])  /*and (is_numeric($val[0]) or $val[0]=='rtgs_radio' or $val[0]=='rtgs2_radio')*/)//parameter check
                         if(!empty($val[1]) and (is_numeric($val[0]) or $val[0] == 'rtgs_tmp_exp_date' or $val[0] == 'rtgs_tmp_exp_time' or $val[0]=='rtgs_radio' or $val[0]=='rtgs2_radio') )//parameter check
                         {
                          $para_id  = $val[0];
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

                          if($para_id=='rtgs_tmp_exp_date' and !empty($para_val)){ 
                              if($this->checkDateTimeSelectOrNot($request->input('form_serialize_data')) === false){
                                continue;
                              }
                              $para_id= 1814;
                          }
              
                          if($para_id=='rtgs_tmp_exp_time' and !empty($para_val)){      
                            if($this->checkDateTimeSelectOrNot( $request->input('form_serialize_data') ) === false){
                              continue;
                            }                     
                            $para_id= 1815;
                          }
                         
                           

                        
                          // print "$para_id==$para_val<br>";  

                       //  $sys_parameter_info = DB::table('sys_parameters')->where('para_id', $para_id)->first();
                       // $system_id = $sys_parameter_info->system_id;

                        $check_para =  DB::select(DB::raw("SELECT * FROM sys_parameters where para_id='$para_id' and system_id='$system_id' "));
               
                      
                        

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

             

              $request_id = "Request Id : $request_id";
             
               $request_sent_date=date('Y-m-d');
               $branch_code=Auth::user()->branch;
               if ($branch_code) {

                $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                $branch_name = $br_info_data->name." ($branch_code) ";

               }

               $emp_id=Auth::user()->emp_id;
              
              $requested_by=Auth::user()->name."( $emp_id )";
              $user_id=Auth::user()->user_id;
              $requested_role=Auth::user()->role;

              if ($requested_role) {
                
                $role_data = DB::table('role_table')->where('id', $requested_role)->first();
                $role_name= $role_data->role_name;
              }
              $system_id="$system_id";

              if ( $system_id) {
                
                 $get_system_data = DB::table('systems')->where('id',$system_id)->first();
                  $module_name = $get_system_data->system_name;

              }
            


            $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$user_id,$role_name,$module_name);
           
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
      
      
      
      
      
      // return $request_array;
      
      
      
      
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
      
      
      
      
      
      // return $request_array;
      
      
      
      
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



                 

                   $request_id = "Request Id : $request_id";
                  

                  

                    $this->common_func($request_id, Auth::user()->id, 2,$date, $request->ip() );//for audit log

                    $mail_to = $br_auth_email;
             // $mail_to = "rabiul.fci@gmail.com";

             $subject = "Assign For Request : $request_id";

             

              $request_id = "Request Id : $request_id";
             
               $request_sent_date=date('Y-m-d');
               $branch_name=Auth::user()->branch;
              $requested_by=Auth::user()->name;
              $user_id=Auth::user()->user_id;
              $requested_role=Auth::user()->role;
              $module_name="mm";

                    // $this->mail_send();

              $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$user_id,$requested_role,$module_name);

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



    public function setRequestList($system_id, $request_list){
      if(strpos($system_id, ",")){
        $system_id = explode(",", $system_id);
      }else{
        $system_id = explode(" ", $system_id);
      }
      $new_request_array = [];
      if(strpos($request_list, ",")){
          $request_array     = explode(",", $request_list);
          for($i=0; $i < count($request_array); $i++){
              $dash_array        = explode("-", $request_array[$i]);
              $request_system_id = $dash_array[0];
              $request_id        = $dash_array[1];
              if(in_array($request_system_id, $system_id)){
                  array_push($new_request_array, $request_array[$i]);
              }
          }
      }else{        
          $dash_array        = explode("-", $request_list);
          $request_system_id = $dash_array[0];
          $request_id        = $dash_array[1];
          if(in_array($request_system_id, $system_id)){
              array_push($new_request_array, $request_list);
          }
      }
    
    $new_request_list = implode(",", $new_request_array);
     
     return $new_request_list;
  }



  function setParameterList($system_id, $prameter_list){
    if(strpos($system_id, ",")){
        $system_id = explode(",", $system_id);
      }else{
        $system_id = explode(" ", $system_id);
      }
    $new_parameter_list = [];
    if(strpos($prameter_list, ",")){
        $parameter_array     = explode(",", $prameter_list);
        for($i=0; $i < count($parameter_array); $i++){
            $dash_array        = explode("-", $parameter_array[$i]);
            $request_system_id = $dash_array[0];
            if(in_array($request_system_id, $system_id)){
                array_push($new_parameter_list, $parameter_array[$i]);
            }
        }
    }else{        
        $dash_array        = explode("-", $prameter_list);
        $request_system_id = $dash_array[0];
        if(in_array($request_system_id, $system_id)){
            array_push($new_parameter_list, $prameter_list);
        }
    }
    
   $new_parameter_list = implode(",", $new_parameter_list);
   return  $new_parameter_list;
}



public function checkRTGSValidation($system_id, $request_list, $prameter_list) {
    if(strpos($system_id, ",")){
        $system_id = explode(",", $system_id);
    }else{
        $system_id = explode(" ", $system_id);
    }

    if(in_array(6, $system_id)){ // if select rtgs

        // check request type in inhancement
        $new_request_array = [];
          if(strpos($request_list, ",")){
              $request_array     = explode(",", $request_list);
              for($i=0; $i < count($request_array); $i++){
                  $dash_array        = explode("-", $request_array[$i]);
                  $request_system_id = $dash_array[0];
                  $request_id        = $dash_array[1];
                  if(in_array($request_system_id, $system_id)){
                      array_push($new_request_array, $request_array[$i]);
                  }
              }
          }else{        
              $dash_array        = explode("-", $request_list);
              $request_system_id = $dash_array[0];
              $request_id        = $dash_array[1];
              if(in_array($request_system_id, $system_id)){
                  array_push($new_request_array, $request_list);
              }
          }

        if(in_array('6-33', $new_request_array)){ // select inhancement
            
            $new_parameter_list = [];
            if(strpos($prameter_list, ",")){
                $parameter_array     = explode(",", $prameter_list);
                for($i=0; $i < count($parameter_array); $i++){
                    $dash_array        = explode("-", $parameter_array[$i]);
                    $request_system_id = $dash_array[0];
                    if(in_array($request_system_id, $system_id)){
                        array_push($new_parameter_list, $parameter_array[$i]);
                    }
                }
            }else{        
                $dash_array        = explode("-", $prameter_list);
                $request_system_id = $dash_array[0];
                if(in_array($request_system_id, $system_id)){
                    array_push($new_parameter_list, $prameter_list);
                }
            }

            return $this->checkRtgsParameterSelectOrNot($new_parameter_list);

        }else{ // enhancement not select
            return true;
        }

    }else{
        return true;
    }



}



public function checkRtgsParameterSelectOrNot($new_parameter_list){
    for($i=0; $i< count($new_parameter_list); $i++){
        if(in_array("6-135-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-136-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-137-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-138-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-139-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-140-chk", $new_parameter_list)){
            return true;
        }
        if(in_array("6-141-chk", $new_parameter_list)){
            return true;
        }

        if(in_array("6-142-chk", $new_parameter_list)) {
            return true;
        }

    }

    return false;
}


public function checkDateTimeSelectOrNot($form_serialize_data){
  $data_array = explode("&", $form_serialize_data);
  if(in_array("rtgs2_radio=143", $data_array)){
      return true;
  }
  return false;
}


public function rtgsEnhanceMentDateTimeValidation($form_serialize_data){
  $data_array = explode("&", $form_serialize_data);
  if(in_array("rtgs2_radio=143", $data_array)){
      for($i=0; $i < count($data_array); $i++){
          $single_value_array = explode("=",$data_array[$i]);
          if( ($single_value_array[0] == "rtgs_tmp_exp_date") && ($single_value_array[1] == '') ){
              return false;
          }
      
          if( ($single_value_array[0] == "rtgs_tmp_exp_time") && ($single_value_array[1] == '') ){
              return false;
          }
      }  
  }
  return true;
}
   

  

}
