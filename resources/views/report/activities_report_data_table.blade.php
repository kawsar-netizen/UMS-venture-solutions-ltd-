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
                        <a href=""><b style="color: white;">Activities Report</b></a>
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
                
                 <th>Branch</th>
                 <th>Division</th>
                 <th>Module</th>
                 <th>Request Type</th>
                
                 <th>Request Date</th>
                 <th>Request Status</th>

                 
                 <th>IT Maker</th>
                 <th>IT checker </th>

                
            </tr>
        </thead>
        <tbody>
            
            <?php $sl=1; 

            foreach($requests as $single_data){

                $sl++;

                // echo "<pre>";
                // print_r($single_data);
            ?>
            <tr>

                <td><?php echo $sl; ?></td>
                
                <td>{{$single_data['req_id']}}</td>
              
               
                <td><?php 

                $branch_code = $single_data['branch_code'];

                if ($branch_code) {
                   
                    $branch_data =  DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();

                   echo $branch_data->name;
                   
                }else{
                    echo"--";
                }

                ?></td>

                <td>{{$single_data['division_name']}}</td>

                <td><?php 

                $request_type_system_id = $single_data['request_type_system_id'];
                $request_type_system_data = DB::table('systems')->where('id',$request_type_system_id)->first();

                echo $request_type_system_data->system_name;

                ?></td>

                <td>{{$single_data['request_type_name']}}</td>
                
                

                <td>{{date('d F, Y h:i:s a', strtotime($single_data['entry_date'])) }}</td>

                 <td>
                     

                     <?php 

                        if($single_data['status']=='0' && ($single_data['action_status_br_checker'] =='' || $single_data['action_status_br_checker']==NULL )){

                      echo "<span class='badge badge-warning'>  Initiate </span>";

                    }elseif($single_data['status']=='0' && $single_data['action_status_br_checker'] =='1'  
                        && $single_data['action_status_ho_maker'] !='4' && $single_data['action_status_ho_checker'] !='5'){

                      echo "<span class='badge badge-info'>  Processing </span>";

                    }elseif($single_data['status']=='0' && $single_data['action_status_br_checker'] =='1'  
                        && $single_data['action_status_ho_maker'] =='4' && $single_data['action_status_ho_checker'] !='5'){

                      echo "<span class='badge badge-info'>  Waiting For Authorization </span>";

                    }elseif ($single_data['status']=='2' && $single_data['action_status_ho_checker']=='5'){

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($single_data['status']=='3' && $single_data['action_status_ho_checker'] =='5'){

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($single_data['status']=='7' || $single_data['status']=='4') {

                        echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }
                     ?>
                 </td>

               

                <td><?php

                $ho_maker_id = $single_data['ho_maker'];

                 if ($ho_maker_id) {

                    $ho_maker_data =  DB::table('users')->where('id', $ho_maker_id)->first();
                    echo $ho_maker_data->name;

               }else{
                echo"--";
               }

            ?></td>


                <td><?php

              $ho_checker_id = $single_data['ho_checker'];

               if ($ho_checker_id) {

                    $ho_checker_data =  DB::table('users')->where('id', $ho_checker_id)->first();
                    echo $ho_checker_data->name;

               }else{
                echo"--";
               }

            ?></td>
                
            </tr>
          
         <?php


            }

        ?>
            
        </tbody>
        <tfoot>
             <tr>

                 <th>Sl</th>
               
                 <th>Request No</th>
                
                 <th>Branch</th>
                 <th>Division</th>
                 <th>Module</th>
                 <th>Request Type</th>
                
                 <th>Request Date</th>
                 <th>Request Status</th>

                 
                 <th>IT Maker</th>
                 <th>IT checker </th>

                
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
