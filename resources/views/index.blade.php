
@extends('master.master')



<?php

if(!empty($_GET['req_id'])){

  $get_req_id =  $_GET['req_id'];

}else{

  $get_req_id =  "";
}


if(!empty($_GET['branch_code'])){

  $get_branch_code = $_GET['branch_code'];

}else{
  $get_branch_code="";
}

if(!empty($_GET['module_name'])){

  $get_module_name = $_GET['module_name'];

}else{
  $get_module_name="";
}

if(!empty($_GET['request_type_name'])){

  $get_req_type =  $_GET['request_type_name'];

}else{

  $get_req_type =  "";
}

if(!empty($_GET['request_from'])){

  $get_request_from =  $_GET['request_from'];

}else{

  $get_request_from =  "";
}

if(!empty($_GET['it_maker_search'])){

  $get_it_maker_search =  $_GET['it_maker_search'];

}else{

  $get_it_maker_search =  "";
}



if(!empty($_GET['it_checker_search'])){

  $get_it_checker_search =  $_GET['it_checker_search'];

}else{

  $get_it_checker_search =  "";
}

if(!empty($_GET['search_status'])){
  $search_status = $_GET['search_status'];
}else{
  $search_status = "";
}


?>


      @section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User Request List</b></h2>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item">
                        <a href=""><b>User Request Form</b></a>
                    </li> -->
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection

    @push('css')


    <style>
  @media print {
    body * {
      visibility: hidden;
    }
    .modal-content * {
      visibility: visible;
      overflow: visible;
    }
    .main-page * {
      display: none;
    }
    .modal {
      position: absolute;
      left: 0;
      top: 0;
      margin: 0;
      padding: 0;
      min-height: 550px;
      visibility: visible;
      overflow: visible !important; /* Remove scrollbar for printing. */
    }
    .modal-dialog {
      visibility: visible !important;
      overflow: visible !important; /* Remove scrollbar for printing. */
    }
  }




  </style>

    @endpush

       
         @section('content')

<!-- loader part -->
   <!-- <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div> -->
  <!-- loader part ends -->


@if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 1rem; padding-top: 1rem; margin-top: 1rem">
            <i class=""></i>&nbsp;&nbsp;&nbsp;
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 0.8rem">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<br>
    


                 

                    <div class="ibox " style="">
                        <div class="ibox-title">
                            <h5>Data Filter</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                    </li>
                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">


                         <form action="{{ url('search-table-info') }}" method="GET" class="">

                          @csrf

                         <div class="row">
                           <div class="col-md-4">
                            <div class="form-group mx-sm-1 mb-2">
                              <label for="inputSearch" >Request Id</label>

                              <input type="text" name="req_id" class="form-control" id="req_id" value="<?php echo $get_req_id; ?>" placeholder="Request Id">

                            </div>
                           </div>

                           <?php


                           if(Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='8' || Auth::user()->role=='11' || Auth::user()->role=='12'){

                          ?>
                            <div class="col-md-4">
                                <div class="form-group mx-sm-1 mb-2">
                                    <label for="inputSearch" >Branch</label>

                                    <select class="form-control select2" name="branch_code" id="branch_code">
                                      <option value="">--select--</option>
                                      <?php 
                                        $get_branch_data = DB::table('branch_info')->get();
                                        foreach ($get_branch_data as  $br_info) {
                                          # code...
                                        ?>
                                      <option value="{{$br_info->bnk_br_id}}" 
                                      
                                      <?php
                                        if($br_info->bnk_br_id == $get_branch_code){
                                          echo "selected";
                                        }
                                          
                                      ?>>{{$br_info->name}} ({{$br_info->bnk_br_id}})</option>

                                      <?php 

                                      }
                                      ?>
                                    </select>

                              </div>
                            </div>

                            <?php 

                            }
                                                      
                            ?>

                            <div class="col-md-4">
                                <div class="form-group mx-sm-1 mb-2">
                                <label for="inputSearch" >Module Name</label>

                                  <select class="form-control select2" name="module_name" id="module_name">
                                    <option value="">--select--</option>
                                    <?php 
                                      $get_module_data = DB::table('systems')->get();
                                      foreach ($get_module_data as  $module_info) {
                                        # code...
                                      ?>
                                    <option value="{{$module_info->id}}" <?php if($get_module_name==$module_info->id){ echo "selected";}  ?> >{{$module_info->system_name}}</option>

                                    <?php 

                                    }
                                    ?>
                                  </select>

                              </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mx-sm-1 mb-2">
                                <label for="inputSearch" >Request Type Name &nbsp;</label>

                                  <select class="form-control select2" name="request_type_name" id="request_type_name">
                                    <option value="">--select--</option>
                                    <?php 
                                      $get_rt_data =DB::select(DB::raw("SELECT 
                                      [request_type_name]
                                    
                                  FROM [dbfive].[dbo].[request_type] group by request_type_name "));
                                      foreach ($get_rt_data as  $request_type) {
                                      
                                      ?>
                                    
                                    <option value="{{$request_type->request_type_name}}" <?php 
                                    
                                        if($get_req_type == $request_type->request_type_name){
                                          echo "selected";
                                        }
                                    ?>>{{$request_type->request_type_name}}</option>

                                    <?php 

                                    }
                                    ?>
                                  </select>

                              </div>
                              
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mx-sm-1 mb-2">
                                <label for="inputSearch" >Status &nbsp;</label>

                                  <select class="form-control " name="search_status" id="search_status">
                                    <option value="">--select--</option>
                                    
                                    <option value="10" <?php if($search_status=='10'){
                                      echo "selected";
                                    } ?>>Initiate</option>
                                    <option value="1" <?php if($search_status=='1'){
                                      echo "selected";
                                    } ?>>Processing</option>
                                    <option value="5" <?php if($search_status=='5'){
                                      echo "selected";
                                    } ?>>Waiting For authorization</option>
                                   
                                    <option value="2" <?php if($search_status=='2'){
                                      echo "selected";
                                    } ?>>Complete</option>
                                    <option value="3" <?php if($search_status=='3'){
                                      echo "selected";
                                    } ?>>On Hold</option>
                                    <option value="4" <?php if($search_status=='4'){
                                      echo "selected";
                                    } ?>>Cancel</option>
                                    <option value="6" <?php if($search_status=='6'){
                                      echo "selected";
                                    } ?>>Decline</option>
                                    
                                  </select>

                              </div>
                            </div>

                          <?php 
                            //without branch maker and head office division maker 
                            if (Auth::user()->role=='2' || Auth::user()->role=='5' || Auth::user()->role=='6' || Auth::user()->role=='8' || Auth::user()->role=='10' || Auth::user()->role=='11' || Auth::user()->role=='12') {
                              
                           ?>
                            <div class="col-md-4">
                              <div class="form-group mx-sm-1 mb-2">
                              <label for="inputSearch" >Request From &nbsp;</label>

                                <select class="form-control select2" name="request_from" id="request_from">
                                  <option value="">--select--</option>
                                  <?php 

                                  // for it maker, it checker, ho authorizer, Admin, Super Admin
                                  if(Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='8' || Auth::user()->role=='11' || Auth::user()->role=='12'){
                                    
                                    $user_table = DB::table('users')->get();

                                  }elseif( Auth::user()->role=='5'){

                                    $user_table = DB::table('users')->where('branch', Auth::user()->branch)->get();

                                  }elseif( Auth::user()->role=='10'){

                                    $user_table = DB::table('users')->where('division_name', Auth::user()->division_name)->get();
                                    
                                  }
                                  
                                  foreach($user_table as $single_user){
                                    ?>
                                      <option value="{{$single_user->id}}" <?php if($get_request_from==$single_user->id){ echo "selected";} ?>>{{$single_user->name}} ( {{$single_user->user_id}} ) </option>
                                    <?php
                                  }
                                  ?>
                                </select>

                            </div>
                            </div>

                            <?php 

                             }

                          ?>



                          <?php 
                            if (Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='11' || Auth::user()->role=='12') {
                              
                              ?>

                            <div class="col-md-4">
                              <div class="form-group mx-sm-1 mb-2">
                              <label for="inputSearch" >IT Maker &nbsp;</label>

                                <select class="form-control select2" name="it_maker_search" id="it_maker_search">
                                  <option value="">--select--</option>
                                  <?php 

                                 //it maker all user
                                 $user_table = DB::table('users')->where('role',2)->get();
                                  
                                  foreach($user_table as $single_user){
                                    ?>
                                      <option value="{{$single_user->id}}" <?php 
                                      
                                        if($single_user->id == $get_it_maker_search){
                                          echo "selected";
                                        }
                                      ?>>{{$single_user->name}} ( {{$single_user->user_id}} )</option>
                                    <?php
                                  }
                                  ?>
                                </select>

                            </div>
                            </div>

                            


                            
                            <div class="col-md-4">
                              <div class="form-group mx-sm-1 mb-2">
                              <label for="inputSearch" >IT Checker &nbsp;</label>

                                <select class="form-control select2" name="it_checker_search" id="it_checker_search">
                                  <option value="">--select--</option>
                                  <?php 

                                 //it maker all user
                                 $user_table = DB::table('users')->where('role',6)->get();
                                  
                                  foreach($user_table as $single_user){
                                    ?>
                                      <option value="{{$single_user->id}}" <?php 
                                      
                                      if($single_user->id == $get_it_checker_search){
                                        echo "selected";
                                      }
                                    ?>>{{$single_user->name}} ( {{$single_user->user_id}} )</option>
                                    <?php
                                  }
                                  ?>
                                </select>

                            </div>
                            </div>
                            
                            <?php 

                              }

                            ?>

                            <div class="col-md-4 offset-md-8">
                            <button type="submit" class="btn btn-primary mb-2 search_btn">Search</button>
                            </div>
                         </div>

                          
                          
                     
                              
                          </form>

                        </div>
                   
            </div><!-- end data filter -->





           

 <!-- when role 1 (branch maker) -->
    @if(Auth::user()->role == 1)


    <div class="double-scroll table-wrapper-scroll-y">
        <table id=""  class="table table-striped table-hover " width="100%">
            <thead>
                


            <tr>
                
                <th scope="col" style="color: black">Serial</th>
                <th scope="col" style="color: black">Request Id</th>
                <th scope="col" style="color: black">Action</th>
                <th scope="col" style="color: black">Status</th>
                <th scope="col" style="color: black">Request Entry Date & Time</th>
                 <th scope="col" style="color: black">User</th>
                <th scope="col" style="color: black">Branch</th>
                <th scope="col" style="color: black">System</th>

                <th scope="col" style="color: black">Details </th>
               
              
                <th scope="col" style="color: black">Request Type</th>
                <th scope="col" style="color: black">Branch Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>
                 <th scope="col" style="color: black">Decline Remarks (Branch)</th>

                
                
            </tr>
            </thead>
            <tbody class="filter_table">


                <?php 

                $request_array = [];

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
                      "pk_for_sub_br" => $request->pk_for_sub_br,

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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }  
      
      
                ?>

            @php($i=1)
            @foreach($request_array as $r)

                <tr>

                    

                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                    <td>{{$r['req_id']}}</td>

                    <td>

                            <?php 

                                if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

                              

                                if($r['action_status'] !='7'){

                              

                            ?>
                            <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                                echo "disabled";

                            } 



                              $rt_system_id = $r['request_type_system_id'];

                          $system_data =  DB::table('systems')->where('id', $rt_system_id)->first();

                           $system_name = $system_data->system_name;

                            ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

                                <br>
                                <br>

                            <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

                              

                            <?php
                                



                            }elseif ($r['action_status']=='7') {
                              

                              ?>

                                <button type="button" class="btn  btn-danger btn-sm " disabled > Canceled </button>

                              <?php

                            }


                            }

                                ?>


                    </td>

                    <td>
                      <?php 
                      
                          $status = $r['status'];       
                          $action_status = $r['action_status'];               
                          $action_status_br_checker = $r['action_status_br_checker'];
                          $action_status_ho_maker = $r['action_status_ho_maker'];
                          $action_status_ho_checker = $r['action_status_ho_checker'];
                          
                          if ($status=='7' &&  $action_status=='7') {
                            echo "<span class='badge badge-danger'> Cancel </span>";

                        }elseif ($status=='6') {
                            echo "<span class='badge badge-danger'> Decline </span>";

                        }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3' ){

                            echo "<span class='badge badge-warning'> Initiate </span>";

                        }elseif($status !='7' && $status =='0'  && (  $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker)){

                          echo "<span class='badge badge-primary'> Processing </span>";
               
                        }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

                            echo "<span class='badge badge-info'> Waiting For Authorization </span>";

                        }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

                            echo "<span class='badge badge-success'> Completed </span>";

                        }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

                            echo "<span class='badge badge-info'> On Hold </span>";

                        }
                        ?> 
                      </td>


                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>   
                                            
                    <td style="color: black">{{$r['user_name']}}</td>
                    <td style="color: black"><?php


                   $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;


                   //sub branch if exist
                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }
                    //sub branch

                  ?></td>
                    <td style="color: black">

                      <?php 

                        $rt_system_id = $r['request_type_system_id'];

                          $system_data =  DB::table('systems')->where('id', $rt_system_id)->first();

                          echo $system_name = $system_data->system_name;
                       ?>
                       
                    </td>

                    <td>
                      
                      <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>

                    </td>



                  

                    
                    <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


                  

                   <td>

                    <?php

                    $br_authorizer_id = $r['br_authorizer']; 

               

                    if ($br_authorizer_id !='') {

                      $br_checker_data_count = DB::table('users')->where('id',$br_authorizer_id)->count();

                      if ($br_checker_data_count>0) {

                        $br_checker_data = DB::table('users')->where('id',$br_authorizer_id)->first();
                        echo $br_checker_data->name;

                      }else{
                        echo "";
                      }
                      

                    }else{
                      echo "";
                    }
                  
                    ?></td>

                   <td>
                    <?php

                    $ho_maker = $r['ho_maker'];

                      if ($ho_maker !='') {

                          $ho_maker_data_count = DB::table('users')->where('id',$ho_maker)->count();

                          if ($ho_maker_data_count >0) {

                             $ho_maker_data = DB::table('users')->where('id',$ho_maker)->first();
                             echo $ho_maker_data->name;

                          }else{
                            echo "";
                          }
                         

                      }else{
                      echo "";
                    }


                     ?>

                   </td>

                    <td>
                    

                       <?php

                      $ho_checker = $r['ho_checker']; 

                      if ($ho_checker !=''){

                          $ho_checker_data_count = DB::table('users')->where('id',$ho_checker)->count();

                          if ($ho_checker_data_count>0) {
                           
                           $ho_checker_data = DB::table('users')->where('id',$ho_checker)->first();
                          echo $ho_checker_data->name;

                          }else{
                            echo "";
                          }
                         

                      }else{
                      echo "";
                    }

                       ?>
                    </td>

                    
                    <td><?php  echo $r['br_checker_recheck_reason']; ?></td>
                    
                   
                   

     

                </tr>

          @endforeach
            </tbody>
        </table>

         {{ $requests->appends(request()->input())->links() }}

    </div>
     


   
<!-- role 1 ends -->






<!-- when role 5 (branch checker ) -->
    @elseif(Auth::user()->role == 5)

    <!-- Modal -->
<div class="modal fade declineModal" id="" tabindex="-1" role="dialog" aria-labelledby="decline_all_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="decline_all_label">Decline Reason For These Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <textarea class="form-control decline_reason_all" name="decline_reason_all"  rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary br_checker_multiple_decline">Save changes</button>
      </div>
    </div>
  </div>
</div>


     <div class="double-scroll table-wrapper-scroll-y" >

        <input type="hidden" name="br_checker_select_req_id" id="br_checker_select_req_id" value="">

         <input type="button" name="br_checker_multiple_authorize" class="btn btn-success br_checker_multiple_authorize"  value="Authorize All"> &nbsp; &nbsp;

         <input type="button" name="br_checker_multiple_decline_show_reason" class="btn btn-danger br_checker_multiple_decline_show_reason"  value="Decline All"   data-toggle="modal" data-target=".declineModal">

         <br> <br>

        <table id=""  class="table table-striped table-hover " >
            <thead>
            <tr>

                <th scope="col" style="color: black">All <input type="checkbox" name="checkbox_all" 
                    class="checkbox_all"></th>
                <th scope="col" style="color: black">Serial</th>
                 <th scope="col" style="color: black">Request Id</th>
                 <th scope="col" style="color: black">Status</th>
                <th scope="col" style="color: black">Action</th>

                 <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>
                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
             
                <th scope="col" style="color: black">Request Type</th>
                <th scope="col" style="color: black">Request From</th>

                <th scope="col" style="color: black">Branch Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>

                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>
                

            </thead>
            <tbody>


                <?php 

                 
                 $request_array=[];

                  foreach($requests as $request){
                   $request_array[$request->req_id] = [
                      "request_id" => $request->sl,
                      "req_id" => $request->req_id,
                      "system_id" => $request->sys_id,
                      "entry_date" => $request->entry_date,
                      "request_type_system_id" => $request->rt_system_id,
                     "canceled_by" => $request->canceled_by,
                      "rechecker" => $request->rechecker,
                      "br_checker_recheck_reason" => $request->br_checker_recheck_reason,
                      "pk_for_sub_br" => $request->pk_for_sub_br,
                     
                      "status" => $request->status,
                      "action_status" => $request->action_status,
                      "recheck_status" => $request->recheck_status,
                      
                      "action_status_br_checker" => $request->action_status_br_checker,
                      "action_status_ho_maker" => $request->action_status_ho_maker,
                      "action_status_ho_checker" => $request->action_status_ho_checker,

                      "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
                      "br_maker" => $request->br_maker,
                      "br_authorizer" => $request->br_authorizer,

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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }

      

                ?>

            @php($i=1)
            @foreach($request_array as $r)

                <tr>

                    <?php 

                    // echo $r['action_status_br_checker'].'----';
                    // echo "<br>";
                       

                            if ($r['br_checker_assign_manual_id'] == Auth::user()->id  && empty($r['action_status_br_checker'])  ) {
                              
                            

                        ?>
                       
                     <th style=""><input type="checkbox" name="checkbox_single" value="{{ $r['request_id'] }}" class="checkbox_single"></th>

                     <?php
                        

                      }else{

                       
                        ?>

                          <th style=""><input type="checkbox"  disabled=""></th>
                        <?php
                      }
                     ?>

                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                    <td>{{$r['req_id']}}</td>


                    <td>
                      <?php 

                        $status = $r['status'];       
                        $action_status = $r['action_status'];               
                        $action_status_br_checker = $r['action_status_br_checker'];
                        $action_status_ho_maker = $r['action_status_ho_maker'];
                        $action_status_ho_checker = $r['action_status_ho_checker'];

                        if ($status=='7' &&  $action_status=='7') {
                          echo "<span class='badge badge-danger'> Cancel </span>";

                        }elseif ($status=='6') {
                          echo "<span class='badge badge-danger'> Decline </span>";

                        }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

                          echo "<span class='badge badge-warning'> Initiate </span>";

                        }elseif($status !='7' && $status =='0'  && (  $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

                          echo "<span class='badge badge-primary'> Processing </span>";
               
                        }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

                          echo "<span class='badge badge-info'> Waiting For Authorization </span>";

                        }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

                          echo "<span class='badge badge-success'> Completed </span>";

                        }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

                          echo "<span class='badge badge-info'> On Hold </span>";

                        }

                    ?> </td>
                   




                    


                    <td>  

                <?php

                if ($r['action_status_br_checker']==1 && Auth::user()->role == 5 ) {
                   
                ?>

                   

                    <!--     <button style="width:105px;margin-top: 10px;" type="button" class="btn  btn-primary btn-sm  btnEditRowWithModal" disabled > Authorized </button> -->
                   
                    
                <?php
                
                }elseif($r['action_status']==7 && Auth::user()->role == 5){
                  ?>


                  <button style="width:105px;margin-top: 10px;" type="button" class="btn  btn-warning btn-sm " disabled > Canceled </button>


                  <?php

                }else{

            if ($r['action_status_br_checker'] !=2 ) {
              
              if($r['br_maker']== Auth::user()->id){
              
            ?>

            <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                echo "disabled";

               }
               
               
               $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                         $get_system_data->system_name;

                      } 

               ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{ $get_system_data->system_name }}', '{{$r['final_request_type']}}')">Assign Person</button>

                 <br>
                <br>
                
                <?php 


                  
                  }
                  
                  if($r['br_checker_assign_manual_id'] == Auth::user()->id){



                     $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                       

                      } 
                  
                ?>
                

            <button style="width:105px;margin-top: 10px;" type="button" title="Authorize" onclick="authorize({{$r['request_id']}}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}')" class="btn btn-primary btn-sm"  >Authorize</button>

             

            <?php
            
              }
              
            }

                    }
                   ?>


                <?php

                if ($r['action_status_br_checker']==2 &&  Auth::user()->role == 5  ) {
                   
                   if ($r['br_maker']==Auth::user()->id) {
                      ?>

                       <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } 



                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                      

                         ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

                             <br>
                            <br>

                        <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

                      <?php 
                   }else{
                    ?>

                    <button  style="width:105px;margin-top: 10px;background: #f35252;" type="button" class="btn  btn-warning btn-sm  btnEditRowWithModal" disabled > Declined </button>

                    <?php 
                   }
                ?>

                   

                
                <?php
                
                }elseif($r['action_status']!=7 && $r['action_status_br_checker']!=1){

                    ?>

                    <br>
                    <br>

                     <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

                     <?php 

                }

                    
                    if ($r['action_status_br_checker']!='1' &&  $r['action_status_br_checker']!='2' && ($r['action_status'] !='7' || $r['status'] !='7') && $r['br_checker_assign_manual_id']== Auth::user()->id){
                       
                    
                    ?>


                 
                   <button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
                     class="btn btn-warning btn-sm " 
                      onclick="decline({{$r['request_id'] }}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )"  >Decline </button>
                  


                   <?php

                    }
                   ?>

               </td>



                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>   

                    <td style="color: black">
                      
                      <?php

                   $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;



                   //sub branch if exist
                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }
                    //sub branch if exist

                   ?>

                    </td>

                    <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>

                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                     <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


                     <td style="color: black">{{$r['user_name']}}</td>
                  

                   <td>

                    <?php

                    $br_authorizer = $r['br_authorizer']; 

                    if ($br_authorizer!='') {
                     
                    $br_authorizer_data_count = DB::table('users')->where('id',$br_authorizer)->count();

                      if ($br_authorizer_data_count>0) {

                       $br_authorizer_data = DB::table('users')->where('id',$br_authorizer)->first();
                       echo $br_authorizer_data->name;

                      }else{
                        echo "";
                      }
                    

                    }
                    
                    ?></td>

                   <td>
                    <?php

                    $ho_maker_id = $r['ho_maker'];

                    if ($ho_maker_id!='') {
                     
                    $ho_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                        if ($ho_maker_data_count >0) {

                         $ho_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                         echo $ho_maker_data->name;

                        }else{
                          echo "";
                        }
                    

                    }

                     ?>

                   </td>

                    <td>
                       <?php

                       $ho_checker_id = $r['ho_checker'];

                       if ($ho_checker_id!='') {

                        $ho_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                        if ($ho_checker_data_count>0) {

                          $ho_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                          echo $ho_checker_data->name;

                        }else{

                          echo "";
                        }
                        

                       }


                        ?>
                    </td>

                    <td>
                        <?php

                        echo $r['br_checker_recheck_reason'];
                        ?>
                    </td>
                    
                    
                    

                </tr>

          @endforeach



            </tbody>


        </table>

        {{ $requests->appends(request()->input())->links() }}

    </div>
       

    

<!-- end role 5 br checker -->


 <!-- when role 2 (head maker) -->
@elseif(Auth::user()->role == 2 &&  Auth::user()->division_name == "IT Division")

 <div class="double-scroll table-wrapper-scroll-y">
<table id=""  class="table table-striped table-hover"  >
            <thead>
            <tr>
                <th scope="col" style="color: black">Serial</th>              
                 
                  <th scope="col" style="color: black">Request Id</th>

                  <th scope="col" style="color: black">Action</th>
                  <th scope="col" style="color: black">Status</th>

                <th scope="col" style="color: black">Request Entry Date & Time</th>
                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
                
                <th scope="col" style="color: black">Request Type</th> 
                

                <th scope="col" style="color: black">Decline Reason</th>

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">Branch Checker</th>


                 <th scope="col" style="color: black">Assign Person</th>
               
                <th scope="col" style="color: black">IT Checker</th>


                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                

            </thead>
            <tbody>


                <?php 

                    $request_array = [];

                          foreach($requests as $request){

                    $request_array[$request->req_id] = [
                      "request_id" => $request->sl,
                      "req_id" => $request->req_id,
                      "system_id" => $request->sys_id,
                      "entry_date" => $request->br_checker_sts_update_date,
                      "br_maker" => $request->br_maker,
                      "request_type_system_id" => $request->rt_system_id,
                      "recheck_status" => $request->recheck_status,
                      "pk_for_sub_br" => $request->pk_for_sub_br,
                      
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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }  
      

                ?>
            @php($i=1)
           @foreach($request_array as $r)


           

                <tr >
                
                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                     <td>{{$r['req_id']}}</td>

                     <td>


<?php 

 if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

  if ($r['br_maker'] == Auth::user()->id && !$r['canceled_by']) {
   
  
?>
<button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

      echo "disabled";

   } 

   $request_type_system_id = $r['request_type_system_id'];

   if ($request_type_system_id) {
     # code...
   
    $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

     $get_system_data->system_name;

  } 
   
   ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>


<?php 

if($r['canceled_by']){


?>
       <br>
      <br>

<button type="button" class="btn  btn-danger btn-sm " disabled > Canceled </button>
     
    

  <?php 

}else{
?>
<br>
<br>
<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

<?php 
}


    }

    } // end if br maker==me

  if ($r['br_maker']!=Auth::user()->id) {
     

 
  if ($r['action_status']!=7) {
         
      
      if($r['ho_maker']=='' || $r['action_status_ho_maker']=='') {

        if($r['ho_authorize_status']=='1' && $r['system_id']=='6' && in_array('Enhancement', $r['request_type'])){

          
          ?>


    
  <?php 
    if(!empty($r['action_status_br_checker'])){

  ?>
  <a type="button" style="width: 110px;" class="btn btn-info btn-sm" onclick="request_accept({{$r['request_id']}}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" >Request Accept</a>

  <?php  
   }
  ?>
  <br> <br>

  <?php
      }elseif($r['ho_authorize_status']=='0' && $r['system_id']=='6' && in_array('Enhancement', $r['request_type'])){

        echo "<button class='btn btn-warning btn-sm' disabled>Declined From Head Office Authorizer ! </button>";


      }elseif($r['ho_authorize_status']!='1' && $r['system_id']=='6' && in_array('Enhancement', $r['request_type'])){

        echo "<button class='btn btn-success btn-sm' disabled>Waiting For Head Office Authorizer !</button>";
        echo "<br>";


      }elseif($r['system_id']!='6' || ($r['system_id']=='6' &&  $r['request_type'][0]!='Enhancement' )){
        ?>
            <?php 
      if(!empty($r['action_status_br_checker'])){

    ?>
     <a type="button" style="width: 110px;" class="btn btn-info btn-sm" onclick="request_accept({{$r['request_id']}}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" >Request Accept</a>

    <?php  
    }
    ?>

          <?php

      }

    }

}

  ?>



   <?php

   if ($r['action_status']!=7) {
      
   
if($r['ho_maker'] ==Auth::user()->id and $r['action_status_ho_maker']!='' and $r['action_status_ho_checker']!='5') {
 
  
   $request_type_system_id = $r['request_type_system_id'];
    if ($request_type_system_id) {
      
       $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

       $get_system_data->system_name;
    }

?>

<button  onclick="EditModal_ho_maker_change_status('{{$r['request_id']}}','{{$r['req_id']}}', 
  '{{$get_system_data->system_name}}', '{{$r['final_request_type']}}', '{{$r['ho_maker_remarks']}}')" type="button" style="background-color: #D3544A;" class="btn  btn-primary btn-sm  btnEditRowWithModal_ho_maker_change_status" <?php if($r['status']==5 || ($r['action_status_ho_maker']==8 && in_array('Enhancement',$r['request_type']) && in_array('Checker',$r['operation_name'])  )) {

 echo "disabled";
 
} ?> > change Status </button>



<br>
<br>


<?php  
  if ($r['action_status_ho_maker']!='4') {
      

     if($r['system_id']!='6'){

     
      ?>



<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

<?php 

  }

 }
?>



<br>
<br>

  <?php if ($r['status']=='0' && $r['action_status_ho_maker']='3' && $r['action_status_ho_maker']!='4') {
     
   ?>

  <button class="btn btn-primary btn-sm" onclick="release('{{$r['request_id']}}','{{$r['req_id']}}');">Release</button>

  <?php

      }

  }elseif($r['action_status']!='7' && $r['action_status_ho_maker']!='4'){
      
        if($r['system_id']!='6'){

?>

<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

<?php 
  }
}

}

}else{

echo "";
}

?>


</td>

    <td>
      
    <?php 
         $status = $r['status'];       
         $action_status = $r['action_status'];               
         $action_status_br_checker = $r['action_status_br_checker'];
         $action_status_ho_maker = $r['action_status_ho_maker'];
         $action_status_ho_checker = $r['action_status_ho_checker'];
         
         if ($status=='7' &&  $action_status=='7') {
           echo "<span class='badge badge-danger'> Cancel </span>";

       }elseif ($status=='6') {
           echo "<span class='badge badge-danger'> Decline </span>";

       }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

           echo "<span class='badge badge-warning'> Initiate </span>";

       }elseif($status !='7' && $status =='0'  && ( $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

        echo "<span class='badge badge-primary'> Processing </span>";

      }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

           echo "<span class='badge badge-info'> Waiting For Authorization </span>";

       }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

           echo "<span class='badge badge-success'> Completed </span>";

       }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

           echo "<span class='badge badge-info'> On Hold </span>";

       }
    ?> 

    </td>


                  <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>     

                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;


                   //sub branch if exist
                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }
                    //sub branch if exist

                      ?>
                    </td>

                    <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                  

                    
                     <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>
                    




                   

                    <td><?php  $ho_checker_comment = $r['ho_checker_comment'];

                        if ($ho_checker_comment) {
                            echo $ho_checker_comment;

                        }
                ?></td>

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $br_checker_id = $r['br_checker_assign_manual_id']; 

                    if ($br_checker_id !='') {

                      $br_checker_data_count = DB::table('users')->where('id',$br_checker_id)->count();

                      if ($br_checker_data_count>0) {
                        $br_checker_data = DB::table('users')->where('id',$br_checker_id)->first();
                         echo $br_checker_data->name;
                      }
                     

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                    <td>
                      
                      <?php

                        $ho_maker_id = $r['ho_maker'];

                        if ($ho_maker_id !="") {
                          
                           $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                           if ($it_maker_data_count>0) {
                             
                             $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                             echo $it_maker_data->name;

                           }else{
                            echo "";
                           }
                          

                        }else{
                          echo "";
                        }
                        

                      ?>


                    </td>


                      <td><?php

                     $ho_checker_id = $r['ho_checker'];

                     if ($ho_checker_id !='') {



                        $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                        if ($it_checker_data_count>0) {

                          $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                          echo $it_checker_data->name;

                        }else{
                          echo "";
                        }

                       
                     }else{

                      echo "";
                     }
                    
                  
                    ?></td>

                    
                     <td style="color: black">{{$r['br_checker_recheck_reason']}}</td>

                   

                </tr>

               
                        

            @endforeach
          
            </tbody>
        </table>

         {{ $requests->appends(request()->input())->links() }}

    </div>


        <div class="modal fade halimmodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update">Save changes</button>
      </div>
    </div>
  </div>
</div>


  
<!-- role 2 ends -->



 <!-- when role 8 (HO Authorizer) -->
 @elseif(Auth::user()->role == 8  && Auth::user()->division_name=='Operations Division')

<div class="double-scroll table-wrapper-scroll-y">
<table id=""  class="table table-striped table-hover"  >
           <thead>
           <tr>
                 <th scope="col" style="color: black">Serial</th>              
                  
                   <th scope="col" style="color: black">Request Id</th>

                 <th scope="col" style="color: black">Request Entry Date & Time</th>
                 <th scope="col" style="color: black">Branch</th>

                 <th scope="col" style="color: black">System</th>
                 <th scope="col" style="color: black">Details</th>
                 
                 <th scope="col" style="color: black">Request Type</th> 
                 <th scope="col" style="color: black">Status</th>

                 <th scope="col" style="color: black">Decline Reason</th>

                  <th scope="col" style="color: black">Request From</th>
                 <th scope="col" style="color: black">Branch Checker</th>


                  <th scope="col" style="color: black">Assign Person</th>
                
                 <th scope="col" style="color: black">IT Checker</th>
                 <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

                
                  <th scope="col" style="color: black">Action</th>
              </tr>
           </thead>
           <tbody>


               <?php 

     $request_array = [];

     foreach($requests as $request){

       $request_array[$request->req_id] = [
         "request_id" => $request->sl,
         "req_id" => $request->req_id,
         "system_id" => $request->sys_id,
         "entry_date" => $request->br_checker_sts_update_date,
         "request_type_system_id" => $request->rt_system_id,
         "recheck_status" => $request->recheck_status,
        
         "status" => $request->status,
         "action_status" => $request->action_status,

          "canceled_by" => $request->canceled_by,
         "rechecker" => $request->rechecker,
         "br_checker_recheck_reason" => $request->br_checker_recheck_reason,
         "pk_for_sub_br" => $request->pk_for_sub_br,

         
         "action_status_br_checker" => $request->action_status_br_checker,
         "action_status_ho_maker" => $request->action_status_ho_maker,
         "action_status_ho_checker" => $request->action_status_ho_checker,

         "br_checker_assign_manual_id" => $request->br_checker_assign_manual_id,
         "br_authorizer" => $request->br_authorizer,
         "ho_authorize_status" => $request->ho_authorize_status,

         "user_name" => $request->branch_maker_name,
         "br_checker" => $request->br_checker,
         "br_maker" => $request->br_maker,
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
     
     foreach($request_array as $request){
       $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
       $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
     }  
     
     

               ?>
           @php($i=1)
          @foreach($request_array as $r)


          

               <tr >
               
                   <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                    <td>{{$r['req_id']}}</td>
                    <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>   

                   <td style="color: black">
                     
                     <?php

                        $branch_code = $r['branch_code'];


                   $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                  echo $branch_data->name;


                  //sub branch if exist
                   $pk_for_sub_br = $r['pk_for_sub_br'];

                   if ($pk_for_sub_br) {

                     $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                    
                    echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                   
                   }
                   //sub branch if exist


                     ?>
                   </td>

                  <td style="color: black">
                     <?php

                      $request_type_system_id = $r['request_type_system_id'];

                      if ($request_type_system_id) {
                        # code...
                      
                       $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                       echo $get_system_data->system_name;

                     } 
                      ?>
                      
                   </td>
                   
                   <td style="color: black">
                       <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                   </td>

                 

                 

                   
                    <td style="color: black">
                       <?php 

                       $final_request_type_exp = explode(',', $r['final_request_type']);

                       echo $final_request_type_exp[0];
                      

                       ?>
                   </td>
                   




                   <td>
                    <?php 

                        $status = $r['status'];       
                        $action_status = $r['action_status'];               
                        $action_status_br_checker = $r['action_status_br_checker'];
                        $action_status_ho_maker = $r['action_status_ho_maker'];
                        $action_status_ho_checker = $r['action_status_ho_checker'];

                        if ($status=='7' &&  $action_status=='7') {
                          echo "<span class='badge badge-danger'> Cancel </span>";

                        }elseif ($status=='6') {
                          echo "<span class='badge badge-danger'> Decline </span>";

                        }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

                          echo "<span class='badge badge-warning'> Initiate </span>";

                        }elseif($status !='7' && $status =='0'  && ( $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

                          echo "<span class='badge badge-primary'> Processing </span>";
               
                        }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

                          echo "<span class='badge badge-info'> Waiting For Authorization </span>";

                        }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

                          echo "<span class='badge badge-success'> Completed </span>";

                        }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

                          echo "<span class='badge badge-info'> On Hold </span>";

                        }

                   ?> </td>

                   <td><?php  $ho_checker_comment = $r['ho_checker_comment'];

                       if ($ho_checker_comment) {
                           echo $ho_checker_comment;

                       }
               ?></td>

               <td style="color: black">{{$r['user_name']}}</td>

                   <td><?php

                   $br_checker_id = $r['br_checker_assign_manual_id']; 

                   if ($br_checker_id !='') {

                     $br_checker_data_count = DB::table('users')->where('id',$br_checker_id)->count();

                     if ($br_checker_data_count>0) {

                      $br_checker_data = DB::table('users')->where('id',$br_checker_id)->first();
                      echo $br_checker_data->name;

                     }else{
                       echo "";
                     }
                     

                   }else{
                     echo "";
                   }
                 

                   ?></td>
                  
                 

                   <td>
                     
                     <?php

                       $ho_maker_id = $r['ho_maker'];

                       if ($ho_maker_id !="") {
                         
                          $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                          if ($it_maker_data_count) {

                            $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                            echo $it_maker_data->name;

                          }else{
                           echo "";
                          }
                         

                       }else{
                         echo "";
                       }
                       

                     ?>


                   </td>


                     <td><?php

                    $ho_checker_id = $r['ho_checker'];

                    if ($ho_checker_id !='') {

                       $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                       if($it_checker_data_count>0){

                         $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                          echo $it_checker_data->name;
                          
                       }else{
                         echo "";
                       }
                      
                    }else{

                     echo "";
                    }
                   
                 
                   ?></td>

                   
                    <td style="color: black">{{$r['br_checker_recheck_reason']}}</td>

                   <td>


                      <?php 

                      if(($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL) && !$r['canceled_by'] ){

                       if ($r['br_maker'] == Auth::user()->id) {
                        
                       
                     ?>

                      <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                           echo "disabled";

                        } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

                            <br>
                           <br>


                      <?php 

                       }

                         } // end if br maker==me

                       if (($r['ho_authorize_status']!='1' or $r['ho_authorize_status']=='0') && !$r['canceled_by']) {

                         if ($r['br_checker_assign_manual_id']==Auth::user()->id  || $r['action_status_br_checker']=='1') {
                          
                         
                              if ($r['recheck_status']=='1') {
                                
                              
                            ?>

                              <button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
                          class="btn btn-warning btn-sm "  disabled  >Declined </button>
                              <?php 

                               }else{


                            ?>

                             <a type="button" style="width: 110px;" class="btn btn-info btn-sm" onclick="ho_authorize({{$r['request_id']}}, '{{$r['req_id']}}','{{$get_system_data->system_name}}' )" >Authorize</a>

                             <br>
                             <br>

                             <?php 

                               if ($r['br_checker_assign_manual_id']==Auth::user()->id) {
                                
                               
                             ?>  
                        <button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
                          class="btn btn-warning btn-sm "  onclick="decline({{$r['request_id'] }}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )"  >Decline </button>

                          <?php 
                           }

                         }

                       }

                        ?>


                     <br>
                   <br>

                    <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

                       <?php 

                        }
                      ?>
                      


                   </td>

               </tr>

              
                       

           @endforeach
         
           </tbody>
       </table>

       {{ $requests->appends(request()->input())->links() }}

   </div>

      
<!-- role 8 ends -->




 <!-- when role 6 (head checker) -->
@elseif(Auth::user()->role == 6 &&  Auth::user()->division_name == "IT Division")




 <!-- Modal -->
<div class="modal fade declineModal" id="" tabindex="-1" role="dialog" aria-labelledby="decline_all_label_IT" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="decline_all_label_IT">Decline Reason For These Request (IT Checker)
          (Inform to Request Maker)
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <textarea class="form-control decline_reason_all" name="decline_reason_all"  rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary br_checker_multiple_decline">Save changes</button>
      </div>
    </div>
  </div>
</div>



 <!-- Modal -->
<div class="modal fade decline_to_it_maker_Modal" id="" tabindex="-1" role="dialog" aria-labelledby="decline_all_label_IT_maker" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="decline_all_label_IT_maker">Decline Reason For These Request (IT Checker)
          (Inform to IT Maker)
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <textarea class="form-control it_checker_decline_reason_all" name="it_checker_decline_reason_all"  rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary it_checker_multiple_decline">Save changes</button>
      </div>
    </div>
  </div>
</div>


 <div class="double-scroll table-wrapper-scroll-y">


   


           <input type="hidden" name="br_checker_select_req_id" id="br_checker_select_req_id" value="">

       <!--   <input type="button" name="br_checker_multiple_authorize" class="btn btn-success br_checker_multiple_authorize"  value="Authorize All"> &nbsp; &nbsp; -->

         <input type="button" name="br_checker_multiple_decline_show_reason" class="btn btn-danger br_checker_multiple_decline_show_reason"  value="Decline All"   data-toggle="modal" data-target=".declineModal">

         &nbsp; &nbsp;

          <input type="button" name="it_checker_multiple_approve" class="btn btn-primary it_checker_multiple_approve"  value="Approve All"> &nbsp; &nbsp;

         <input type="button" name="it_checker_multiple_decline_show_reason" class="btn btn-warning it_checker_multiple_decline_show_reason"  value="Decline All"   data-toggle="modal" data-target=".decline_to_it_maker_Modal">

         <br> <br>


<table id=""  class="table table-striped table-hover" >
            <thead>
            <tr>
               <!-- <th scope="col" style="color: black">Authorize All <input type="checkbox" name="checkbox_all" 
                    class="checkbox_all"></th> -->

                     <th scope="col" style="color: black">Approve All <input type="checkbox" name="approve_checkbox_all" 
                    class="approve_checkbox_all"></th>

               <th scope="col" style="color: black">Serial</th>
                
               <th scope="col" style="color: black">Request Id</th>
               <th scope="col" style="color: black">Action</th>
               <th scope="col" style="color: black">Status</th>
              

                <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
               
                <th scope="col" style="color: black">Request Type</th> 
               
                  <th scope="col" style="color: black">Decline Reason</th>

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">Branch Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                

            </thead>
            <tbody>


                <?php 

                  $request_array = [];

                     foreach($requests as $request){

                    $request_array[$request->req_id] = [
                      "request_id" => $request->sl,
                      "req_id" => $request->req_id,
                      "system_id" => $request->sys_id,
                      "entry_date" => $request->br_checker_sts_update_date,
                      "request_type_system_id" => $request->rt_system_id,
                     
                      "status" => $request->status,
                      "action_status" => $request->action_status,
                      "recheck_status" => $request->recheck_status,
                      "pk_for_sub_br" => $request->pk_for_sub_br,
                      
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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }



                ?>
                
                 @php($i=1)
           @foreach($request_array as $r)


                <tr>



                  
                    <!--  multiple approve/ decline -->


                     <?php 

                    // echo $r['action_status_br_checker'].'----';
                    // echo "<br>";
                       

                      if ( (empty($r['action_status_ho_checker']) || $r['action_status_ho_checker']==NULL || $r['action_status_ho_checker']=='') &&  (!empty($r['action_status_br_checker'])) && (!empty($r['action_status_ho_maker']))) {
                              
                            

                        ?>
                       
                     <th style=""><input type="checkbox" name="it_checker_checkbox_single" value="{{ $r['request_id'] }}" class="it_checker_checkbox_single" onclick="it_checker_checkbox_single();"></th>

                     <?php
                        

                      }else{

                       
                        ?>

                        <th style=""><input type="checkbox"  disabled=""></th>
                        <?php
                      }
                     ?>

                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>




                   
                    <td>{{$r['req_id']}}</td>


                    
                    <td>


<?php 

  if ($r['br_maker'] == Auth::user()->id  && !$r['canceled_by']) {
   
  
?>
 <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

      echo "disabled";

   } 
   
   $request_type_system_id = $r['request_type_system_id'];
   if ($request_type_system_id) {
            
    $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

     $get_system_data->system_name;
}
   
   ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

       <br>
      <br>


<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>



<?php  

  } // end if $r['br_maker'] == Auth::user()->id

  if ($r['br_checker_assign_manual_id']==Auth::user()->id && !$r['canceled_by']) {
   
   if ($r['action_status_br_checker']=='1') {
?>

  <button style="width:105px;margin-top: 10px;" type="button" class="btn  btn-primary btn-sm " disabled > Authorized </button>

  <?php 


    }elseif($r['recheck_status']=='1'){
  ?>

      <button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
   class="btn btn-warning btn-sm "  disabled >Declined </button>
  
    <?php
      }else{

        $request_type_system_id = $r['request_type_system_id'];
          if ($request_type_system_id) {
            
              $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

               $get_system_data->system_name;
          }

        ?>

         <button style="width:105px;margin-top: 10px;" type="button" title="Authorize" onclick="authorize({{$r['request_id']}}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}')" class="btn btn-primary btn-sm"  >Authorize</button>

  <br>

    <button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
class="btn btn-warning btn-sm "  onclick="decline({{$r['request_id'] }}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )"  >Decline </button>


<br>
<br>


<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>


        <?php 
      }

    } // end if br_checker_assign_manual_id==me

    if ($r['br_maker'] != Auth::user()->id  && $r['br_checker_assign_manual_id']!=Auth::user()->id  && !$r['canceled_by']) {
       
    
     if ($r['action_status']!=7) {
        
      
      if ($r['action_status_ho_checker']=='5') {
         ?>
    
  <button class="btn btn-primary btn-sm" style="width: 105px;margin-top: 10px;" disabled>Approved</button>

  

  <?php

    }elseif($r['ho_checker']==''){

      if($r['status']==6){

      ?>

     

      

  <?php
      }else{

        $request_type_system_id = $r['request_type_system_id'];
          if ($request_type_system_id) {
            
              $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

               $get_system_data->system_name;
          }


          ?>

          <?php 

            if($r['action_status_ho_maker']=='4'){

            
        ?>
           <a type="button"  style="width: 105px;margin-top: 10px;" class="btn btn-primary btn-sm" onclick="request_approved({{$r['request_id']}}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}')" >Apporve</a>
          <?php 
            }
          ?>
          <?php


      }

    }
    ?>


<?php

if ($r['status']==6  ) {
?>


<button style="width: 105px;margin-top: 10px;background: #f35252" class="btn btn-warning btn-sm" disabled> Declined </button>

<?php

    }elseif($r['action_status'] !=7 && $r['action_status_ho_checker']!='5'){
      ?>

<?php 
  
  if($r['action_status_ho_maker']=='4'){

  ?>
       <a type="button" style="width: 105px;margin-top: 10px;background: #f35252" class="btn btn-warning btn-sm" onclick="request_decline_ho_ckr({{$r['request_id']}}, '{{$r['req_id']}}','{{$get_system_data->system_name}}' )" >Decline</a>
   <?php 
  
  } 
  
  ?>
      <br> <br>

       <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>



      <?php 

    }

}

}
    ?>


</td>

<td><?php 

$status = $r['status'];       
$action_status = $r['action_status'];               
$action_status_br_checker = $r['action_status_br_checker'];
$action_status_ho_maker = $r['action_status_ho_maker'];
$action_status_ho_checker = $r['action_status_ho_checker'];

if ($status=='7' &&  $action_status=='7') {
  echo "<span class='badge badge-danger'> Cancel </span>";

}elseif ($status=='6') {
  echo "<span class='badge badge-danger'> Decline </span>";

}elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

  echo "<span class='badge badge-warning'> Initiate </span>";

}elseif($status !='7' && $status =='0'  && ( $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-primary'> Processing </span>";

}elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-info'> Waiting For Authorization </span>";

}elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

  echo "<span class='badge badge-success'> Completed </span>";

}elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

  echo "<span class='badge badge-info'> On Hold </span>";

}

?> </td>



                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>   

                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;

                   //sub branch if exist
                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }
                    //sub branch if exist


                      ?>
                    </td>

                    <td style="color: black">
                      <?php  
                      $request_type_system_id = $r['request_type_system_id'];
                      if ($request_type_system_id) {
                        
                         $get_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;
                      }
                    

                       ?> 
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                      <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


                  

                    <td>{{ $r['ho_checker_comment'] }}</td>

                <td style="color: black">{{$r['user_name']}}</td>
              

                    <td><?php

                    $br_checker_id = $r['br_checker_assign_manual_id'];

                    if ($br_checker_id !='') {
                      $br_checker_data_count = DB::table('users')->where('id',$br_checker_id)->count();

                      if ($br_checker_data_count>0) {

                          $br_checker_data = DB::table('users')->where('id',$br_checker_id)->first();
                          echo $br_checker_data->name;

                      }else{
                        echo "";
                      }
                      

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                    <td>
                      
                      <?php

                        $ho_maker_id = $r['ho_maker'];

                        if ($ho_maker_id !="") {
                          
                           $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                           if ($it_maker_data_count>0) {

                            $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                            echo $it_maker_data->name;

                           }else{
                            echo "";
                           }
                          

                        }else{
                          echo "";
                        }
                        

                      ?>


                    </td>


                      <td>

                        <?php

                     $ho_checker_id = $r['ho_checker'];

                     if ($ho_checker_id !='' || $ho_checker_id!=NULL || $ho_checker_id!='0') {

                        $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                         if ($it_checker_data_count>0) {

                            $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                            echo $it_checker_data->name;

                         }else{
                          echo "";
                         }

                        //echo $it_checker_data->name;
                     }else{

                      echo "";
                     }
                    
                  
                    ?></td>

                    
                      <td style="color: black">{{$r['br_checker_recheck_reason']}}</td>


                </tr>
            @endforeach
          
          
            </tbody>
        </table>
         {{ $requests->appends(request()->input())->links() }}
    </div>


          <div class="modal fade halimmodal_decline_reason" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Decline Reason Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form action="{{ url('ho_chkr_decline_comment_submit') }}" method="POST" >

            <div class="modal-body">
              
             <input type="hidden" name="" id="hidden_id" >
             <input type="hidden" name="" id="request_id" >
             <input type="hidden" name="" id="decline_system_name" >
                
                <h4>Decline Reason</h4>
                <textarea id="comment" cols="60" rows="10" class="form-controll"></textarea>
             
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary update_decline_reason">Save changes</button>
            </div>

       </form>

    </div>
  </div>
</div>


<!-- role 6 ends -->




<!-- start role 9 (HO div maker) -->
    @elseif(Auth::user()->role == 9)

     <div class="double-scroll table-wrapper-scroll-y">
    <table id=""  class="table table-striped table-hover" >
            <thead>
            <tr>
               <th scope="col" style="color: black">Serial</th>
                
               <th scope="col" style="color: black">Request Id</th>

               <th scope="col" style="color: black">Action</th>
               <th scope="col" style="color: black">Status</th>

                <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
               
                <th scope="col" style="color: black">Request Type</th> 
                
                 

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">HO Div Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                

            </thead>
            <tbody>


                <?php 



        $request_array = [];
      foreach($requests as $request){

        $request_array[$request->req_id] = [
          "request_id" => $request->sl,
          "req_id" => $request->req_id,
          "system_id" => $request->sys_id,
          "entry_date" => $request->entry_date,
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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }
      
      ?>
                
                 @php($i=1)
           @foreach($request_array as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                    <td>

                        
<?php 

 if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){


  if($r['action_status'] !='7'){

 

?>
<button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

  echo "disabled";

} 

$request_type_system_id = $r['request_type_system_id'];

if ($request_type_system_id) {
  # code...

 $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

  $get_system_data->system_name;

} 

?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func_ho_div_checker('{{$r['request_id'] }}',
'{{$r['req_id'] }}','{{$get_system_data->system_name}}'   )">Assign Person</button>


  <a type="button"  style="margin-top: 10px;"  class="btn btn-danger btn-sm" onclick="cancel({{$r['request_id']}})">Cancel</a>


<?php

  if ($r['action_status_br_checker']==2 && $r['action_status'] !=7) {
     
  

?>

<!--  <a type="button" style="margin-top: 10px;" class="btn btn-primary btn-sm btnEditRowWithModal ">Edit</a>  -->



<?php
  }

}elseif ($r['action_status']==7) {
 

 ?>

  <button type="button" class="btn  btn-danger btn-sm " disabled > Canceled </button>

 <?php

}
}

?>



</td>


<td><?php 

$status = $r['status'];       
$action_status = $r['action_status'];               
$action_status_br_checker = $r['action_status_br_checker'];
$action_status_ho_maker = $r['action_status_ho_maker'];
$action_status_ho_checker = $r['action_status_ho_checker'];

if ($status=='7' &&  $action_status=='7') {
  echo "<span class='badge badge-danger'> Cancel </span>";

}elseif ($status=='6') {
  echo "<span class='badge badge-danger'> Decline </span>";

}elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

  echo "<span class='badge badge-warning'> Initiate </span>";

}elseif($status !='7' && $status =='0'  && ( $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-primary'> Processing </span>";

}elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-info'> Waiting For Authorization </span>";

}elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

  echo "<span class='badge badge-success'> Completed </span>";

}elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

  echo "<span class='badge badge-info'> On Hold </span>";

}

?> </td>

                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>    
                    
                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;

                      ?>
                    </td>

                    <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                      <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


       

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $ho_div_checker_id = $r['br_checker_assign_manual_id']; 

                    if ($ho_div_checker_id !='') {

                      $br_checker_count = DB::table('users')->where('id',$ho_div_checker_id)->count();

                      if ($br_checker_count>0) {

                        $br_checker_data = DB::table('users')->where('id',$ho_div_checker_id)->first();
                        echo $br_checker_data->name;

                      }else{

                        echo "";
                      }
                      

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                    <td>
                      
                      <?php

                        $ho_maker_id = $r['ho_maker'];

                        if ($ho_maker_id !="") {
                          
                           $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                           if ($it_maker_data_count>0) {

                               $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                               echo $it_maker_data->name;

                           }else{
                            echo  "";
                           }
                          

                        }else{
                          echo "";
                        }
                        

                      ?>


                    </td>


                      <td><?php

                     $ho_checker_id = $r['ho_checker'];

                     if ($ho_checker_id !='') {

                        $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                        if ($it_checker_data_count>0) {

                          $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                          echo $it_checker_data->name;

                        }else{
                          echo "";
                        }
                       
                     }else{

                      echo "";
                     }
                    
                  
                    ?></td>

                    
                     <td style="color: black">{{$r['br_checker_recheck_reason']}}</td>




                </tr>
            @endforeach
          
          
            </tbody>
        </table>

         {{ $requests->appends(request()->input())->links() }}

    </div>



      <div class="modal fade halimmodal_ho_div_checker_for_assign_person" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Assign Person </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_ho_div_checker_body_assign_person">
       
       
          
      </div>
    </div>
  </div>
</div>

<!-- end role 9 (HO div maker) -->


<!-- start role 10 (HO div Checker) -->

    @elseif(Auth::user()->role == 10)


     <!-- Modal -->
<div class="modal fade declineModal" id="" tabindex="-1" role="dialog" aria-labelledby="decline_all_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="decline_all_label">Decline Reason For These Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <textarea class="form-control decline_reason_all" name="decline_reason_all"  rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary br_checker_multiple_decline">Save changes</button>
      </div>
    </div>
  </div>
</div>

     <div class="double-scroll table-wrapper-scroll-y">

         <input type="hidden" name="br_checker_select_req_id" id="br_checker_select_req_id" value="">

         <input type="button" name="br_checker_multiple_authorize" class="btn btn-success br_checker_multiple_authorize"  value="Authorize All"> &nbsp; &nbsp;

         <input type="button" name="br_checker_multiple_decline_show_reason" class="btn btn-danger br_checker_multiple_decline_show_reason"  value="Decline All"   data-toggle="modal" data-target=".declineModal">

         <br> <br>

    <table id=""  class="table table-striped table-hover" >
            <thead>
            <tr>

                <th scope="col" style="color: black">All <input type="checkbox" name="checkbox_all" 
                    class="checkbox_all"></th>

               <th scope="col" style="color: black">Serial</th>
                
               <th scope="col" style="color: black">Request Id</th>

               <th scope="col" style="color: black">Action</th>
               <th scope="col" style="color: black">Status</th>


                 <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
               
                <th scope="col" style="color: black">Request Type</th> 
                
                 

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">HO Div Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
              

            </thead>
            <tbody>

                <?php 

                    $request_array=[];

                          foreach($requests as $request){

                $request_array[$request->req_id] = [
                  "request_id" => $request->sl,
                  "req_id" => $request->req_id,
                  "system_id" => $request->sys_id,
                  "entry_date" => $request->entry_date,
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
      
      foreach($request_array as $request){
        $request_array[$request["req_id"]]["final_operation_name"] = implode(",", $request_array[$request["req_id"]]["operation_name"]);
        $request_array[$request["req_id"]]["final_request_type"] = implode(",", $request_array[$request["req_id"]]["request_type"]);
      }


                ?>
                
                 @php($i=1)
           @foreach($request_array as $r)


                <tr>

                     <?php 

                    // echo $r['action_status_br_checker'].'----';
                    // echo "<br>";
                       

                            if ($r['br_checker_assign_manual_id'] == Auth::user()->id  && empty($r['action_status_br_checker'])  ) {
                              
                            

                        ?>
                       
                     <th style=""><input type="checkbox" name="checkbox_single" value="{{ $r['request_id'] }}" class="checkbox_single"></th>

                     <?php
                        

                      }else{

                       
                        ?>

                          <th style=""><input type="checkbox"  disabled=""></th>
                        <?php
                      }
                     ?>

                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                    <td>

<?php 

if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

if ($r['br_maker'] == Auth::user()->id) {


?>

<button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

   echo "disabled";

} 

$request_type_system_id = $r['request_type_system_id'];

    if ($request_type_system_id) {
      # code...
    
    $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

      $get_system_data->system_name;

  } 
?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

    <br>
   <br>



  <?php
}
}


if ($r['action_status_br_checker']==1 && Auth::user()->role == 10 ) {

?>



<button style="width:105px;margin-top: 10px;" type="button" class="btn  btn-primary btn-sm " disabled > Authorized </button>


<?php

}elseif($r['action_status']==7 && Auth::user()->role == 10){
?>


<button style="width:105px;margin-top: 10px;" type="button" class="btn  btn-warning btn-sm " disabled > Canceled </button>


<?php

}elseif($r['action_status_br_checker']!='1' && $r['action_status_br_checker']!='2' && $r['br_checker_assign_manual_id']==Auth::user()->id){



$request_type_system_id = $r['request_type_system_id'];

       if ($request_type_system_id) {
         # code...
       
        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

         $get_system_data->system_name;


       }

?>


<button style="width:105px;margin-top: 10px;" type="button" title="Authorize" onclick="authorize_ho_div_checker({{$r['request_id']}}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )" class="btn btn-primary btn-sm" >Authorize</button>



<button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
class="btn btn-warning btn-sm "  onclick="decline({{$r['request_id'] }}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )"  >Decline </button>


<?php


}
?>


<?php

if ($r['action_status_br_checker']==2 &&  Auth::user()->role == 10 ) {

?>

<button  style="width:105px;margin-top: 10px;background: #f35252;" type="button" class="btn  btn-warning btn-sm  btnEditRowWithModal" disabled > Declined </button>
<?php  
if (!$r['canceled_by']) {
?>



<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>


<?php
}

}elseif($r['action_status']!=7 && $r['action_status_br_checker']!=1){

?>

<br>
<br>

<button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>

<?php 

}elseif (($r['action_status_br_checker']!='1') && ($r['action_status'] !='7' || $r['status'] !='7')){


?>



<button style="width:105px;margin-top: 10px;background: #f35252" type="button" 
onclick="decline({{$r['request_id'] }}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}' )" class="btn btn-warning btn-sm"  >Decline </button>



<?php

}
?>


</td>



<td><?php 

$status = $r['status'];       
$action_status = $r['action_status'];               
$action_status_br_checker = $r['action_status_br_checker'];
$action_status_ho_maker = $r['action_status_ho_maker'];
$action_status_ho_checker = $r['action_status_ho_checker'];

if ($status=='7' &&  $action_status=='7') {
  echo "<span class='badge badge-danger'> Cancel </span>";

}elseif ($status=='6') {
  echo "<span class='badge badge-danger'> Decline </span>";

}elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

  echo "<span class='badge badge-warning'> Initiate </span>";

}elseif($status !='7' && $status =='0'  && (  $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-primary'> Processing </span>";

}elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-info'> Waiting For Authorization </span>";

}elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

  echo "<span class='badge badge-success'> Completed </span>";

}elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

  echo "<span class='badge badge-info'> On Hold </span>";

}

?> </td>


                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>    

                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;

                      ?>
                    </td>

                    <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                      <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


      

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $ho_div_checker_id = $r['br_checker_assign_manual_id']; 

                    if ($ho_div_checker_id !='') {
                      $br_checker_data_count = DB::table('users')->where('id',$ho_div_checker_id)->count();

                      if ($br_checker_data_count>0) {

                        $br_checker_data = DB::table('users')->where('id',$ho_div_checker_id)->first();
                        echo $br_checker_data->name;

                      }else{
                        echo "";
                      }
                      

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                    <td>
                      
                      <?php

                        $ho_maker_id = $r['ho_maker'];

                        if ($ho_maker_id !="") {
                          
                           $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();
                           if ($it_maker_data_count >0) {

                             $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                             echo $it_maker_data->name;

                           }else{
                              echo "";
                           }
                          

                        }else{
                          echo "";
                        }
                        

                      ?>


                    </td>


                      <td><?php

                     $ho_checker_id = $r['ho_checker'];

                     if ($ho_checker_id !='') {

                        $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                        if ($it_checker_data_count>0) {
                           $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                            echo $it_checker_data->name;

                        }else{
                          echo "";
                        }
                       
                     }else{

                      echo "";
                     }
                    
                  
                    ?></td>

                    
                     <td style="color: black">{{$r['br_checker_recheck_reason']}}</td>



                </tr>
            @endforeach
          
          
            </tbody>
        </table>

         {{ $requests->appends(request()->input())->links() }}

    </div>

      <!--   end role=10 HO Div Checker -->


      <!-- start role 11 (Super Admin) -->

    @elseif(Auth::user()->role == 11)

    

     <div class="double-scroll table-wrapper-scroll-y">
    <table id=""  class="table table-striped table-hover" >
            <thead>
            <tr>
               <th scope="col" style="color: black">Serial</th>
                
               <th scope="col" style="color: black">Request Id</th>
                 <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
               
                <th scope="col" style="color: black">Request Type</th> 
                <th scope="col" style="color: black">Status</th>
                 

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">HO Div Checker</th>
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>

               
                 <th scope="col" style="color: black">Action (Branch Checker)</th>
                 <th scope="col" style="color: black">Action (IT Checker)</th>

            </thead>
            <tbody>


              <?php

               $request_array = [];

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
                      "pk_for_sub_br" => $request->pk_for_sub_br,

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

               ?>
                
                 @php($i=1)
           @foreach($request_array as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                   <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>    

                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];
                        


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;


                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }

                      ?>
                    </td>



                    <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                      <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


                    




                    <td><?php 
                    
                    $status = $r['status'];       
                    $action_status = $r['action_status'];               
                    $action_status_br_checker = $r['action_status_br_checker'];
                    $action_status_ho_maker = $r['action_status_ho_maker'];
                    $action_status_ho_checker = $r['action_status_ho_checker'];
                    
                    if ($status=='7' &&  $action_status=='7') {
                      echo "<span class='badge badge-danger'> Cancel </span>";

                  }elseif ($status=='6') {
                      echo "<span class='badge badge-danger'> Decline </span>";

                  }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL)  && $action_status_ho_maker !='3'){

                      echo "<span class='badge badge-warning'> Initiate </span>";

                  }elseif($status !='7' && $status =='0'  && (  $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

                    echo "<span class='badge badge-primary'> Processing </span>";
         
                  }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

                      echo "<span class='badge badge-info'> Waiting For Authorization </span>";

                  }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

                      echo "<span class='badge badge-success'> Completed </span>";

                  }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

                      echo "<span class='badge badge-info'> On Hold </span>";

                  }

                    ?> </td>

                 

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $ho_div_checker_id = $r['br_checker_assign_manual_id']; 

                    if ($ho_div_checker_id !='') {
                      $br_checker_data_count = DB::table('users')->where('id',$ho_div_checker_id)->count();
                        
                        if ($br_checker_data_count>0) {

                          $br_checker_data = DB::table('users')->where('id',$ho_div_checker_id)->first();
                           echo $br_checker_data->name;

                        }else{
                          echo "";
                        }
                     

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                    <td>
                      
                      <?php

                        $ho_maker_id = $r['ho_maker'];

                        if ($ho_maker_id !="") {
                          
                           $it_maker_data_count = DB::table('users')->where('id',$ho_maker_id)->count();

                           if ($it_maker_data_count) {

                              $it_maker_data = DB::table('users')->where('id',$ho_maker_id)->first();
                              echo $it_maker_data->name;

                           }else{
                            echo "";
                           }
                          

                        }else{
                          echo "";
                        }
                        

                      ?>


                    </td>


                      <td>
                        <?php

                     $ho_checker_id = $r['ho_checker'];

                     if ($ho_checker_id !='') {

                        $it_checker_data_count = DB::table('users')->where('id',$ho_checker_id)->count();

                        if ($it_checker_data_count >0) {
                         
                          $it_checker_data = DB::table('users')->where('id',$ho_checker_id)->first();
                          echo $it_checker_data->name;

                        }else{
                          echo "";
                        }
                        
                     }else{

                      echo "";
                     }
                    
                  
                    ?></td>

                    

                     <td> </td>

                     <td></td>
                    

                </tr>
            @endforeach
          
          
            </tbody>
        </table>

         {{ $requests->appends(request()->input())->links() }}
    </div>

      <!--   end role=11 Super Admin -->






      <!-- start role 12 ( Admin) -->

    @elseif(Auth::user()->role == 12)

     <div class="double-scroll table-wrapper-scroll-y">
    <table id=""  class="table table-striped table-hover" >
            <thead>
            <tr>
               <th scope="col" style="color: black">Serial</th>
                
               <th scope="col" style="color: black">Request Id</th>
                 <th scope="col" style="color: black">Request Entry Date & Time</th>

                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Details</th>
               
                <th scope="col" style="color: black">Request Type</th> 
                <th scope="col" style="color: black">Status</th>
                 

                 <th scope="col" style="color: black">Request From</th>
                <th scope="col" style="color: black">Checker</th>
               <th>Release</th>

            </thead>
            <tbody>
                

                <?php

                 $request_array = [];

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
                              "br_maker" => $request->br_maker,
                              "br_checker" => $request->br_checker,
                              "ho_checker_comment" => $request->ho_checker_comment,
                              "ho_maker" => $request->ho_maker,
                              "ho_checker" => $request->ho_checker,
                              "branch_code" => $request->branch_code,
                              "system_name" => $request->system_name,
                              "input_value" => $request->system_name,
                              "pk_for_sub_br" => $request->pk_for_sub_br,
                              "operation_name" => [],
                              "para_list" => [

                              ],
                              "request_type" => [],
                            ];
                          }

                          file_put_contents('masdf.txt', json_encode($request_array));
                          
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
      

                ?>

                 @php($i=1)
           @foreach($request_array as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                  <td><?php if(!empty($r['entry_date'])){

                        echo date('d F, Y h:i:s A', strtotime($r['entry_date']));

                        }else{
                        echo '--';
                        }  ?>

                        </td>   

                    <td style="color: black">
                      
                      <?php

                         $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;


                   //sub branch if exist
                    $pk_for_sub_br = $r['pk_for_sub_br'];

                    if ($pk_for_sub_br) {

                      $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();
                     
                     echo "<span style='color: red;'>  ( $get_sub_branch_data->name )</span>";
                    
                    }
                    //sub branch

                      ?>
                    </td>

                   <td style="color: black">
                      <?php

                       $request_type_system_id = $r['request_type_system_id'];

                       if ($request_type_system_id) {
                         # code...
                       
                        $get_system_data =  DB::table('systems')->where('id',$request_type_system_id)->first();

                        echo $get_system_data->system_name;

                      } 
                       ?>
                       
                    </td>
                    
                    <td style="color: black">
                        <button onclick="show_para_list({{ $r['request_id'] }}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" class="btn btn-info btn-sm">Show Details</button>
                    </td>

                  

                   

                      <td style="color: black">
                        <?php 

                        $final_request_type_exp = explode(',', $r['final_request_type']);

                        echo $final_request_type_exp[0];
                       

                        ?>
                    </td>


                    




                    <td><?php 

$status = $r['status'];       
$action_status = $r['action_status'];               
$action_status_br_checker = $r['action_status_br_checker'];
$action_status_ho_maker = $r['action_status_ho_maker'];
$action_status_ho_checker = $r['action_status_ho_checker'];

if ($status=='7' &&  $action_status=='7') {
  echo "<span class='badge badge-danger'> Cancel </span>";

}elseif ($status=='6') {
  echo "<span class='badge badge-danger'> Decline </span>";

}elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3' ){

  echo "<span class='badge badge-warning'> Initiate </span>";

}elseif($status !='7' && $status =='0'  && ( $action_status_ho_maker=='3' || $action_status_ho_maker !='4') && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-primary'> Processing </span>";

}elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

  echo "<span class='badge badge-info'> Waiting For Authorization </span>";

}elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

  echo "<span class='badge badge-success'> Completed </span>";

}elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

  echo "<span class='badge badge-info'> On Hold </span>";

}

                    ?> </td>

                 

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $ho_div_checker_id = $r['br_checker_assign_manual_id']; 

                    if ($ho_div_checker_id !='') {
                      $br_checker_data_count = DB::table('users')->where('id',$ho_div_checker_id)->count();

                      if ($br_checker_data_count>0) {

                         $br_checker_data = DB::table('users')->where('id',$ho_div_checker_id)->first();
                         echo $br_checker_data->name;

                      }else{
                        echo "";
                      }
                      

                    }else{
                      echo "";
                    }
                  

                    ?></td>
                   
                  

                   <td>

                    <button class="btn btn-primary btn-sm" onclick="release_prev_state('{{$r['request_id']}}','{{$r['req_id']}}')">Relase</button>
                  </td>


                    

                    


                </tr>
            @endforeach
          
          
            </tbody>
        </table>

          {{ $requests->appends(request()->input())->links() }}
    </div>

      <!--   end role=12  Admin -->

<!-- when role 5 (branch checker) -->
@else

 <div class="ibox">
     <div class="ibox-title">
        <h5>No Data Found</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#" class="dropdown-item">Config option 1</a>
                </li>
                <li><a href="#" class="dropdown-item">Config option 2</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>

    <div class="ibox-content">
        <h4 class="text-center">Only IT Division User Will View All Requests</h4>
    </div>
 </div>


<!-- role 5 ends -->


@endif


  <div class="modal fade halimmodal_for_assign_person" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Assign Person </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_body_assign_person">
       
       
          
      </div>
    </div>
  </div>
</div>

 


 <div class="modal fade halimmodal_for_show_details" id="request_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"> <b> Show Details </b></h4>


         <button style="margin-left: 15px;" id="btnPrint" type="button" class="btn btn-primary">Print</button>

        <button type="button"  class="close modal_close halim_close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

       
       

      </div>
      <div  id="printThis">

          <div class="modal_body_parameter_list"></div>
      </div>
      
    </div>
  </div>
</div>



          <div class="modal fade halimmodal_cancel_reason" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Cancel Reason</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <form action="" method="POST" >

            <div class="modal-body">
              
             <input type="hidden" name="" id="hidden_cancel_id" >
             
                
                <h4>Cancel Reason</h4>
                <textarea id="cancel_reason" cols="60" rows="10" class="form-controll"></textarea>
             
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary cancel_reason_submit">Save changes</button>
            </div>

       </form>

    </div>
  </div>
</div>



<!-- Recheck modal start -->

 <div class="modal fade br_recheck" id="br_recheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Decline Reason (Request Checker)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body_br_recheck">
       
       <input type="hidden" name="reason_sl" id="reason_sl" value="">
       <input type="hidden" name="reason_request_id" id="reason_request_id" value="">
       <input type="text" name="system_name_recheck" id="system_name_recheck" class="form-control" value="">

       <h4 style="margin-left:28px;">Decline Reason (Request Checker) : </h4>

       <textarea id="br_checker_decline_reason" style="margin-left:28px;"  name="br_checker_decline_reason"
        class="form-controll" cols="60" rows="10" ></textarea>
       
          
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary br_checker_decline_reason_submit" >Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>







   @endsection('content')




   @section('js')



   <!-- loader script -->
<script type="text/javascript">
        $(function(){
            setTimeout(()=>{
                $(".loader").fadeOut(500);
            },1000)
        });




    </script>
<!-- loader script ends -->


<!-- script begins for branch maker (role 1) -->

  <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
    $(".btnEditRowWithModal").click(function(e) {
               
        


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
        var row_id = $(this).closest('tr').find('.slNo').data('row_id');

        

        var formData = {
            row_id: row_id
        };
        $.ajax({
            type: 'POST',
            url: "{{ url('branch_maker_edit') }}",
            data: formData,
            success: function(data) {

                
                $('.halimmodal').modal('show');
                $('.modal-body').html(data.html);

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });

    }); // end -:- Edit Event Using Modal.


   </script> 


  <script type="text/javascript">




    function assign_person_func(id, req_id, system_name, final_request_type){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

         var formData = {
                id:id,
                req_id:req_id,
                system_name:system_name,
                final_request_type:final_request_type,
            };

          // alert(req_id);return false;

            $("#hidden_id_assign").val(id);
           
           


              $.ajax({
            type: 'POST',
            url: "{{ url('assign_person_url') }}",
            data: formData,

             beforeSend: function() {
                   jQuery(".loader").show();
                },

            success: function(data) {

                
                $('.halimmodal_for_assign_person').modal('show');
                $('.modal_body_assign_person').html(data.html);

            },
            error: function(response) {
                alert(response);
                console.log(response);
            },

            complete: function() {

                     jQuery(".loader").hide();
                }


        });

             
    } // end assign person function

    function assign_person_func_ho_div_checker(id, req_id, system_name, final_request_type){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

         var formData = {
                id:id,
                req_id:req_id,
                system_name:system_name,
                final_request_type:final_request_type,
            };

          // alert(req_id);return false;

            $("#hidden_id_assign").val(id);
           
           


              $.ajax({
            type: 'POST',
            url: "{{ url('assign_person_url') }}",
            data: formData,
            success: function(data) {

                
                $('.halimmodal_ho_div_checker_for_assign_person').modal('show');
                $('.modal_ho_div_checker_body_assign_person').html(data.html);

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });

             
    }


   </script> 


    <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 

   function updateAssaignPerson(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

           cuteAlert({

          type: "question",
          title: "Do You Want To Assign This Person ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

             var usr = $("#user_manual_id").val();


            var hidden_id_assign = $("#hidden_id_assign").val();
            var hidden_request_id = $("#hidden_request_id").val();

          

            var formData = {
                usr: usr,
                hidden_id_assign: hidden_id_assign,
                hidden_request_id: hidden_request_id,
               
            };

              $.ajax({
                type: 'POST',
                url: "{{ url('assign_person') }}",
                data: formData,

                 beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {

                    
                  $('.halimmodal_for_assign_person').modal('hide');

                 cuteAlert({
                      type: "success",
                      title: "Successfully Assigned ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });

                },
                error: function(response) {
                    alert(response);
                    console.log(response);

                },

                 complete: function() {

                     jQuery(".loader").hide();
                }

            });

       

       


        } else {

                cuteToast({
                  type: "warning", // or 'info', 'error', 'warning'
                  message: "Canceled ",
                  timer: 10000
                });
          }


        })
       
       


   }




   </script> 

<!-- branch maker (role 1) script ends -->





   


<!-- script begins for head maker (role 2) -->





  <script type="text/javascript">
    
   
    //  it maaker

     function request_accept(id, req_id, system_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        

        cuteAlert({
          type: "question",
          title: "Do You Want To Accept This Request ",
          message: "",
          confirmText: "Accept",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

             var formData = {
                id:id,
                req_id:req_id,
                system_id:system_id,
            };


              $.ajax({
            type: 'POST',
            url: "{{ url('ho_maker_accept') }}",
            data: formData,
            success: function(data) {
              

                 // cuteToast({

                 //          type: "success", // or 'info', 'error', 'warning'
                 //          message: "Request Accept Successfully ! ",
                 //          timer: 10000
                 //        });
                 if (data) {


                    cuteAlert({
                      type: "warning",
                      title: "This Request Already Accepted By "+data,
                      message: "",
                      buttonText: "Okay"
                    })

                  

                  }else{

                    

                    cuteAlert({
                      type: "success",
                      title: "Request Accepted Successfully ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);
                         return false;

                    });

                  }



             
            },
            error: function(response) {
               

                cuteAlert({
                      type: "warning",
                      title: "Request Accept failed ! ",
                      message: "",
                       timer: 10000
                    });

                console.log(response);
            }
        });


        } else {

          
               cuteAlert({
                  type: "warning",
                  title: "Cancel",
                  message: "",
                  timer: 10000
                })

          }

        })


         
        
    }


     //  it maaker

   </script> 


    <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
  function EditModal_ho_maker_change_status(request_sl, req_id, system_name, final_request_type,ho_maker_remarks){
               


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

       
        var formData = {

            request_sl: request_sl,
            request_id: req_id,
            system_name: system_name,
            final_request_type: final_request_type,
            ho_maker_remarks: ho_maker_remarks,
        };

        $.ajax({
            type: 'POST',
            url: "{{ url('ho_maker_change_status') }}",
            data: formData,
            success: function(data) {

              //alert(data.length);

                if (data.length>0) {


                    cuteAlert({
                      type: "warning",
                      title: "This Request Already Accepted By "+data,
                      message: "",
                      buttonText: "Okay"
                    })

                  

                  }else{

                     $('.halimmodal').modal('show');
                     $('.modal-body').html(data.html);

                  }
               

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });

    } // end -:- Edit Event Using Modal.


   </script> 



   <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
    $(".update").click(function(e) {
               


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
       
        cuteAlert({
          type: "question",
          title: "Do You Want To Change Status ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var hidden_id = $("#hidden_id").val();
            
            var change_status = $("#change_status").val();
            var req_id = $("#req_id").val();
           
            var user_id = $("#user_id").val();
            var user_password = $("#user_password").val();
            var reset_password = $("#reset_password").val();
            var ho_maker_remarks = $("#ho_maker_remarks").val();
            var system_name = $("#system_name").val();

             var formData = {
          
                hidden_id: hidden_id,
                change_status: change_status,
                req_id: req_id,
                user_id: user_id,
                user_password: user_password,
                reset_password: reset_password,
                ho_maker_remarks: ho_maker_remarks,
                system_name: system_name,

            };


             $.ajax({
            type: 'POST',
            url: "{{ route('ho_maker_change_status_submit') }}",
            data: formData,

             beforeSend: function() {
                   jQuery(".loader").show();
                },
            success: function(data) {


                  $(".halimmodal").modal("hide");

               cuteAlert({
                      type: "success",
                      title: "Status updated Successfully ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{



                         location.reload();

                    });


            

            },
            error: function(response) {
                
                console.log(response);
                 cuteToast({

                      type: "warning", // or 'info', 'error', 'warning'
                      message: "Status updated failed ",
                      timer: 10000
                    });

            }
        });

       



        } else {

            cuteToast({
                  type: "warning", // or 'info', 'error', 'warning'
                  message: "Canceled ",
                  timer: 10000
                });

          }
        })

       

      
       


       

        
    }); 


   </script> 

<!-- head maker (role 2) script ends -->





<!-- script begins for head checker (role 6) -->
<script type="text/javascript">
    
     function request_approved(id, req_id, system_name){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        
        cuteAlert({
          type: "question",
          title: "Do You Want To Apporved ? ",
          message: "",
          confirmText: "Apporve",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var formData = {
                id:id,
                req_id:req_id,
                system_name:system_name,
            };


               $.ajax({
            type: 'POST',
            url: "{{ url('ho_checker_approved') }}",
            data: formData,
             beforeSend: function() {
                   jQuery(".loader").show();
                },

            success: function(data) {
            

                    // cuteToast({

                    //       type: "success", // or 'info', 'error', 'warning'
                    //       message: "Request Apporved Successfully",
                    //       timer: 10000
                    //     });

                    cuteAlert({
                      type: "success",
                      title: "Request Apporved Successfully !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });



               
            },
            error: function(response) {
              
                console.log(response);
                cuteToast({

                          type: "warning", // or 'info', 'error', 'warning'
                          message: "Request Not Apporved !",
                          timer: 10000
                        });


            },

             complete: function() {

                     jQuery(".loader").hide();
                }


        });



        } else {

             cuteAlert({
                  type: "warning",
                  title: "Cancel",
                  message: "",
                  timer: 10000
                })

          }
        })

            

            
        
    }



    function request_decline_ho_ckr(id, req_id, system_name){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });


       
              var comment = $("#comment").val();
            $("#hidden_id").val(id);
            $("#request_id").val(req_id);
            $("#decline_system_name").val(system_name);
          

              $('.halimmodal_decline_reason').modal('show');

            var formData = {
                id:id
            };

                  

    }

   </script> 


    <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
    $(".update_decline_reason").click(function(e) {
               

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
       
        
        cuteAlert({
          type: "question",
          title: "Do You Want To Decline ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

             var hidden_id = $("#hidden_id").val();
            var request_id = $("#request_id").val();
            var decline_system_name = $("#decline_system_name").val();

        
            var comment = $("#comment").val();


             var formData = {
              
                hidden_id: hidden_id,
                comment: comment,
                request_id: request_id,
                decline_system_name: decline_system_name,

            };

             $.ajax({
                type: 'POST',
                url: "{{ url('ho_chkr_decline_comment_submit') }}",
                data: formData,

                 beforeSend: function() {
                   jQuery(".loader").show();
                },


                success: function(data) {

                    
                 // alert('Successfully Assigned');
                  $('.halimmodal_decline_reason').modal('hide');

                 cuteAlert({
                      type: "success",
                      title: "Successfully Declined !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });


            
                },
                error: function(response) {
                    
                    console.log(response);

                    cuteToast({

                          type: "warning", // or 'info', 'error', 'warning'
                          message: "Declined failed",
                          timer: 10000
                        });

                },

                 complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
           
             cuteAlert({
                  type: "warning",
                  title: "Cancel",
                  message: "",
                  timer: 10000
                })

          }
        })

       


        
    }); 


   </script>
<!-- head checker (role 6) script ends -->



<!-- branch cheker -->
<script type="text/javascript">
  

     function authorize(id, req_id, system_name){

      

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Authorize ",
          message: "",
          confirmText: "Authorize",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                    req_id:req_id,
                    system_name:system_name
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('branch_checker_authorize') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Authorized Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Authorized failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }
        })

        

    } // end authorize function



    function decline(id, req_id, system_name){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $("#reason_sl").val(id);
        $("#reason_request_id").val(req_id);
        $("#system_name_recheck").val(system_name);

         $(".br_recheck").modal("show");

       
        
    }


    $(".br_checker_decline_reason_submit").click(function(){

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

      var sl = $("#reason_sl").val();
      var reason_request_id = $("#reason_request_id").val();
      var br_checker_decline_reason = $("#br_checker_decline_reason").val();
      var system_name_recheck = $("#system_name_recheck").val();

        if (br_checker_decline_reason=='') {

          cuteAlert({
            type: "warning",
            title: "Please, Give Recheck Reason",
            message: "",
            confirmText: "Okay",
            cancelText: "Cancel"
          });

          return false;

        }

          cuteAlert({
          type: "question",
          title: "Do You Want To Recheck",
          message: "",
          confirmText: "Recheck",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

             var formData = {
                    id:sl,
                    req_id:reason_request_id,
                    br_checker_decline_reason:br_checker_decline_reason,
                    system_name_recheck:system_name_recheck,
                };

                   $.ajax({

            type: 'POST',
            url: "{{ url('branch_checker_decline') }}",
            data: formData,


             beforeSend: function() {
                   jQuery(".loader").show();
                },

            success: function(data) {
              
                console.log(data);
               
              

                   cuteAlert({
                  type: "success",
                  title: "Recheck Successful !",
                  message: "",
                  buttonText: "Okay"
                }).then((e)=>{

                     location.reload();

                });


               
            },
            error: function(response) {
                

                     cuteAlert({
                      type: "warning",
                      title: "Recheck failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

            },

             complete: function() {

                     jQuery(".loader").hide();
                }


        });
   


        } else {

                cuteAlert({
                  type: "warning", // or 'info', 'error', 'warning'
                   title: "Cancel",
                  message: "",
                  timer: 10000
                });

          }

        })



    });
   



      function cancel(id){

        $("#hidden_cancel_id").val(id);
      
        $(".halimmodal_cancel_reason").modal("show");

    

    } // end cancel function

    $(".cancel_reason_submit").click(function(e){

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();

        var cancel_id = $("#hidden_cancel_id").val();
        var cancel_reason = $("#cancel_reason").val();

        if (cancel_reason=='') {
             cuteAlert({
            type: "warning",
            title: "Please, Give Cancel Reason ",
            message: "",
            confirmText: "Okay",
            cancelText: "Cancel"
          });


             return false;
        }

            cuteAlert({
          type: "question",
          title: "Do You Want To Cancel ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var formData = {
                id:cancel_id,
                cancel_reason:cancel_reason,
            };


             $.ajax({
            type: 'POST',
            url: "{{ url('cancel_reason_submit') }}",
            data: formData,
            success: function(data) {
              
                if (data) {
                    cuteAlert({
                    type: "warning",
                    title: "This Request Already Accepted By "+data,
                    message: "",
                    buttonText: "Okay"
                  });

                }else{

                     cuteAlert({
                    type: "success",
                    title: "Cancel Successful !",
                    message: "",
                    buttonText: "Okay"
                  }).then((e)=>{

                       location.reload();

                  });

                }
                
                

               // toastr.success("Cancel Successful");

               //alert('Cancel Successful');

              
            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });


        } else {

            cuteAlert({
                  type: "warning", // or 'info', 'error', 'warning'
                   title: "Cancel",
                  message: "",
                  timer: 10000
                });

          }
        })

    });


    function show_para_list(para_id, req_id, system_id){

      

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

       //req_id=String(req_id);

        var formData = {
            sl: para_id,
            request_id: req_id.trim(),
            system_id: system_id,
        };

         $('.halimmodal_for_show_details').modal('show');


         // $('#details_sl').val(para_id);

        $.ajax({
            type: 'POST',
            url: "{{ url('parameter_list_details') }}",
            data: formData,
            success: function(data) {

                console.log(data);

               $('.halimmodal_for_show_details').modal('show');
                 $('.modal_body_parameter_list').html(data.html);

            },
            error: function(response) {

                alert(response);
                console.log(response);
            }
        });


    }


    function ho_authorize(sl, req_id, system_name){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

       
            cuteAlert({
          type: "question",
          title: "Do You Want To Authorize ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var formData = {
                sl:sl,
                req_id:req_id,
                system_name:system_name,
            };


             $.ajax({
            type: 'POST',
            url: "{{ url('ho_authorize_submit') }}",
            data: formData,
            success: function(data) {
              
                console.log(data);
                
                 cuteAlert({
                  type: "success",
                  title: "Authorized Successful !",
                  message: "",
                  buttonText: "Okay"
                }).then((e)=>{

                     location.reload();

                });

               // toastr.success("Cancel Successful");

               //alert('Cancel Successful');

              
            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });


        } else {

            cuteAlert({
                  type: "warning", // or 'info', 'error', 'warning'
                   title: "Cancel",
                  message: "",
                  timer: 10000
                });

          }
        })

    }


    function ho_authorize_decline(sl, req_id){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

       
            cuteAlert({
          type: "question",
          title: "Do You Want To Decline ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var formData = {
                sl:sl,
                req_id:req_id,
            };


             $.ajax({
            type: 'POST',
            url: "{{ url('ho_authorize_decline_submit') }}",
            data: formData,
            success: function(data) {
              
                console.log(data);
                
                 cuteAlert({
                  type: "success",
                  title: "Declined Successful !",
                  message: "",
                  buttonText: "Okay"
                }).then((e)=>{

                     location.reload();

                });

               // toastr.success("Cancel Successful");

               //alert('Cancel Successful');

              
            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });


        } else {

            cuteAlert({
                  type: "warning", // or 'info', 'error', 'warning'
                   title: "Cancel",
                  message: "",
                  timer: 10000
                });

          }
        })

    }


    function release(sl, request_id){

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });


             cuteAlert({
          type: "question",
          title: "Do You Want To Release  ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{
          if ( e == ("confirm")){

            var formData = {
                sl:sl,
                request_id:request_id,
            };


             $.ajax({
            type: 'POST',
            url: "{{ url('ho_release_submit') }}",
            data: formData,
            success: function(data) {
              
                console.log(data);
                
                 cuteAlert({
                  type: "success",
                  title: "Released Successful !",
                  message: "",
                  buttonText: "Okay"
                }).then((e)=>{

                     location.reload();

                });

               // toastr.success("Cancel Successful");

               //alert('Cancel Successful');

              
            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });


        } else {

            cuteAlert({
                  type: "warning", // or 'info', 'error', 'warning'
                   title: "Cancel",
                  message: "",
                  timer: 10000
                });

          }

        })


    }




    function authorize_ho_div_checker(id, req_id, system_name){



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Authorize ",
          message: "",
          confirmText: "Authorize",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                    req_id:req_id,
                    system_name:system_name,
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('ho_div_checker_authorize') }}",
                data: formData,

                 beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Authorized Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Authorized failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                 complete: function() {

                     jQuery(".loader").hide();
                }
            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }
        })

    } // end function


  
 
   function release_prev_state(id, req_id){



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Release IT ",
          message: "",
          confirmText: "Yes",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                    req_id:req_id,
                  
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('ho_release_authorize') }}",
                data: formData,

                 beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Released Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                 complete: function() {

                     jQuery(".loader").hide();
                }
            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }
        })

    } // end function


   
    $(".it_checker_multiple_approve").hide();
    $(".it_checker_multiple_decline_show_reason").hide();

    $(".approve_checkbox_all").on("click", function(){


      var status=$(".approve_checkbox_all").prop("checked");

        $(".it_checker_checkbox_single").prop("checked", status);

        if (status==true) {
                $(".it_checker_multiple_approve").show();
                $(".it_checker_multiple_decline_show_reason").show();
        }else{
            $(".it_checker_multiple_approve").hide();
            $(".it_checker_multiple_decline_show_reason").hide();
        }


    });


   

function it_checker_checkbox_single(){

         

            if ($('input.it_checker_checkbox_single').is(':checked')) 
            {
                $(".it_checker_multiple_approve").show();
                $(".it_checker_multiple_decline_show_reason").show();
            }else{

                $(".it_checker_multiple_approve").hide();
                $(".it_checker_multiple_decline_show_reason").hide();

            }

}








    // for request checker

     $(".br_checker_multiple_authorize").hide();
    $(".br_checker_multiple_decline_show_reason").hide();


    $(".checkbox_all").on("click", function(){
        
        var status=$(".checkbox_all").prop("checked");

        $(".checkbox_single").prop("checked", status);

        if (status==true) {
                $(".br_checker_multiple_authorize").show();
                $(".br_checker_multiple_decline_show_reason").show();
        }else{
            $(".br_checker_multiple_authorize").hide();
            $(".br_checker_multiple_decline_show_reason").hide();
        }




    });


  

    $(".checkbox_single").on("click", function(){

           
             if ($('input.checkbox_single').is(':checked')) 
            {
                $(".br_checker_multiple_authorize").show();
                $(".br_checker_multiple_decline_show_reason").show();
            }else{

                $(".br_checker_multiple_authorize").hide();
                $(".br_checker_multiple_decline_show_reason").hide();

            }


           // alert(status);
        // $(".br_checker_multiple_authorize").show();
    });



    $(".br_checker_multiple_authorize").on("click", function(){

          // var br_checker_single_checkbox_sl =  $("#br_checker_select_req_id").val();
          // alert(br_checker_single_checkbox_sl);

          all_sl=[];
          $('input[name="checkbox_single"]:checked').each(function() {
               //console.log(this.value);

               all_sl.push($(this).val());

            });

         var join_sl_with_coma = all_sl.join(",");
          // alert("My favourite sports are: " + all_sl.join(", "));

          $("#br_checker_select_req_id").val(join_sl_with_coma);



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Authorize These",
          message: "",
          confirmText: "Authorize",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    join_sl_with_coma:join_sl_with_coma
                    
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('branch_checker_authorize_all') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Authorized Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Authorized failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }
        })



    });  // end branch Checker Authorize all


    






    $(".br_checker_multiple_decline").on("click", function(){

          // var br_checker_single_checkbox_sl =  $("#br_checker_select_req_id").val();
          // alert(br_checker_single_checkbox_sl);

          all_sl=[];
          $('input[name="checkbox_single"]:checked').each(function() {
               //console.log(this.value);

               all_sl.push($(this).val());

            });

         var join_sl_with_coma = all_sl.join(",");

         var decline_reason_all = $(".decline_reason_all").val();
          // alert(decline_reason_all);
          // alert(join_sl_with_coma);return false;

          $("#br_checker_select_req_id").val(join_sl_with_coma);



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Decline These",
          message: "",
          confirmText: "Yes",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    join_sl_with_coma:join_sl_with_coma,
                    decline_reason_all:decline_reason_all
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('branch_checker_decline_all') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Decline Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Decline failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }
        })



    });



    $(".it_checker_multiple_decline").on("click", function(){

        all_sl=[];
          $('input[name="it_checker_checkbox_single"]:checked').each(function() {
               //console.log(this.value);

               all_sl.push($(this).val());

            });

         var join_sl_with_coma = all_sl.join(",");

         var it_checker_decline_reason_all = $(".it_checker_decline_reason_all").val();
          // alert(it_checker_decline_reason_all);
          // alert(join_sl_with_coma);return false;

          $("#br_checker_select_req_id").val(join_sl_with_coma);





            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Decline These",
          message: "",
          confirmText: "Yes",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    join_sl_with_coma:join_sl_with_coma,
                    it_checker_decline_reason_all:it_checker_decline_reason_all
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('it_checker_decline_all') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Decline Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Decline failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }

        })



    });



    $(".it_checker_multiple_approve").on("click", function(){

          all_sl=[];
          $('input[name="it_checker_checkbox_single"]:checked').each(function() {
               

               all_sl.push($(this).val());

            });



         var join_sl_with_coma = all_sl.join(",");

       
         // alert(join_sl_with_coma);return false;

          $("#br_checker_select_req_id").val(join_sl_with_coma);



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });





            cuteAlert({
          type: "question",
          title: "Do You Want To Approve These",
          message: "",
          confirmText: "Approve",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    join_sl_with_coma:join_sl_with_coma
                    
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('it_checker_approve_all') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Approved Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Approve failed !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })

                },

                complete: function() {

                     jQuery(".loader").hide();
                }

            });


        } else {
                    cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });
          }


        })


    });


</script>



<!--end  branch cheker script-->


<script>
        function printDiv() {

          

            var divContents = document.getElementById("print_data").innerHTML;
          //  var a = window.open("","", 'top=100,left=100,height=500, width=1000');
            
            pop(divContents);

              // var originalContents = document.body.innerHTML;
              // document.body.innerHTML = divContents;
              // window.print();
              // document.body.innerHTML = originalContents;
              // $(".halimmodal_for_show_details").modal('hide');


            // a.document.write(divContents);
          
            // a.document.close();
            // a.print();

            //$('.print_close').show();
            //$('.modal_close').hide();
        }
    </script>


    <script type="text/javascript">
     document.getElementById("btnPrint").onclick = function () {
          printElement(document.getElementById("printThis"));
      }

      function printElement(elem) {
          var domClone = elem.cloneNode(true);
          
          var $printSection = document.getElementById("printThis");
          console.log($printSection);
          
          if (!$printSection) {
              var $printSection = document.createElement("div");
              $printSection.id = "printSection";
              document.body.appendChild($printSection);
          }
          
          $printSection.innerHTML = "";
          $printSection.appendChild(domClone);
          window.print();
      }
    </script>



<?php 

if(Auth::user()->role=='1'  || Auth::user()->role=='9' ){

?>

<script>

  $(".search_btn").on("click", function(){
    
    var request_id = $('#req_id').val();
    var branch_code = $('#branch_code').val();
  
    var module_name = $('#module_name').val();
    var request_type_name = $('#request_type_name').val();
    var search_status = $('#search_status').val();
    var request_from = $('#request_from').val();
    var it_maker_search = $('#it_maker_search').val();
    var it_checker_search = $('#it_checker_search').val();

    if((request_id==''  && module_name=='' && request_type_name=='' && search_status=='')){
      alert('Please, Select at least One Option');
      return false;
    }
  });
 
</script>

<?php 

}
?>


<?php 

if(Auth::user()->role=='5'  || Auth::user()->role=='10' ){

?>

<script>

  $(".search_btn").on("click", function(){
    
    var request_id = $('#req_id').val();
    var branch_code = $('#branch_code').val();
  
    var module_name = $('#module_name').val();
    var request_type_name = $('#request_type_name').val();
    var search_status = $('#search_status').val();
    var request_from = $('#request_from').val();
    var it_maker_search = $('#it_maker_search').val();
    var it_checker_search = $('#it_checker_search').val();

    if((request_id==''  && module_name=='' && request_type_name=='' && search_status=='' && request_from=='')){
      alert('Please, Select at least One Option');
      return false;
    }
  });
 
</script>

<?php 

}
?>

<?php 

if(Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='11' || Auth::user()->role=='12'){

?>

<script>

  $(".search_btn").on("click", function(){
    
    var request_id = $('#req_id').val();
    var branch_code = $('#branch_code').val();
  
    var module_name = $('#module_name').val();
    var request_type_name = $('#request_type_name').val();
    var search_status = $('#search_status').val();
    var request_from = $('#request_from').val();
    var it_maker_search = $('#it_maker_search').val();
    var it_checker_search = $('#it_checker_search').val();

    if(request_id=='' && branch_code=='' && module_name=='' && request_type_name=='' && search_status=='' && request_from=='' && it_maker_search=='' && it_checker_search==''){
      alert('Please, Select at least One Option');
      return false;
    }
  });
 
</script>

<?php 

}
?>

<?php 

if(Auth::user()->role=='8' ){

?>

<script>

  $(".search_btn").on("click", function(){
    
    var request_id = $('#req_id').val();
    var branch_code = $('#branch_code').val();
  
    var module_name = $('#module_name').val();
    var request_type_name = $('#request_type_name').val();
    var search_status = $('#search_status').val();
    var request_from = $('#request_from').val();


    if(request_id=='' && branch_code=='' && module_name=='' && request_type_name=='' && search_status=='' && request_from=='' ){
      alert('Please, Select at least One Option');
      return false;
    }
  });
 
</script>

<?php 

}
?>

 @endsection