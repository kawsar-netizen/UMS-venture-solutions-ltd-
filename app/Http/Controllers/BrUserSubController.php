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


           $input_system_id      = $request->input('sysList');
           $input_request_list   = $request->input('requestList');
           $input_parameter_list = $request->input('parameterList');

          file_put_contents('pp.txt',$input_parameter_list);

           $input_system_id_exp = explode(',', $input_system_id);

           $new_request_list   = $this->setRequestList($input_system_id, $input_request_list);
           $new_parameter_list = $this->setParameterList($input_system_id, $input_parameter_list);

          file_put_contents("1.txt", $input_system_id );
          file_put_contents("2.txt", $new_request_list );
          file_put_contents("3.txt", $new_parameter_list );

           $new_parameter_list = $this->rtgsExtraParameterRemove($new_request_list, $new_parameter_list);
            file_put_contents("4.txt", $new_parameter_list);
            file_put_contents("5.txt", $request->input('form_serialize_data'));
          //  return json_encode($request->all());

          // if request type not selected

          $requestSpecificMessageErrorResponse = $this->requestSpecificMessageError($input_system_id, $new_request_list);
          
          if($requestSpecificMessageErrorResponse['success'] === false){
              echo  "0<>".$requestSpecificMessageErrorResponse['message'];
              die();
          }

          
          


          // return json_encode($request->all());

           if (in_array('6', $input_system_id_exp)) {

              if($this->rtgsEnhanceMentDateTimeValidation($request->input('form_serialize_data')) === false){
                

                echo "0<>Please select rtgs  enchancement expired date and time";
                die();

               $notOk++;
              } 

        }

          
           // check rtgs validaiton
           if($this->checkRTGSValidation($input_system_id, $input_request_list, $input_parameter_list) ===false){
                // $response_request_type = [
                //     "type"       => "warning",
                //     "status"     => 400,
                //     "success"    => false,
                //     "buttonText" => "Okay",
                //     "message"    => "Please select at-least 1 enchancement checker limit"
                // ];
                // return response()->json($response_request_type);

                echo "0<>Please select at-least 1 enchancement checker limit";
                die();

           $notOk++;
           }

           //return $request->all();



            // parameter
              $sysList = $request->sysList;
              // print_r($sysList);
              $system_array = explode(',', $sysList);
             // print_r($system_array);
              //echo 'sdf';
              $parameterList = $new_parameter_list;


              $parameter_array = explode(',', $parameterList);
              $sysParaList=array();
              
        

                foreach($parameter_array as $key=>$val){
          
          //echo $val;

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
            // print_r ($request_type_array);


           

            if ($request_type_array[0] !='' ){
             // echo "ache rer";
            }else{
               // $response_request_type = [
               //          "type"=>"warning",
               //          "status" => 400,
               //          "success_requesttype" => false,
               //          "buttonText"=> "Okay",
               //          "message" => "Please select at-least  Request Type before submit"
               //      ];
               //      return response()->json($response_request_type);
                     echo "0<>Please select at-least  Request Type before submit";
                     die();

           $notOk++;

            }
      
             $request_type_count = count($request_type_array);

             if($sysList_count == $request_type_count)
             {
                //echo "";

             }else{
               // echo "not ok";
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

             // print "Para Missing";

            //   $response = [
            //   "type"=>"warning",
            //   "status" => 400,
            //   "success_parameter" => false,
            //   "buttonText"=> "Okay",
            //   "message" => "Please select Parameter before submit"
            // ];
            // return response()->json($response);
              $parameter_error_system_name = $this->getSystemIdName($req_sys);
             echo "0<>Please select $parameter_error_system_name Parameter before submit";
             die();

           $notOk++;

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
             
            

                       
                       
                        
                       //request type id check
                       if($val[0]=='assign_person')
                       $assign_person_val = $val[1];
                       
                       if (empty($assign_person_val)) {
                        echo "0<>Please Assign a Person";
                        die();
                      }
                      
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
                             $bigInt = (int)$para_val;
                             // echo $bigIntVal."\n";
                            $sys_parameter_info = DB::table('systems')->where('id',"$bigInt")->first();
                        }

                      

                        if(!empty($sys_parameter_info))
                        { 
                            $system_id = $sys_parameter_info->id;

                           
                            
                          array_push($sysArray, $system_id);
                        }
                        else
                        {
                          
                        }
                      
                        

                    
                     } // end parameter check



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

                  //echo "string test";

               }else{

                    // $response = [
                    //     "type"=>"warning",
                    //     "status" => 400,
                    //     "success_system" => false,
                    //     "buttonText"=> "Okay",
                    //     "message" => "Please select at-least 1 system before submit"
                    // ];
                    // return response()->json($response);

                echo "0<>Please select at-least 1 system before submit";
                die();

           $notOk++;

               }



             


                 $sysList = $request->sysList;
            $sysList_array = explode(',', $sysList);
            $sysList_count = count($sysList_array);

            $request_type = $new_request_list;
            $request_type_array  = explode(',', $request_type);

             $request_type_count = count($request_type_array);

             if($sysList_count == $request_type_count)
             {
                //echo "$sysList_count == $request_type_count";

             }else{
               // echo "not ok";

                 // $response_request_type = [
                 //        "type"=>"warning",
                 //        "status" => 400,
                 //        "success_requesttype" => false,
                 //        "buttonText"=> "Okay",
                 //        "message" => "Please select   Request Type before submit"
                 //    ];
                 //    return response()->json($response_request_type);
                echo "0<>Please select   Request Type before submit";
                die();

           $notOk++;

              
             }


            
               foreach ($system_array as $sysArray_key => $sysArray_value)//system loop 
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
                 

               $br_pk_id = Auth::user()->br_pk_id;
               $sub_br_code="";

                if ($br_pk_id && ($br_pk_id!=NULL || $br_pk_id!='') && $br_pk_id!='0' ) {

                  $sub_br_code=$br_pk_id;

               }else{

                 $sub_br_code="";

               }

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
                    "pk_for_sub_br"               => $sub_br_code,
                    "ho_div_maker_id"             => $user_id,
                     "req_maker_emp_id"             => Auth::user()->emp_id,
                  ]);
        
                
                 $this->designation_log($request_id, $assign_person_val);
                 
                } catch(Exception $e) {
                   // file_put_contents('hhhhh.txt', $e->getMessage()."\n");
                }


                 


                   

                  
                   $enhancementFound=0;
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
                           $get_request_id = DB::table('request_id')->where('req_id',"$request_id")->first();

                          $request_type_id = $get_request_id->request_type_id;

                          $request_type_get= DB::table('request_type')->where('id',$request_type_id)->first();

                         $request_type_status = $request_type_get->status;

                         $h = [
                                    'sys_id'     => $system_id,
                                    'para_id'    => $para_id,
                                    'value'      => "$para_val",
                                    'entry_date' => $date,
                                    'request_id' => $request_id,
                                ];
                                file_put_contents("hhm.txt", json_encode($h)."\n", FILE_APPEND);


                          if ($request_type_status==0) {   
                            
                           if($system_id == "6"){




                              if($this->checkParameterList($para_id, $new_parameter_list) === true || $para_id == "1815" || $para_id == "1814"){
                                if($para_id == "1815" || $para_id == "1814")  {
                                  //file_put_contents("f.txt", $this->rtgsEnhanceMent($request_id));
                                  if($this->rtgsEnhanceMent($request_id) === true){
                                      array_push($data_to_insert, [
                                        'sys_id'     => $system_id,
                                        'para_id'    => $para_id,
                                        'value'      => "$para_val",
                                        'entry_date' => $date,
                                        'request_id' => $request_id,
                                    ]);
                                  }
                                }else{
                                  array_push($data_to_insert, [
                                    'sys_id'     => $system_id,
                                    'para_id'    => $para_id,
                                    'value'      => "$para_val",
                                    'entry_date' => $date,
                                    'request_id' => $request_id,
                                ]);

                                }                          
                              }

                               if( $request_type_id=='33'){

                                       $enhancementFound=1;

                                  }


                            }else{
                              array_push($data_to_insert, [
                                  'sys_id'     => $system_id,
                                  'para_id'    => $para_id,
                                  'value'      => "$para_val",
                                  'entry_date' => $date,
                                  'request_id' => $request_id,
                              ]);
                            }

                            

                          //    file_put_contents("ha.txt", json_encode( [
                          //     'sys_id' => $system_id,
                          //     'para_id' => $para_id,
                          //     'value' => "$para_val",
                          //     'entry_date' => $date,
                          //     'request_id' => $request_id,                                    
                          // ])."\n", FILE_APPEND);

                          // file_put_contents("na.txt", json_encode($data_to_insert));
                                

                            }else{
                               
                               // echo "parameter test korci";
                                
                            }

                          }
                          else
                          {
                            
                          }
                        
                         }
             
            
                           
                  
                   }// loop end
           
          if($enhancementFound==1)
          {
            $designation = Auth::user()->designation;

                                      array_push($data_to_insert, [
                                          'sys_id'     => $system_id,
                                          'para_id'    => $para_id,
                                          'value'      => "$designation",
                                          'entry_date' => $date,
                                          'request_id' => $request_id,
                                      ]);
          }
                 

            $this->common_func($request_id, Auth::user()->id, 1,$date, $request->ip() );


             // $usr =  $request->assign_person;
             
                //for mailing
               $br_authorizer_info =  DB::table('users')->where('id',$assign_person_val)->first();
               $br_auth_email = $br_authorizer_info->email;

             $mail_to = $br_auth_email;
             // $mail_to = "rabiul.fci@gmail.com";

             $subject = "Assign For Request : $request_id";

             

              $request_id = "Request No : $request_id";
             
               $request_sent_date=date('Y-m-d');
               $branch_code=Auth::user()->branch;


               if ($branch_code !='202') {

                   //check sub branch

                  $br_pk_id = Auth::user()->br_pk_id;

                  if ($br_pk_id && $br_pk_id!='' && $br_pk_id!=NULL) {

                   
                    
                   $get_sub_br_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                   $branch_name = "Sub Branch Name : $get_sub_br_data->name ($branch_code)";

                  }else{

                    $br_info_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                    $branch_name = "Branch Name : ".$br_info_data->name." ($branch_code) ";

                  }

                

               }elseif ($branch_code =='202') {
                  $branch_name = "Head Office : ( ".Auth::user()->division_name.")";
               }

               $emp_id=Auth::user()->emp_id;
              
              $requested_by=Auth::user()->name."( $emp_id )";
              $authorized_by="";
              $user_id=Auth::user()->id;
                
              $request_type_id_for_mail =$sys_request_id;

              $request_type_id_data_get= DB::table('request_type')->where('id',$request_type_id_for_mail)->first();

              $role_name = $request_type_id_data_get->request_type_name;

              $system_id="$system_id";

              if ( $system_id) {
                
                 $get_system_data = DB::table('systems')->where('id',$system_id)->first();
                  $module_name = $get_system_data->system_name;


                   $system_data_get = DB::table('system_user_id')->where('sys_id', $system_id)->where('user', $user_id)->first();

                 


                    if (isset($system_data_get)) {

                       $final_user_id ="User Id :".$system_data_get->sys_user_id." Domain ID: ".Auth::user()->user_id;

                     }else{

                        $final_user_id =" Domain ID: ".Auth::user()->user_id;

                     }



              }
            
              

            $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth="",$final_user_id,$role_name,$module_name);
           
           }//system loop end

           if (!empty($requestTypeValueArra['6']['request_type_id'])) {
            
           
 if($this->checkRtgsParam($request->input('form_serialize_data'), $new_request_list) === false and $requestTypeValueArra['6']['request_type_id']==33){
            // $response_request_type = [
            //     "type"       => "warning",
            //     "status"     => 400,
            //     "success"    => false,
            //     "buttonText" => "Okay",
            //     "message"    => "Please select rtgs Temporary Expire Date and Time or Permanent"
            // ];
            // return response()->json($response_request_type);
                        print "0<>Please select rtgs Temporary Expire Date and Time or Permanent";
                        die();

           $notOk++;
        
          }

        }

   if( empty($data_to_insert) and $sts1== true)
   {
        $ok++;
   }   
   else
   {
    //  file_put_contents('arr.txt',json_encode($data_to_insert));

        $sts2 =  DB::table('request')->insert($data_to_insert);
                 // file_put_contents("requestQuery.txt", json_encode($data_to_insert));
                 if($sts1 == true ){
                   $ok++;
                   }else{
                     $notOk++;
                   }
   }





                  


             if($ok>0 && $notOk==0){
              DB::commit();
               echo "1<>Request Generated Successfully";
             }else{
               DB::rollback();
              echo "0<>Failed to Generate Request";
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
               $request_type_info = DB::select(DB::raw("SELECT rt.system_id as request_type_system_id, rt.request_type_name

                FROM [request_id] r_id

                  left join [request_type] rt on r_id.request_type_id = rt.id where r_id.req_id='$request_id' "))[0];

                  $request_type_name = $request_type_info->request_type_name;
                 



                   $single_fetch_data = DB::table('request_id')->where('sl', $hidden_id_assign)->update([

                    'br_checker_assign_manual_id'=>$usr,
                    'br_authorizer'=>$usr,
                    'update_date'=>$update_date,
                    'action_status_br_checker'=>'',
                    'recheck_status'=>''
                   
                  
                ]);



                 
                   $request_id = "Request Id : $request_id";
                  

                  

                    $this->common_func($request_id, Auth::user()->id, 2,$date, $request->ip() );//for audit log


                     $request_type_system_id = $request_type_info->request_type_system_id;

                     $user_id=Auth::user()->id;

                   if ($request_type_system_id) {
                
                        

                           $system_data_get = DB::table('system_user_id')->where('sys_id', $request_type_system_id)->where('user', $user_id)->first();

                         

                           if ($system_data_get) {

                             $final_user_id = $system_data_get->sys_user_id;

                           }else{

                              $final_user_id = Auth::user()->user_id;

                           }

                      }


                    $mail_to = $br_auth_email;
             // $mail_to = "rabiul.fci@gmail.com";

             $subject = "Assign For Request : $request_id";

             

              $request_id = "Request Id : $request_id";
             
               $request_sent_date=date('Y-m-d');
               $branch_name=Auth::user()->branch;
              $requested_by=Auth::user()->name;
              $authorized_by="";
             
               $role_name = "$request_type_name";
             

             $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();
            $module_name= $get_system_data->system_name;
                    // $this->mail_send();

              $this->mail_send($mail_to, $subject, $request_id, $request_sent_date,$branch_name,$requested_by,$authorized_by,$operations_div_auth='',$final_user_id,$role_name,$module_name);

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
                 $date = date('Y-m-d h:i:s');
                 
                $id =  $request->id;
                $cancel_reason =  $request->cancel_reason;
                $canceled_by =  Auth::user()->id;
                //$single_blog = Blog::find($row_id);

               $get_request_data_info = DB::table('request_id')->where('sl',$id)->first();
               $ho_maker = $get_request_data_info->ho_maker;

               $request_id = $get_request_data_info->req_id;

               if ($ho_maker && $ho_maker!=NULL && $ho_maker !=Auth::user()->id) {
                
                $get_ho_maker_user = DB::table('users')->where('id',$ho_maker)->first();
                echo "$get_ho_maker_user->name";
                die;
                 
               }

                $single_blog = DB::table('request_id')->where('sl',$id)->update(
                  [
                    'action_status'=>7,
                    'status'=>7,
                    'br_maker_cancel_sts_date'=>$update_date,
                    'cancel_reason'=>$cancel_reason,
                    'canceled_by'=>$canceled_by
                  ]
                );


                  $this->common_func($request_id, Auth::user()->id, 9, $date, $request->ip() );//for audit log

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
      if(empty($request_list)){
        return $request_list;
      }

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
    if(empty($prameter_list)){
      return $prameter_list;
    }
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

    file_put_contents('tushi.txt', "checkRTGSValidation($system_id, $request_list, $prameter_list);"."\n", FILE_APPEND);

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

        /*
        if(in_array("6-1814-", $new_parameter_list)) {
            return true;
        }
        */

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

public function checkRtgsParam($form_serialize_data, $request_list){
    $request_array     = explode(",", $request_list);
    if(in_array('6-33', $request_array)){
        $data_array = explode("&", $form_serialize_data);
        if(in_array("rtgs2_radio=143", $data_array) or in_array("rtgs2_radio=144", $data_array)){
            return true;
        }
        return false;
    }

    return true;


  
  
}


public function rtgsEnhanceMentDateTimeValidation($form_serialize_data){
  $data_array = explode("&", $form_serialize_data);
  // echo "<pre>";
  // print_r($data_array);die;

    
  
    if(in_array("rtgs2_radio=143", $data_array) ){
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



// specific error message section start
public function requestSpecificMessageError($system_list, $request_list){

    if(strpos($system_list, ",")){ // more than select system 2 items
      $system_list_array = explode(",", $system_list);
      for($i=0; $i< count($system_list_array); $i++){
          $system_id = $system_list_array[$i];
          $system_request_response = $this->checkRequestSelectedOrNot($system_id, $request_list);
          if($system_request_response['success'] == false){
              return $system_request_response;
              break;
          }
      }

      


    }else{
      $system_request_response = $this->checkRequestSelectedOrNot($system_list, $request_list);
      if($system_request_response['success'] == false){
          return $system_request_response;
      }
    }

    $response = [
      "success" => true,
      "message" => "done"
    ];
    return $response;
}

public function checkRequestSelectedOrNot($system_id, $request_list){
  $new_request_list = [];
  if(empty($request_list)){
    $system_id_name = $this->getSystemIdName($system_id);
    $response = [
        "success" => false,
        "message" => "$system_id_name request-type not selected :)"
    ];
    return $response;
}else{
    if(strpos($request_list, ",")){ // multiple select more than 2
        $request_list_array = explode(",", $request_list);        
        for($i=0; $i < count($request_list_array); $i++){
            $single_request_list_array = explode("-", $request_list_array[$i]);
            $request_id = $single_request_list_array[0];
            array_push($new_request_list, $request_id);
        }
    }else{ // only 2 system
        $single_request_list_array = explode("-", $request_list);
        $request_id = $single_request_list_array[0];
        array_push($new_request_list, $request_id);
    } 
}
  
  if(in_array($system_id, $new_request_list)){
      $response = [
          "success" => true,
          "message" => "request selected"
      ];
  }else{
      $system_id_name = $this->getSystemIdName($system_id);
      $response = [
          "success" => false,
          "message" => "$system_id_name request-type not selected"
      ];
  }

  return $response;
}


public function getSystemIdName($system_id){
  $data = DB::table('systems')->where('id', $system_id)->pluck('system_name');
  return $data[0];
}
// specific error message section end



// rtgs enhancement extra field remove section 
public function rtgsExtraParameterRemove($request_list, $parameter_list){
  // file_put_contents("324.txt", "echo rtgsExtraParameterRemove('$request_list','$parameter_list')");
  if(strpos($request_list, "6-") !== false ){
      if( strpos($request_list, "6-33") !== false){ // rtgs enhancement           
          return $this->removeOtherRTGSValueWithOutEnhancement($parameter_list);
      }else{  // rtgs other option
          return $this->removeEnhancementRTGSValueWithOtherField($parameter_list);
      }
  }
  return $parameter_list;
}


public function removeOtherRTGSValueWithOutEnhancement($parameter_list){
  if(strpos($parameter_list, ",") !== false){
      $parameter_list_array = explode(",", $parameter_list);
  }else{
      $parameter_list_array = explode(" ", $parameter_list);
  }
  
  $new_parameter_list = [];
  for($i=0; $i < count($parameter_list_array); $i++){
      if($this->isRtgsEnhancementValue($parameter_list_array[$i]) !== false){
         array_push($new_parameter_list, $parameter_list_array[$i]);
      }
  }
  return implode(",",$new_parameter_list);
}

public function isRtgsEnhancementValue($value){
  $rtgsEnhanceMentArray = [
      "6-135-chk",
      "6-136-chk",
      "6-137-chk",
      "6-138-chk",
      "6-139-chk",
      "6-140-chk",
      "6-141-chk",
      "6-142-chk",
      "6-143-chk",
      "6-144-chk",
      "6-158-reson",
      "6-1814-",
      "6-1815-"       
  ];

  $rtgsEnhanceMentValue = implode(",", $rtgsEnhanceMentArray);

  if(strpos($value, "6-") !== false){      
      $value_array  = explode("-", $value);
      $value_prefix = $value_array[0]."-".$value_array[1];
        
      if(strpos($rtgsEnhanceMentValue, $value_prefix) !== false){
          return true;
      }  
      return false; 
  }
  return true;
}


public function removeEnhancementRTGSValueWithOtherField($parameter_list){
  if(strpos($parameter_list, ",") !== false){
      $parameter_list_array = explode(",", $parameter_list);
  }else{
      $parameter_list_array = explode(" ", $parameter_list);
  }
  
  
  $new_parameter_list = [];
  for($i=0; $i < count($parameter_list_array); $i++){
      if(strpos($parameter_list_array[$i], "6-") !== false){
          if($this->isRtgsEnhancementValue($parameter_list_array[$i]) === false){
              array_push($new_parameter_list, $parameter_list_array[$i]);
          }
      }else{
          array_push($new_parameter_list, $parameter_list_array[$i]);
      }        
  }
  return implode(",",$new_parameter_list);
}

public function checkParameterList($para_id, $parameter_list){
 //file_put_contents('fasdfas.txt', "var_dump( checkParameterList('$para_id', '$parameter_list') );" ."\n", FILE_APPEND );
  if(strpos($parameter_list, ",") !== false){
      $parameter_list_array = explode(",", $parameter_list);
  }else{
      $parameter_list_array = explode(" ", $parameter_list);
  }


  for($i=0; $i < count($parameter_list_array); $i++){
      if(strpos($parameter_list_array[$i], "6-") !== false){
          if(strpos($parameter_list,"6-$para_id") !== false){
              return true;
          }else{
              return false;
          }
      }
  }

  return true;
}

public function rtgsEnhanceMent($request_id){
  //file_put_contents("dsfasdf.txt", $request_id);
  $data = DB::table('request_id')->where('req_id', $request_id)->pluck('request_type_id');
  if(isset($data[0]) && $data[0] == '33'){
    return true;
  }
  return false;
}
// rtgs enhancement extra field remove end


// for old designation show in report
public function designation_log($request_id, $assign_person_val){
  //echo "$request_id halim khan";

  $user_id = Auth::user()->user_id;
  $user_pk_id = Auth::user()->id;
  $designation = Auth::user()->designation;
  $req_maker_role = Auth::user()->role;
  $req_maker_branch = Auth::user()->branch;

  $get_checker_info = DB::table('users')->where('id', $assign_person_val)->first();
  $checker_role = $get_checker_info->role;

  if (Auth::user()->division_name) {

    $log_division = Auth::user()->division_name;
    
  }else{
    $log_division = "";
  }

  DB::table('designation_log')->insert([

        'log_reguest_id'=>"$request_id",
        'log_user_id'=>"$user_id",
        'log_user_pk_id'=>"$user_pk_id",
        'log_user_designation'=>$designation,
        'log_req_maker_role_id'=>$req_maker_role,
        'log_req_checker_role_id'=>$checker_role,
        'log_req_maker_branch'=>"$req_maker_branch",
        'log_division'=>"$log_division",


     ]);

}


  
}
