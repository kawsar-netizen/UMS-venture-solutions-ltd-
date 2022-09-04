<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
date_default_timezone_set('Asia/Dhaka');


class TableFilter extends Controller
{
   public function get_data_with_system_and_status(Request $request){


       $system_id = $request->system_name;
      $status_id = $request->status;

      if ($system_id=='all' and $status_id=='all') {


         $filter_query="";

      }elseif($system_id=='all' and $status_id !='all'){

          
            if ($status_id==0) {
                $filter_query=" and r_id.[status]='$status_id'";

              }elseif($status_id==1){

                   $filter_query=" and r_id.[status]='0' and r_id.[action_status_br_checker]='1' ";

              }elseif($status_id==2){

                   $filter_query=" and r_id.[status]='$status_id' and r_id.[action_status_ho_checker]='5' ";

              }elseif($status_id==3){

                   $filter_query=" and r_id.[status]='$status_id' and r_id.[action_status_ho_checker]='5' ";

              }elseif($status_id==7){

                   $filter_query=" and r_id.[status]='$status_id' and r_id.[action_status]='7' ";

              }  
             
       

        

      }elseif($system_id !='all' and $status_id =='all'){

         $filter_query=" and r.sys_id='$system_id'";

      }elseif($system_id !='all' and $status_id !='all'){

          if ($status_id==0) {

                 $filter_query=" and r.sys_id='$system_id' and r_id.[status]='$status_id'";

              }elseif($status_id==1){

                   $filter_query="  and r.sys_id='$system_id' and r_id.[status]='0' and r_id.[action_status_br_checker]='1' ";

              }elseif($status_id==2){

                   $filter_query="  and r.sys_id='$system_id'  and r_id.[status]='$status_id' and r_id.[action_status_ho_checker]='5' ";

              }elseif($status_id==3){

                   $filter_query="  and r.sys_id='$system_id'  and r_id.[status]='$status_id' and r_id.[action_status_ho_checker]='5' ";

              }elseif($status_id==7){

                   $filter_query="  and r.sys_id='$system_id' and r_id.[status]='$status_id' and r_id.[action_status]='7' ";

              }  

        

      }

      $role = Auth::user()->role;
      $branch_code = Auth::user()->branch;

    

      // start role=1 (branch maker)

      if ($role == 1) 
      {
       $request_array = [];

       $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],
   r_id.[recheck_status],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],

   r_id.[canceled_by],
   r_id.[rechecker],
   r_id.[br_checker_recheck_reason],

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
   
    r_id.[request_type_id],
    rt.[request_type_name],
    rt.[system_id] as rt_system_id,

    r_id.[request_type_value],

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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

       where u.[role]='$role' and u.[branch]='$branch_code'  $filter_query

       order by r_id.sl desc 

      "));

      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
         
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
          "recheck_status" => $request->recheck_status,

           "canceled_by" => $request->canceled_by,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,

          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];
      }
      
      foreach($requests as $request){


        array_push($request_array[$request->req_id]["para_list"],array(
                                    $request->para_id,
                                   $request->para_name,
                                    $request->value,
                                   $request->para_type));

          array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


       

   
            // array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

       

            
          array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


       
        


        
      }
      
      foreach($requests as $request){
        // $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);

        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);
      }
      
      
      
      
      
       // return $request_array;
      
      
      
      
        // hasan code end

      
       $user_id = Auth::user()->id;
      // $requests = DB::select(DB::raw("SELECT *, users.name as users_table_name, br_user_subs.id as br_user_subs_id FROM br_user_subs LEFT JOIN users on  br_user_subs.br_authorizer= users.id  WHERE br_user_subs.user_id = '$user_id' order by br_user_subs.id desc"));

         return view('index',[
            'requests'=>$request_array
        ]);
      }

      // end role=1 (branch maker)

//-----------------------------------

      //start   role=2 (HO maker)

       elseif(Auth::user()->role == 2)
       {
        
         $request_array = [];

          $checker_user_id = Auth::user()->id;

         $user_id = Auth::user()->id;

           $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],
   r_id.[ho_authorize_status],
   r_id.[recheck_status],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   

     r_id.[canceled_by],
   r_id.[rechecker],
   r_id.[br_checker_recheck_reason],

   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker_comment],

   [ho_checker],
   r_id.[entry_date],
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
    r_id.[ho_maker_remarks],
    r_id.[ho_authorizer],

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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

               where  (r_id.action_status_br_checker='1'  or r_id.br_maker='$user_id'  or r_id.ho_maker='$user_id' or r_id.br_checker_assign_manual_id='$user_id')  $filter_query

      order by   r_id.sl desc,  status asc

      "));


      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "br_maker" => $request->br_maker,
          "request_type_system_id" => $request->rt_system_id,
          "recheck_status" => $request->recheck_status,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "canceled_by" => $request->canceled_by,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
          "ho_authorize_status" => $request->ho_authorize_status,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "ho_authorizer" => $request->ho_authorizer,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "ho_maker_remarks" => $request->ho_maker_remarks,
          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }
      
      foreach($requests as $request){

            array_push($request_array[$request->req_id]["para_list"],array(
                                        $request->para_id,
                                       $request->para_name,
                                        $request->value,
                                       $request->para_type));

              array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


            if ($request->request_type_name=='Unlock User') {

       
                array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

            }else{

                
              array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


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

        //end   role=2 (HO maker)

       //------------------------

       //start   role=8 (HO Authorize)

       elseif(Auth::user()->role == 8)
       {
        
         $request_array = [];

          $checker_user_id = Auth::user()->id;

         

           $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker_comment],

   [ho_checker],
   r_id.[entry_date],
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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

        where  r_id.action_status_ho_maker='8'  $filter_query

      order by   r_id.sl desc,  status asc

      "));


      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }
      
      foreach($requests as $request){

            array_push($request_array[$request->req_id]["para_list"],array(
                                        $request->para_id,
                                       $request->para_name,
                                        $request->value,
                                       $request->para_type));

              array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


            if ($request->request_type_name=='Unlock User') {

       
                array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

            }else{

                
              array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


            }
          
      }
      
      foreach($requests as $request){

        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);

      }
      
      
      
      
      
       // return $request_array;
      


      
       $user_id = Auth::user()->id;
      

         return view('index',[
            'ho_auth'=>$request_array
        ]);

       }

        //end   role=8 (HO Authorizer)


       //start role=9 (HO Div Maker)

       elseif(Auth::user()->role==9){

            $hodm_id = Auth::user()->id;

                     $request_array = [];

          $checker_user_id = Auth::user()->id;

         
          

           $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker_comment],

   [ho_checker],
   r_id.[entry_date],
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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

        where  r_id.ho_div_maker_id='$hodm_id'  $filter_query

      order by   r_id.sl desc,  status asc

      "));


      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }
      
      foreach($requests as $request){

            array_push($request_array[$request->req_id]["para_list"],array(
                                        $request->para_id,
                                       $request->para_name,
                                        $request->value,
                                       $request->para_type));

              array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


            if ($request->request_type_name=='Unlock User') {

       
                array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

            }else{

                
              array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


            }
          
      }
      
      foreach($requests as $request){

        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);

      }
      
      
      
      
      
       // return $request_array;
      


      
       $user_id = Auth::user()->id;
      

         return view('index',[
            'ho_div_maker'=>$request_array
        ]);


       }

       //end if role=9 (HO Div Maker)


       //start role = 10 (HO Div Checker)

       elseif(Auth::user()->role == 10){

           

                     $request_array = [];

          $my_user_id = Auth::user()->id;

         
          

           $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker_comment],

   [ho_checker],
   r_id.[entry_date],
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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

        where  r_id.br_checker_assign_manual_id='$my_user_id'   $filter_query

      order by   r_id.sl desc,  status asc

      "));


      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,
          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }
      
      foreach($requests as $request){

            array_push($request_array[$request->req_id]["para_list"],array(
                                        $request->para_id,
                                       $request->para_name,
                                        $request->value,
                                       $request->para_type));

              array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


            if ($request->request_type_name=='Unlock User') {

       
                array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

            }else{

                
              array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


            }
          
      }
      
      foreach($requests as $request){

        $request_array[$request->req_id]["final_operation_name"] = implode(",", $request_array[$request->req_id]["operation_name"]);
        $request_array[$request->req_id]["final_request_type"] = implode(",", $request_array[$request->req_id]["request_type"]);

      }
      
      
      
      
      
       // return $request_array;
      


      
       $user_id = Auth::user()->id;
      

         return view('index',[
            'ho_div_checker'=>$request_array
        ]);

       }

       //end if role = 10 (HO Div Checker)

       elseif(Auth::user()->role == 3)
       {
        // return view('index3');
        $requests = DB::table('br_user_subs')->orderBy('id','DESC')->get();

         return view('index',[
            'requests'=>$requests
        ]);
       }


       //start role=5 (branch Checker)

       elseif(Auth::user()->role == 5)
       {

         $role = Auth::user()->role;
         $branch_code = Auth::user()->branch;

        
        $request_array = [];

          $checker_user_id = Auth::user()->id;

          

         $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],
   r_id.[recheck_status],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],

   r_id.[canceled_by],
   r_id.[rechecker],
   r_id.[br_checker_recheck_reason],

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
   
    r_id.[request_type_id],
    rt.[request_type_name],
    rt.[system_id] as rt_system_id,

    r_id.[request_type_value],

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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

        where r_id.br_checker_assign_manual_id ='$checker_user_id'  $filter_query

       order by r_id.sl desc 

      "));

      foreach($requests as $request){
       $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
         
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
          "recheck_status" => $request->recheck_status,

           "canceled_by" => $request->canceled_by,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,

          "user_name" => $request->branch_maker_name,
          "br_checker" => $request->br_checker,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,

          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];

      }
      
      foreach($requests as $request){

         array_push($request_array[$request->req_id]["para_list"],array(
                                    $request->para_id,
                                   $request->para_name,
                                    $request->value,
                                   $request->para_type));

          array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


        if ($request->request_type_name=='Unlock User') {

   
            array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

        }else{

            
          array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


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


       }  

       //end role=5 (branch checker)

       //-------------------------

       //start role=6 (HO checker)

       elseif(Auth::user()->role == 6)
       {
         $request_array = [];

          $checker_user_id = Auth::user()->id;
          $user_id = Auth::user()->id;

    
           $requests = DB::select(DB::raw("SELECT
   r_id.[sl],
   [req_id],
   r_id.[status],
   r_id.[action_status],
    r_id.[action_status_br_checker],
   r_id.[action_status_ho_maker],
   r_id.[action_status_ho_checker],
   r_id.[recheck_status],

   r_id.[br_checker_assign_manual_id],
   r_id.[br_authorizer],
   
   r_id.[canceled_by],
   r_id.[rechecker],
   r_id.[br_checker_recheck_reason],

   [branch_code],
   [br_maker],
   [br_checker],
   [ho_maker],
   [ho_checker_comment],

   [ho_checker],
   r_id.[entry_date],
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
  left join 
        [request_type] rt

        on r_id.request_type_id = rt.id

        where  (r_id.action_status_ho_maker='3' or r_id.action_status_ho_maker='4'  or r_id.br_maker='$user_id' or r_id.br_checker_assign_manual_id='$user_id')  $filter_query

     order by r_id.sl desc 

      "));


      

      foreach($requests as $request){

        $request_array[$request->req_id] = [
           "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
          "request_type_system_id" => $request->rt_system_id,
         
          "status" => $request->status,
          "action_status" => $request->action_status,
          "recheck_status" => $request->recheck_status,
          
          "action_status_br_checker" => $request->action_status_br_checker,
          "action_status_ho_maker" => $request->action_status_ho_maker,
          "action_status_ho_checker" => $request->action_status_ho_checker,

          "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
          "br_authorizer" => $request->br_authorizer,
      
          "canceled_by" => $request->canceled_by,
          "rechecker" => $request->rechecker,
          "br_checker_recheck_reason" => $request->br_checker_recheck_reason,

          "user_name" => $request->branch_maker_name,
          "br_maker" => $request->br_maker,
          "br_checker" => $request->br_checker,
          "ho_checker_comment" => $request->ho_checker_comment,
          "ho_maker" => $request->ho_maker,
          "ho_checker" => $request->ho_checker,
          "branch_code" => $request->branch_code,
          "system_name" => $request->system_name,
          "input_value" => $request->system_name,

          
          "operation_name" => [],
          "para_list" => [

          ],
          "request_type" => [],
        ];
      }
      
      foreach($requests as $request){

           array_push($request_array[$request->req_id]["para_list"],array(
                                        $request->para_id,
                                       $request->para_name,
                                        $request->value,
                                       $request->para_type));

              array_push($request_array[$request->req_id]["operation_name"], urldecode($request->para_name));


            if ($request->request_type_name=='Unlock User') {

       
                array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_value));

            }else{

                
              array_push($request_array[$request->req_id]["request_type"], urldecode($request->request_type_name));


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
            'it_checker'=>$request_array
        ]);
        
       }


       //--------------

        //end role=6 (HO checker)

       else
       {
        // return view('index4');
        $my_id = Auth::user()->id;
         $requests = DB::table('br_user_subs')->where('assign_person',$my_id)->orderBy('id','DESC')->get();
         
         return view('index4',[
            'requests'=>$requests
        ]);
       }

		
		
		} // end get_data_with_system function

    

}
