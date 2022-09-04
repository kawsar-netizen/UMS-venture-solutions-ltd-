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
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: black">Status Wise Report</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection








@section('content')

 <h2 class="text-center">Status Wise Report  </h2>
  <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sl</th>
                 <th>Date and Time</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Role</th>
                <th>System</th>
                <th>Request Type</th>
               
                <th>Branch</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Employee Mobile</th>
                <th>Assign Person</th>
                <th>Assigned By</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            <?php $sl=1; ?>

            @foreach($system_data as $single_ho_data)
            <tr>
                <td><?php  echo $sl++ ?></td>
                <td>{{$single_ho_data->created_at}}</td>
                <td>{{$single_ho_data->user_name}}</td>
                <td>{{$single_ho_data->user_email}}</td>

                <td><?php

                 $user_roll =  $single_ho_data->user_roll;

                  if ($user_roll==1) {
                    echo 'Branch User';

                }elseif ($user_roll==2) {
                   echo 'Head Office User';

                }elseif ($user_roll==3) {
                   echo 'Maker';

                }elseif ($user_roll==4) {
                   echo 'Checker';
                }

                ?></td>

                <td>{{$single_ho_data->ubs}} <?php if($single_ho_data->pbm !=''){

                    echo ', ';
                    echo $single_ho_data->pbm;

                }elseif ($single_ho_data->cps !='') {

                   echo ', ';
                    echo $single_ho_data->cps;

                }elseif ($single_ho_data->beftn !='') {

                   echo ', ';
                    echo $single_ho_data->beftn;

                }elseif ($single_ho_data->rtgs !='') {

                    echo ', ';
                    echo $single_ho_data->rtgs;

                }elseif ($single_ho_data->docudex !='') {

                    echo ', ';
                    echo $single_ho_data->docudex;


                }elseif ($single_ho_data->newdbcube !='') {

                    echo ', ';
                    echo $single_ho_data->newdbcube;

                }elseif ($single_ho_data->rbs !='') {

                    echo ', ';
                    echo $single_ho_data->rbs;


                }elseif ($single_ho_data->gefu !='') {

                    echo ', ';
                    echo $single_ho_data->gefu;

                }elseif ($single_ho_data->directbank !='') {

                    echo ', ';
                    echo $single_ho_data->directbank;

                }elseif ($single_ho_data->bkash !='') {

                    echo ', ';
                    echo $single_ho_data->bkash;


                }elseif ($single_ho_data->portal !='') {

                    echo ', ';
                    echo $single_ho_data->portal;

                }elseif ($single_ho_data->rit !='') {

                    echo ', ';
                    echo $single_ho_data->rit;

                }elseif ($single_ho_data->forex !='') {

                    echo ', ';
                    echo $single_ho_data->forex;

                }elseif ($single_ho_data->csms !='') {

                    echo ', ';
                    echo $single_ho_data->csms;


                }elseif ($single_ho_data->passport !='') {

                    echo ', ';
                    echo $single_ho_data->passport;

                }elseif ($single_ho_data->nscreen !='') {

                    echo ', ';
                    echo $single_ho_data->nscreen;
                    
                }elseif ($single_ho_data->swift !='') {

                    echo ', ';
                    echo $single_ho_data->swift;
                    
                }

                ?></td>

                <td>
                    {{$single_ho_data->newidcreate}}

                    <?php

                    if($single_ho_data->amendment != ''){
                      
                        echo $single_ho_data->amendment;

                    }elseif($single_ho_data->transfer != ''){

                       
                        echo $single_ho_data->transfer;

                    }elseif($single_ho_data->enable != ''){

                       
                        echo $single_ho_data->enable;

                    }elseif($single_ho_data->disable != ''){

                       
                        echo $single_ho_data->disable;

                    }elseif($single_ho_data->passreset != ''){

                       
                        echo $single_ho_data->passreset;

                    }

                    ?>
                </td>
              

                <td>{{$single_ho_data->branch}}</td>
                <td>{{$single_ho_data->emp_name}}</td>

                <td>{{$single_ho_data->designation}}</td>
                <td>{{$single_ho_data->emp_mobile}}</td>
                <td><?php  

                $assign_person_id = $single_ho_data->assign_person;

                if ($assign_person_id !='') {

                  $assign_person_data =  DB::table('users')->where('id',$assign_person_id)->first();
                  echo $assign_person_data->name;
                }

                ?></td>
                <td>
                    <?php

                   $assigned_by_id = $single_ho_data->assigned_by;

                   if ($assigned_by_id !='') {

                      $assign_by_data =  DB::table('users')->where('id',$assigned_by_id)->first();
                      echo $assign_by_data->name;
                   }
                    ?>
                </td>
                <td>
                    <?php

                    $change_status_id = $single_ho_data->change_status;

                    if ($change_status_id==0) {
                       echo "Initiate";

                    }elseif ($change_status_id==1) {
                        echo "Processing";

                    }elseif ($change_status_id==2) {
                        echo "Completed";

                    }elseif ($change_status_id==3) {
                        echo "On Hold";

                    }elseif ($change_status_id==4) {

                        echo "Cancel";

                    }

                    ?>
                </td>


            </tr>

            @endforeach

          
            
        </tbody>
        <tfoot>
            <tr>
                <th>Sl</th>
                 <th>Date and Time</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Role</th>
                <th>System</th>
                <th>Request Type</th>
               
                <th>Branch</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Employee Mobile</th>
                <th>Assign Person</th>
                <th>Assigned By</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
         

@endsection


@push('scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script>

    $(document).ready(function() {
    $('#example').DataTable( {
          "scrollX": true,

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


</script>
@endpush
