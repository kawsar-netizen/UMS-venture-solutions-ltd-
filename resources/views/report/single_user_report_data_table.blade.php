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


     <?php 

      if (!empty($get_user_data)) {
     ?>
    <table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>
               
                 <th>Full Name</th>
                <th>Employee Id</th>
                <th>Designation</th>
                <th>Branch Name (Branch Code)</th>
                 <th style="">Division </th>
               
                <th>User Role</th>
               
            </tr>
        </thead>
        <tbody>
            
           
           <?php 
                foreach ($get_user_data as  $value) {
                   
                

              ?>

            <tr>

              
                <td> {{$value->name}}</td>
                <td> {{$value->emp_id}} </td>
                <td>
                    {{$value->designation}}
                 </td>

                 <td><?php 

                $branch_code = $value->branch;
                $br_pk_id = $value->br_pk_id;

                if ($br_pk_id=='' || $br_pk_id==NULL || $br_pk_id=='0') {

                    $get_branch_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();

                    echo $get_branch_data->name."( $branch_code )";

                }else{

                     $get_branch_data = DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                    echo $get_branch_data->name."( $branch_code )";

                }
               

                 ?></td>

                 <td>
                    <?php 
                    if ($branch_code==202) {
                        
                        
                     echo    $value->division_name;

                    }
                ?>
                    
                </td>
                <td> <?php 

                $role_id = $value->role;
              $role_data =  DB::table('role_table')->where('sl',$role_id)->first();
              echo $role_data->role_name;
                ?> </td>
                
            </tr>
         
             <?php 

                }

             ?>
            
        </tbody>
        <tfoot>
             <tr>
               
                 <th>Full Name</th>
                <th>Employee Id</th>
                <th>Designation</th>
                <th>Branch Name</th>
                
                <th style="">Division </th>
                    
                   
                <th>User Role</th>
               
            </tr>
        </tfoot>
    </table>


    <?php 

}else{


    echo "Data Not Found";
}

?>
         
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


 
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example2 thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example2 thead');
 
    var table = $('#example2').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});


</script>
@endpush
