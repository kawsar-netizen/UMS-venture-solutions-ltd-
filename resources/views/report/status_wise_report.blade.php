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


  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Horizontal form</h5>
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

                            <form action="{{ url('status_wise_report_data_table') }}" method="POST">
                                
                               @csrf

                                <div class="form-group row"><label class="col-lg-4 col-form-label">Select Status</label>

                                    <div class="col-lg-8">

                                        <select class="form-control" name="status">
                                            
                                            <option value="0" >Initiate</option>
                                            <option value="1" >Processing</option>
                                            <option value="2" >Complete</option>
                                            <option value="3" >On Hold</option>
                                            <option value="4" >Cancel</option>

                                            
                                        </select>
                                    </div>

                                </div>


                                
                               
                                <div class="form-group row">
                                    <div class="offset-lg-4 col-lg-8">
                                        <input type="submit" name="search" class="btn btn-sm btn-success" value="Search">
                                       
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


</script>
@endpush
