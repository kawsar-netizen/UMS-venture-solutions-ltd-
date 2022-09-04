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
                        <a href=""><b style="color: black">System Wise Report</b></a>
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

                            <form action="{{ url('system_wise_report_data_table') }}" method="GET">
                                
                               @csrf

                                <div class="form-group row"><label class="col-lg-4 col-form-label">Select System</label>

                                    <div class="col-lg-8">

                                        <select class="form-control" name="system">
                                            
                                            <option value="Manager">Manager</option>
                                            <option value="General Banking">General Banking</option>
                                            <option value="Credit">Credit</option>
                                            <option value="Foreign Trade">Foreign Trade</option>
                                            <option value="View">View</option>

                                            
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
