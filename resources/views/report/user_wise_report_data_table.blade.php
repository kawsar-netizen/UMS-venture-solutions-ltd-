@extends('master.master_report')


@section('css')

<style type="text/css">
    label{
            margin-left: 20px;
                font-size: 15px;
    }

    .form-group {
    margin-bottom: 0.5rem !important;
}

</style>
 @endsection




@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Report</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2;">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white;">User Wise Report</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection








@section('content')


     
    <table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>

                <th>Sl</th>
               
                 <th>Request No</th>
                 <th>User Id</th>

                 <th>User Name (Emp Id)</th>
                 <th>Module Name</th>
                 <th>Roles Name</th>
                 <th style="width: 100px !important;">Request Maker Remarks</th>
                 <th>IT Maker Remarks</th>

                 <th>Branch</th>
                 <th>Division</th>
                 <th>Request Type</th>
                 <th>Status</th>

                 <th>Role</th>
                 <th>Request Date</th>
                 <th>Branch Authorizer</th>
                 <th>Enhancement Authorized By</th>
                 <th>IT Maker</th>
                 <th>IT checker </th>

                 <th>Duration (RTGS) (Date Format : Month-Day-Year)</th>
                 <th>Designation</th>
                 <th>Enhanced Template Number(RTGS)</th>
                

                
            </tr>
        </thead>
        <tbody>
            
            <?php $sl=0; 

            foreach($requests as $single_data){

                $sl++;

               
            ?>
            <tr>

                <td><?php echo $sl; ?></td>
                
                <td>{{$single_data['req_id']}}</td>
                <td>
                    <?php 

                   $user_pk_id = $single_data['user_pk_id'];
                   $request_type_system_id = $single_data['request_type_system_id'];

                     $system_user_id_data =  DB::table('system_user_id')->where('user',$user_pk_id)->where('sys_id',$request_type_system_id)->count();

                     if ($system_user_id_data>0) {


                     $system_user_id_data =  DB::table('system_user_id')->where('user',$user_pk_id)->where('sys_id',$request_type_system_id)->first();

                        echo $system_user_id_data->sys_user_id;
                     }else{
                        
                       echo $single_data['br_maker_domain_id'];
                     }


                     ?>
                </td>

                 <td>{{$single_data['user_name']}} ( {{$single_data['branch_maker_emp_id']}} )</td>
                 <td><?php 

                $request_type_system_id = $single_data['request_type_system_id']; 
                $get_system_info = DB::table('systems')->where('id',$request_type_system_id)->first();
                echo $get_system_info->system_name;
                 ?></td>


                 <td>{{$single_data['final_operation_name']}}</td>
                 <td>{{$single_data['final_remarks']}}</td>
                 <td  style="width: 100px !important;">{{$single_data['ho_maker_remarks']}}</td> <!-- it maker remarks -->
               
                <td><?php 

                $branch_code = $single_data['branch_code'];

                $pk_for_sub_br = $single_data['pk_for_sub_br'];

                if ($branch_code  && ($pk_for_sub_br=='' || $pk_for_sub_br=='0' || $pk_for_sub_br==NULL) ) {
                   
                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name." ($branch_code)";
                   
                }elseif ($branch_code  && ($pk_for_sub_br!='' || $pk_for_sub_br!='0' || $pk_for_sub_br!=NULL) ) {
                   
                    $branch_data =  DB::table('branch_info')->where('agent_br_key', $pk_for_sub_br)->first();

                    echo $branch_data->name." ($branch_code)";
                   
                }else{
                    echo"--";
                }

                ?></td>

                <td>{{$single_data['division_name']}}</td>
                <td>{{$single_data['request_type_name']}}</td>
                <td><?php 

                    $status = $single_data['status'];       
                    $action_status = $single_data['action_status'];               
                    $action_status_br_checker = $single_data['action_status_br_checker'];
                    $action_status_ho_maker = $single_data['action_status_ho_maker'];
                    $action_status_ho_checker = $single_data['action_status_ho_checker'];

                    if ($status=='7' &&  $action_status=='7') {
                        echo "<span class='badge badge-danger'> Cancel </span>";

                    }elseif ($status=='6') {
                        echo "<span class='badge badge-danger'> Decline </span>";

                    }elseif($status !='7' && $status=='0' &&  ($action_status_br_checker='1' || $action_status_br_checker=='' || $action_status_br_checker==NULL) && $action_status_ho_maker !='3'){

                         echo "<span class='badge badge-warning'> Initiate </span>";

                    }elseif($status !='7' && $status =='0'  && (!empty($action_status_br_checker) ||  $action_status_ho_maker=='3') && $action_status_ho_maker !='4' && empty($action_status_ho_checker) ){

                         echo "<span class='badge badge-primary'> Processing </span>";

                    }elseif($status !='7' && !empty($action_status_br_checker) && !empty($status) &&  $action_status_ho_maker=='4' && empty($action_status_ho_checker) ){

                         echo "<span class='badge badge-info'> Waiting For Authorization </span>";

                    }elseif($status !='7' &&  $status=='2'  && $action_status_ho_maker =='4'  && $action_status_ho_checker=='5'  ){

                         echo "<span class='badge badge-success'> Completed </span>";

                    }elseif($status !='7' && $status=='3' && $action_status_ho_checker=='5' ){

                         echo "<span class='badge badge-info'> On Hold </span>";

                    }

                ?></td>
                
                <td><?php  

                $role_id = $single_data['user_role_id'];

                if ($role_id) {
                     $role_data = DB::table('role_table')->where('sl', $role_id)->first();

                    echo $role_data->role_name;
                }
               

                    ?></td>

                    <td>{{date('d F, Y h:i:s a', strtotime($single_data['entry_date'])) }}</td>

                <td><?php

               $br_authorizer_id = $single_data['br_authorizer'];

               if ($br_authorizer_id) {

                    $br_authorizer_data_count =  DB::table('users')->where('id', $br_authorizer_id)->count();
                    
                    if ($br_authorizer_data_count>0) {

                      $br_authorizer_data =  DB::table('users')->where('id', $br_authorizer_id)->first();
                      echo $br_authorizer_data->name;

                    }else{
                        echo "--";
                    }
                    
               }else{
                echo"--";
               }
            

            ?></td>

            <td><?php 

                $ho_authorizer = $single_data['ho_authorizer'];
                if ($ho_authorizer) {


                    $get_ho_authorizer_count = DB::table('users')->where('id',$ho_authorizer)->count();

                    if ($get_ho_authorizer_count >0) {

                        $get_ho_authorizer = DB::table('users')->where('id',$ho_authorizer)->first();

                        echo $get_ho_authorizer->name;

                    }else{
                        echo "";
                    }
                   
                }
               
             ?></td>

                <td><?php

                $ho_maker_id = $single_data['ho_maker'];

                 if ($ho_maker_id) {

                    $ho_maker_data_count =  DB::table('users')->where('id', $ho_maker_id)->count();

                    if ($ho_maker_data_count>0) {

                        $ho_maker_data =  DB::table('users')->where('id', $ho_maker_id)->first();
                        echo $ho_maker_data->name;

                    }else{
                        echo "";
                    }
                    

               }else{
                echo"--";
               }

            ?></td>

                <td>
                


                 <?php

                     $ho_checker_id = $single_data['ho_checker'];

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
                    
                  
                    ?>
            </td>
                

                 <td><?php 

                 // print "<pre>";
                 //  print_r($single_data['parameterList']);
                 $data=NULL;
                 $temp=NULL;
                 foreach ($single_data['parameterList'] as $para_key => $para_value) {
                       
                          
                           
                            if($para_value->para_id=='1814')
                                $data= urldecode($para_value->value);
                            if($para_value->para_id=='1815')
                                $data=$data. " ".urldecode($para_value->value);
                            if($para_value->para_id=='144')
                                $data="Permanent";

                            if($para_value->para_id=='135' or $para_value->para_id=='136' or $para_value->para_id=='137' or $para_value->para_id=='138' or $para_value->para_id=='139' or $para_value->para_id=='140' or $para_value->para_id=='141' or $para_value->para_id=='142')
                            {
                                $temp=$para_value->para_name;
                            }
                 }
                 if($data=="Permanent")
                    echo "<span class='badge badge-primary'> $data </span" ;
                 else
                    echo "<span class='badge badge-success'> $data </span" ;
                 ?></td>
                 <td>{{$single_data['designation']}}</td>
                 <td>{{$temp}}</td>
                
            </tr>
          
         <?php


            }

        ?>
            
        </tbody>
        <tfoot>
             <tr>

                
                <th>Sl</th>
               
                 <th>Request No</th>
                 <th>User Id</th>

                 <th>User Name (Emp Id)</th>
                 <th>Module Name</th>
                 <th>Roles Name</th>
                 <th>Request Maker Remarks</th>
                 <th style="width: 100px !important;">IT Maker Remarks</th>

                 <th>Branch</th>
                 <th>Division</th>
                 <th>Request Type</th>
                 <th>Status</th>

                 <th>Role</th>
                 <th>Request Date</th>
                 <th>Branch Authorizer</th>
                 <th>Enhancement Authorized By</th>
                 <th>IT Maker</th>
                 <th>IT checker </th>

                 <th>Duration (RTGS) (Date Format : Month-Day-Year)</th>
                 <th>Designation</th>
                 <th>Template Number (RTGS)</th>
                
            </tr>
        </tfoot>
    </table>
         
@endsection


@push('scripts')

 <script src="{{ asset('assets/js/jquery_for_report.js') }} "></script>
 <script src="{{ asset('assets/js/data_table_button.js') }} "></script>
 <script src="{{ asset('assets/js/jzip.js') }} "></script>
 <script src="{{ asset('assets/js/pdf_make.js') }} "></script>
 <script src="{{ asset('assets/js/vfs.js') }} "></script>
 <script src="{{ asset('assets/js/print.js') }} "></script>
 <script src="{{ asset('assets/js/html_button.js') }} "></script>




<script>


 $(document).ready(function() {
    $('#example2').DataTable( {
          "scrollX": true,

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );




</script>
@endpush
