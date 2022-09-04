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
                        <a href=""><b style="color: white;"> Request Id Trancker and Audit</b></a>
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
                 <th>Request Id</th>
                <th>Operation User</th>
                <th>Operation</th>
                <th>Date and time</th>
                <th>User IP Address</th>
               
            </tr>
        </thead>
        <tbody>
            
            <?php $sl=0; 

            foreach($user_audit_log_data as $single_data){

                $sl++;

                // echo "<pre>";
                // print_r($single_data);die;
            ?>
            <tr>

                <td> <?php echo $sl; ?></td>
                <td> {{$single_data->request_id}} ( {{$single_data->user_id}})</td>
                <td> {{$single_data->name}}</td>
                <td> {{$single_data->title}} </td>
                <td>

                    <?php 

                         if ($single_data->operation_date_time) {
              
                               echo date('d F, Y h:i:s A', strtotime($single_data->operation_date_time));
                             }
                    ?>
                 </td>
                <td> {{$single_data->ip_address}} </td>
                
            </tr>
          
         <?php


            }

        ?>
            
        </tbody>
        <tfoot>
            <tr>

                <th>Sl</th>
                 <th>Request Id</th>
                <th>Operation User</th>
                <th>Operation</th>
                <th>Date and time</th>
                <th>User IP Address</th>

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
