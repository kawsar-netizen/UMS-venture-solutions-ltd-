
@extends('master.master')


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

       
         @section('content')
<!-- loader part -->
   <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div>
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
    


                 

                    <div class="ibox " style="display: none;">
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


                          <form action="{{route('search_with_system_and_status')}}" method="POST" class="form-inline" >
                              @csrf
                              <div class="form-group row">

                                <label class="col-lg-6 col-form-label">System Name</label>

                                    <div class="col-lg-6">
                                       <select class="form-control select2" name="system_name" >
                                           <option value="all">All</option>
                                           <?php 
                                           $system_data = DB::table('systems')->get();
                                           foreach ($system_data as  $system_value) {
                                               
                                               ?>

                                               <option value="{{$system_value->id}}">{{$system_value->system_name}}</option>

                                               <?php
                                           }

                                           ?>
                                       </select>
                                    </div>

                                </div>


                                 <div class="form-group row" style=" margin-left: 90px;">

                                <label class="col-lg-6 col-form-label">Status</label>

                                    <div class="col-lg-6">
                                        <select class="form-control" name="status">
                                            <option value="all">All</option>
                                            <option value="0">Initiate</option>
                                            <option value="1">Processing</option>
                                            <option value="3">On Hold</option>
                                            <option value="2">Complete</option>
                                            <option value="7">Cancel</option>
                                        </select>
                                    </div>

                                </div>

                              <button type="submit" class="btn btn-info" style="margin-left:55px;">Search</button>
                            </form>

                        </div>
                   
            </div><!-- end data filter -->


           


 <!-- when role 1 (branch maker) -->
    @if(Auth::user()->role == 1)


    <div class="double-scroll table-wrapper-scroll-y">
        <table id="myTable"  class="table table-striped table-hover " width="100%">
            <thead>
                


            <tr>
                
                <th scope="col" style="color: black">Serial</th>
                <th scope="col" style="color: black">Request Id</th>
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

                <th scope="col" style="color: black">Status</th>
                <th scope="col" style="color: black">Action</th>
            </tr>
            </thead>
            <tbody class="filter_table">

            @php($i=1)
            @foreach($requests as $r)

                <tr>

                    

                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                    <td>{{$r['req_id']}}</td>
                    <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td>                    
                    <td style="color: black">{{$r['user_name']}}</td>
                    <td style="color: black"><?php


                   $branch_code = $r['branch_code'];


                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;

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
                    
                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3' ){

                        echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3' ){

                        echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif($r['status']==0 && $r['action_status']==2){

                      echo "<span class='badge badge-danger'>  Recheck </span>";

                    }elseif($r['status']==0 && $r['action_status']==7){

                      echo "<span class='badge badge-danger'>  Canceled </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-success'>  Complete </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==5 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==6) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 && $r['action_status']==7) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{
                         echo "<span class='badge badge-info'>  Waiting for Authorization </span>";
                    }   ?> </td>
                   

                     <td>

                        <?php 

                            if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

                           

                            if($r['action_status'] !='7'){

                           

                        ?>
                         <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

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

                </tr>

          @endforeach
            </tbody>
        </table>

    </div>
     


   
<!-- role 1 ends -->


<!-- when role 5 (branch checker ) -->
    @elseif(Auth::user()->role == 5)

     <div class="double-scroll table-wrapper-scroll-y">
        <table id="myTable"  class="table table-striped table-hover " >
            <thead>
            <tr>

                <th scope="col" style="color: black">All <input type="checkbox" name="checkbox_all" 
                    class="checkbox_all"></th>
                <th scope="col" style="color: black">Serial</th>
                 <th scope="col" style="color: black">Request Id</th>
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
                <th scope="col" style="color: black">Status</th>
                <th scope="col" style="color: black">Action</th>

            </thead>
            <tbody>

            @php($i=1)
            @foreach($br_checker as $r)

                <tr>

                     <th><input type="checkbox" name="checkbox_single" value="{{ $r['request_id'] }}" class="checkbox_single"></th>

                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                    <td>{{$r['req_id']}}</td>
                    <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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
                    
                    
                    <td><?php 

                   

                    if($r['status']==0){

                        echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif ($r['status']==0 && $r['action_status_ho_maker'] =='3') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-success'>  Complete </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==5 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                         echo "<span class='badge badge-info'>  Waiting for Authorization </span>";
                    }  ?> </td>
                   




                    


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

							 } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{ $get_system_data->system_name }}', '{{$r['final_request_type']}}')">Assign Person</button>

								 <br>
								<br>
								
								<?php 
									
									}
									
									if($r['br_checker_assign_manual_id'] == Auth::user()->id){
									
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

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

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

                </tr>

          @endforeach



            </tbody>


        </table>

        <input type="text" name="br_checker_select_req_id" id="br_checker_select_req_id" value="1,2,3">

         <input type="button" name="br_checker_multiple_authorize" class="btn btn-success br_checker_multiple_authorize"  value="Authorize All">

         <br> <br>
    </div>
       

    

<!-- end role 5 br checker -->


 <!-- when role 2 (head maker) -->
@elseif(Auth::user()->role == 2 &&  Auth::user()->division_name == "IT Division")

 <div class="double-scroll table-wrapper-scroll-y">
<table id="myTable"  class="table table-striped table-hover"  >
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

            </thead>
            <tbody>
            @php($i=1)
           @foreach($it_maker as $r)


           

                <tr >
                
                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                     <td>{{$r['req_id']}}</td>

                    <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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
                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                        echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker']=='3' ){

                        echo "<span class='badge badge-success'> Request Processing (HO Maker) </span>";

                    }elseif($r['status']=='1' && $r['action_status_ho_checker']=='5' ){

                       echo "<span class='badge badge-primary'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-success'>  Complete </span>";
                       
                    }elseif($r['status']==3 && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif($r['status']==4 && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif($r['status']==6){

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif($r['status']==7){

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";
                    }

                     ?> </td>

                    <td><?php  $ho_checker_comment = $r['ho_checker_comment'];

                        if ($ho_checker_comment) {
                            echo $ho_checker_comment;

                        }
                ?></td>

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $br_checker_id = $r['br_checker']; 

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

                    <td>


                      <?php 

                       if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

                        if ($r['br_maker'] == Auth::user()->id && !$r['canceled_by']) {
                         
                        
                      ?>
                      <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>
							
							
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


                          

                        <a type="button" style="width: 110px;" class="btn btn-info btn-sm" onclick="request_accept({{$r['request_id']}}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" >Request Accept</a>

                        <br> <br>

                        <?php
                            }elseif($r['ho_authorize_status']=='0' && $r['system_id']=='6' && in_array('Enhancement', $r['request_type'])){

                              echo "<button class='btn btn-warning btn-sm' disabled>Declined From Head Office Authorizer ! </button>";


                            }elseif($r['ho_authorize_status']!='1' && $r['system_id']=='6' && in_array('Enhancement', $r['request_type'])){

                              echo "<button class='btn btn-success btn-sm' disabled>Waiting For Head Office Authorizer !</button>";
                              echo "<br>";


                            }elseif($r['system_id']!='6' || ($r['system_id']=='6' &&  $r['request_type'][0]!='Enhancement' )){
                              ?>
                                <a type="button" style="width: 110px;" class="btn btn-info btn-sm" onclick="request_accept({{$r['request_id']}}, '{{$r['req_id']}}', '{{$r['request_type_system_id']}}' )" >Request Accept</a>

                                <?php

                            }

                          }

                      }

                        ?>

                     

                         <?php

                         if ($r['action_status']!=7) {
                            
                         
                    if($r['ho_maker'] ==Auth::user()->id and $r['action_status_ho_maker']!='' and $r['action_status_ho_checker']!='5') {
                       
                        
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

                </tr>

               
                        

            @endforeach
          
            </tbody>
        </table>

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
<table id="myTable"  class="table table-striped table-hover"  >
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
            @php($i=1)
           @foreach($ho_auth as $r)


           

                <tr >
                
                    <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                     <td>{{$r['req_id']}}</td>
                     <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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
                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                        echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']=='1' && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']=='2' && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-success'>  Completed </span>";
                       
                    }elseif($r['status']=='3' && $r['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif($r['status']==6){

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }else{
                        echo "<span class='badge badge-info'>  Waiting For Authorization </span>";
                    } ?> </td>

                    <td><?php  $ho_checker_comment = $r['ho_checker_comment'];

                        if ($ho_checker_comment) {
                            echo $ho_checker_comment;

                        }
                ?></td>

                <td style="color: black">{{$r['user_name']}}</td>

                    <td><?php

                    $br_checker_id = $r['br_checker']; 

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
    </div>

       
<!-- role 8 ends -->




 <!-- when role 6 (head checker) -->
@elseif(Auth::user()->role == 6 &&  Auth::user()->division_name == "IT Division")

 <div class="double-scroll table-wrapper-scroll-y">
<table id="myTable"  class="table table-striped table-hover" >
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
                <th scope="col" style="color: black">IT Maker</th>
                <th scope="col" style="color: black">IT Checker</th>
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                 <th scope="col" style="color: black">Action</th>

            </thead>
            <tbody>
                
                 @php($i=1)
           @foreach($it_checker as $r)
                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                   <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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


                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-info'>   Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-primary'> Waiting For <br> Authorization</span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-secondary'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 ) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";

                    } ?> </td>

                    <td>{{ $r['ho_checker_comment'] }}</td>

                <td style="color: black">{{$r['user_name']}}</td>
              

                    <td><?php

                    $br_checker_id = $r['br_checker']; 

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

                     <td>


                      <?php 

                        if ($r['br_maker'] == Auth::user()->id  && !$r['canceled_by']) {
                         
                        
                      ?>
                       <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

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

                                ?>

                                 <a type="button"  style="width: 105px;margin-top: 10px;" class="btn btn-primary btn-sm" onclick="request_approved({{$r['request_id']}}, '{{$r['req_id']}}', '{{$get_system_data->system_name}}')" >Apporve</a>

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

                             <a type="button" style="width: 105px;margin-top: 10px;background: #f35252" class="btn btn-warning btn-sm" onclick="request_decline_ho_ckr({{$r['request_id']}}, '{{$r['req_id']}}','{{$get_system_data->system_name}}' )" >Decline</a>

                            <br> <br>

                             <button type="button" class="btn  btn-danger btn-sm " onclick="cancel({{$r['request_id']}})" > Cancel </button>



                            <?php 

                          }

                      }

                  }
                          ?>


                    </td>

                </tr>
            @endforeach
          
          
            </tbody>
        </table>

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
    <table id="myTable"  class="table table-striped table-hover" >
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
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                 <th scope="col" style="color: black">Action</th>

            </thead>
            <tbody>
                
                 @php($i=1)
           @foreach($ho_div_maker as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>
                    <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 
                    
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


                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-info'>   Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-primary'> Waiting For <br> Authorization</span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-secondary'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 ) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";

                    } ?> </td>

                 

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


                     <td>

                        
                          <?php 

                           if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){


                            if($r['action_status'] !='7'){

                           

                        ?>
                         <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func_ho_div_checker('{{$r['request_id'] }}',
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

                </tr>
            @endforeach
          
          
            </tbody>
        </table>
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

     <div class="double-scroll table-wrapper-scroll-y">
    <table id="myTable"  class="table table-striped table-hover" >
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
                <th scope="col" style="color: black">Decline Remarks (Request Checker)</th>

               
                 <th scope="col" style="color: black">Action</th>

            </thead>
            <tbody>
                
                 @php($i=1)
           @foreach($ho_div_checker as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                    <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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


                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-info'>   Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-primary'> Waiting For <br> Authorization</span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-secondary'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 ) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";

                    } ?> </td>

                 

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

                     <td>

                         <?php 

                       if($r['action_status_br_checker']=='2' || $r['action_status_br_checker']=='' || $r['action_status_br_checker']==NULL){

                        if ($r['br_maker'] == Auth::user()->id) {
                         
                        
                      ?>

                       <button type="button" <?php  if($r['action_status']=='5' || $r['action_status']=='6'){

                            echo "disabled";

                         } ?> style="width: 105px;background: #f57d77;color: #fff;" class="btn btn-primary btn-sm" onclick="assign_person_func({{$r['request_id'] }},'{{$r['req_id'] }}','{{$get_system_data->system_name}}', '{{$r['final_request_type']}}')">Assign Person</button>

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

                </tr>
            @endforeach
          
          
            </tbody>
        </table>
    </div>

      <!--   end role=10 HO Div Checker -->


      <!-- start role 11 (Super Admin) -->

    @elseif(Auth::user()->role == 11)

     <div class="double-scroll table-wrapper-scroll-y">
    <table id="myTable"  class="table table-striped table-hover" >
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
                
                 @php($i=1)
           @foreach($superadmin as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                   <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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


                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-info'>   Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-primary'> Waiting For <br> Authorization</span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-secondary'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 ) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";

                    } ?> </td>

                 

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
    </div>

      <!--   end role=11 Super Admin -->






      <!-- start role 12 ( Admin) -->

    @elseif(Auth::user()->role == 12)

     <div class="double-scroll table-wrapper-scroll-y">
    <table id="myTable"  class="table table-striped table-hover" >
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
                
                 @php($i=1)
           @foreach($admin as $r)


                <tr>
                     <th scope="row" style="color: black" class="slNo sl_no{{ $r['request_id'] }}" data-row_id="{{ $r['request_id'] }}">{{$i++}}</th>

                   
                    <td>{{$r['req_id']}}</td>

                  <td><?php echo date('d F, Y h:i:s A', strtotime($r['entry_date']));  ?></td> 

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


                    




                    <td><?php if($r['status']==0 && $r['action_status_ho_maker'] !='3'){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($r['status']==0 && $r['action_status_ho_maker'] =='3'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-info'>   Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==1 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif($r['status']==2 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==2 && $r['action_status_ho_checker']=='5') {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-primary'> Waiting For <br> Authorization</span>";
                       
                    }elseif ($r['status']==3 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] !='5') {

                       echo "<span class='badge badge-secondary'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r['status']==4 && $r['action_status_ho_checker'] =='5') {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r['status']==6 ) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    }elseif ($r['status']==7 ) {

                       echo "<span class='badge badge-danger'>  Canceled </span>";
                       
                    }else{

                        echo "<span class='badge badge-info'>  Waiting for Authorization </span>";

                    } ?> </td>

                 

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


 <div class="modal fade halimmodal_for_show_details" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"> <b> Show Details </b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_body_parameter_list">
       

     
       
          
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

                
                $('.halimmodal').modal('show');
                $('.modal-body').html(data.html);

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



    $(".checkbox_all").on("click", function(){
        $(".checkbox_single").prop("checked", true);
    });



    $(".br_checker_multiple_authorize").on("click", function(){

          // var br_checker_single_checkbox_sl =  $("#br_checker_select_req_id").val();
          // alert(br_checker_single_checkbox_sl);

          $('input[name="checkbox_single"]:checked').each(function() {
               console.log(this.value);
            });


    });


</script>



<!--end  branch cheker script-->



 @endsection