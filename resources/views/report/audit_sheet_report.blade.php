@extends('master.master')


@section('css')

  
 <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">

<style type="text/css">
    label{
            margin-left: 20px;
                font-size: 15px;
    }

    .form-group {
    margin-bottom: 0.5rem !important;
}


.select2{
    width: 100% !important;
}


.sub_branch{
    width: 64%;
    margin-left: 112px;
}


</style>
 @endsection




@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Report</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Audit Sheet Report</b></a>
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
           
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Audit Sheet Report</h5>
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

                            <form action="{{ url('user_wise_report_data_table') }}" method="POST" name="info">
                               @csrf


                                <div class="row">
                                    <div class="col-md-6">
                                        
                                
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"><b>From Date</b></label>

                                            <div class="col-lg-8">

                                                <input type="text"  class="form-control" name="from_date" id="datepicker" placeholder="dd-mm-yyyy"> 

                                            </div>

                                        </div>


                                        <div class="form-group row">

                                            <label class="col-lg-2 col-form-label"><b>To Date</b></label>

                                                <div class="col-lg-8">
                                                    <input type="text"  class="form-control" name="to_date" id="datepicker1" placeholder="dd-mm-yyyy"> 

                                            </div>

                                        </div>


                                        
                                         <div class="form-group row">
                                            <div class="offset-lg-8 col-lg-8">
                                                <input type="button"  name="search" class="btn btn-sm btn-success" value="Search" onclick="generateReport()">
                                               
                                            </div>
                                        </div>


                                    </div>


                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
           


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




function generateReport(){

    var ref=new Date().getTime();

    popupWindow =window.open( location.pathname.substring(0, location.pathname.length - location.pathname.length) + "{{ url ('audit_sheet_report_data')}}?frm_date="+document.info.from_date.value+"&to_date="+document.info.to_date.value,'newWindow',' top=200, width=800, height=500, left=50, scrollbars=1, toolbar=no,resizable=false' );


    return false;

}


 
</script>




@endpush
