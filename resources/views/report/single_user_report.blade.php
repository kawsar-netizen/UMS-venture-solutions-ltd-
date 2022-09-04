@extends('master.master')


@section('css')

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      

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
                        <a href=""><b style="color: white">Single User Information Report</b></a>
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
                            <h5>Single User Information Report</h5>
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

                            <form action="#" method="POST" id="submit_form" name="info">
                               @csrf


                            

                                 <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>Domain Id : </b></label>

                                    <div class="col-lg-7">

                                        <input type="text" placeholder="Domain id" class="form-control" 
                                        name="domain_id" id="domain_id"> 
                                         

                                    </div>


                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label"><b>Select Branch </b></label>
                                      <div class="col-lg-7">

                                        <select class="form-control select2" name="branch_code" id="branch_code">

                                             <option value="">--select--</option>

                                            <?php 


                                             $get_branch =   DB::table('branch_info')->where('brinfo_flag', 1)->get();

                                             foreach ($get_branch as  $single_branch_data) {
                                                
                                                ?>

                                           <option value="{{$single_branch_data->bnk_br_id}}">{{$single_branch_data->name}} ({{$single_branch_data->bnk_br_id}})</option>

                                            <?php 


                                             }
                                            ?>

                                            
                                        </select>
   

                                    </div>
                                    
                                </div>

                                 <div class="offset-lg-7">

                                
                                         <input type="button"  name="search" class="btn btn-success" value="Search" onclick="generateReport()">

                                    </div>
                                
                               
                               

                            </form>

                        </div>
                    </div>
                </div>
            </div>     <!--  end row -->
           


            
        </div>

         
@endsection


@push('scripts')



<script>
$(document).ready(function(){
    $('#submit_form').on('submit', function(e){
        e.preventDefault();
        generateReport();
    });
});



function generateReport(){

    var domain_id = $("#domain_id").val();
    var branch_code = $("#branch_code").val();

    if (domain_id=='' && branch_code=='') {
                 cuteAlert({
                      type: "warning",
                      title: "Please Select At least One Filter",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    });

        return false;
    }
    
    var ref=new Date().getTime();



 popupWindow =window.open( location.pathname.substring(0, location.pathname.length - location.pathname.length) + "{{ url ('single_user_report_get_data')}}?domain_id="+document.info.domain_id.value+"&branch="+document.info.branch_code.value,'newWindow',' top=200, width=800, height=500, left=50, scrollbars=1, toolbar=no,resizable=false' );


return false;

}



</script>




@endpush
