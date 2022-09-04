@extends('master.master')


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
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Request Report</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection








@section('content')


  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Request form</h5>
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

                            <form action="{{ url('request_report_data_table') }}" method="get" name="info">
                               @csrf


                            

                                 <div class="form-group row">

                                    <label class=" col-form-label"><b>Request Id : </b></label>

                                    <div class="col-lg-7">

                                        <input type="text" placeholder="Request id" class="form-control" name="request_id"> 


                                         

                                    </div>

                                    <div class="">

                                
                                         <input type="submit"  name="search" class="btn btn-success" value="Search" >

                                    </div>

                                </div>

                                
                               
                               

                                       
                            

                            </form>

                        </div>
                    </div>
                </div>
            </div>     <!--  end row -->
           


            <?php

                if(isset($requests) and $result_null==0) {

                    // echo"<pre>";
                    // print_r($requests);die;
                   
               ?>
            <div class="row " id="print_data">
           
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Individual Request Id Information</h5>
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
                        <div class="ibox-content"  >

                            <?php

                                foreach ($requests as $key => $value) {

                                    // echo "<pre>";
                                    // print_r($value);die;
                                 
                                 ?>


                                 <table class="table table-bordered" >

                                    <button onclick="printDiv()" class="btn btn-success">Print</button>

                                    <button class="btn btn-primary" style="float:right;" onclick="generateReport( '{{ $value['req_id']}}' )">Audit Log</button>
                                    <br>
                                    <br>

                                     <tr>
                                         <th>Request Id</th>
                                         <td>{{$value['req_id']}}</td>
                                     </tr>


                                     <tr>
                                         <th>Module Name</th>
                                         <td><?php 
                                         
                                            $system_id = $value['request_type_system_id'];
                                            if($system_id){
                                               $get_system_info = DB::table('systems')->where('id',$system_id)->first();
                                                echo $get_system_info->system_name;
                                            }
                                         
                                         ?></td>
                                     </tr>

                                     <tr>
                                         <th>Request Type Name</th>
                                         <td>{{$value['request_type_name']}}</td>
                                     </tr>

                                      <tr>
                                         <th>Roles Name</th>
                                         <td>{{$value['final_operation_name']}}</td>
                                     </tr>

                                      <tr>
                                         <th>Request Date</th>
                                         <td>
                                            <?php 
                                             if ($value['entry_date']) {
              
                                               echo date('d F, Y h:i:s A', strtotime($value['entry_date']));
                                             }

                                            ?>
                                         </td>
                                     </tr>

                                     <tr>
                                         <th>Request Status</th>
                                         <td><?php 

                                            $status = $value['status'];       
                                            $action_status = $value['action_status'];               
                                            $action_status_br_checker = $value['action_status_br_checker'];
                                            $action_status_ho_maker = $value['action_status_ho_maker'];
                                            $action_status_ho_checker = $value['action_status_ho_checker'];

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

                                          ?></td>
                                     </tr>

                                     <tr>
                                         <th>Request Branch</th>
                                         <td><?php


                                        $branch_code = $value['branch_code'];

                                        $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                                        echo $branch_data->name;

                                      $pk_for_sub_br =  $value['pk_for_sub_br'];

                                      if ($pk_for_sub_br) {

                                        $sub_branch_data = DB::table('branch_info')->where('agent_br_key',$pk_for_sub_br)->first();

                                        echo "<span style='color: red;'>  ( $sub_branch_data->name )</span>";
                                        
                                      }
                                      


                                     ?></td>
                                     </tr>

                                     <tr>
                                         <th>Request Generated By</th>
                                         <td><?php


                                        $br_maker_id = $value['br_maker'];

                                       $br_maker_user = DB::table('users')->where('id', $br_maker_id)->first();

                                       echo $br_maker_user->name." ($br_maker_user->user_id)";

                                     ?></td>
                                     </tr> 


                                      <tr>
                                         <th>Division Name</th>
                                         <td>

                                        <?php


                                         echo $division_name = $value['division_name'];

                                      

                                     ?></td>
                                     </tr> 

                                     <tr>
                                         <th>Request Checker</th>
                                         <td>

                                            <?php

                                           $br_checker_id = $value['br_checker_assign_manual_id'];

                                           if ($br_checker_id) {

                                               $br_checker_user = DB::table('users')->where('id', $br_checker_id)->first();

                                                 echo $br_checker_user->name." ($br_checker_user->user_id)";
                                           }else{

                                            echo "--";
                                           }
                                           

                                        ?></td>
                                     </tr> 

                                     <?php 
                                        if ($value['request_type_id']=='33') {
                                            ?>

                                            <tr>
                                             <th>Head Office Authorizer (For RTGS Enhancement)</th>
                                             <td>

                                                <?php

                                                  $ho_authorizer = $value['ho_authorizer'];


                                                   if ($ho_authorizer) {

                                                       $ho_authorizer_data = DB::table('users')->where('id',$ho_authorizer)->first();

                                                         echo $ho_authorizer_data->name." ( $ho_authorizer_data->user_id )";

                                                   }else{

                                                    echo "--";
                                                   }
                                                   

                                                ?>
                                                
                                            </td>
                                         </tr>

                                         <?php  
                                           
                                        }

                                     ?>
                                     


                                     <tr>
                                         <th>IT Maker </th>
                                         <td>
                                             
                                             <?php

                                           $ho_maker_id = $value['ho_maker'];

                                           if ($ho_maker_id) {

                                               $ho_maker_user = DB::table('users')->where('id', $ho_maker_id)->first();

                                                 echo $ho_maker_user->name." ($ho_maker_user->user_id)";

                                           }else{

                                            echo "--";
                                           }
                                           

                                        ?>

                                         </td>
                                     </tr>

                                      <tr>
                                         <th>IT Checker </th>

                                         <td>

                                          <?php

                                           $ho_checker_id = $value['ho_checker'];

                                           if ($ho_checker_id) {

                                               $ho_checker_user = DB::table('users')->where('id', $ho_checker_id)->first();

                                                 echo $ho_checker_user->name." ($ho_checker_user->user_id)";
                                                 
                                           }else{

                                            echo "--";
                                           }
                                           

                                        ?></td>
                                     </tr>




                                 </table>
                                <?php


                                }

                            ?>
         

                        </div>
                    </div>
                </div>
            </div>     <!--  end row -->

            <?php

             }
             elseif(empty($requests) and !empty($result_null))
             {
                if($result_null==1)
                {
            ?>
              No Result Found


            <?php
               }
        }
            ?>
        </div>

         
@endsection


@push('scripts')



<script>


$(document).ready(function(){

    $("#datepicker").datepicker({
        dateFormat:'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
    });


    $("#datepicker1").datepicker({
        dateFormat:'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
    });

});


function generateReport(req_id){

    // alert(req_id);

    var ref=new Date().getTime();



 popupWindow =window.open( location.pathname.substring(0, location.pathname.length - 31) + "{{ url ('user_audit_log_report')}}?req_id="+req_id,'newWindow',' top=200, width=800, height=500, left=50, scrollbars=1, toolbar=no,resizable=false' );


return false;

}
</script>


<script>
        function printDiv() {

            var divContents = document.getElementById("print_data").innerHTML;
          //  var a = window.open("","", 'top=100,left=100,height=500, width=1000');
           

             var originalContents = document.body.innerHTML;
     document.body.innerHTML = divContents;
     window.print();
     document.body.innerHTML = originalContents;

            // a.document.write(divContents);
          
            // a.document.close();
            // a.print();
        }
    </script>


@endpush
