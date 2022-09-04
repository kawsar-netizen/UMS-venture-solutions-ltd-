@extends('master.master')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

    <style type="text/css">
        label {
            margin-left: 20px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 0.5rem !important;
        }


        .select2 {
            width: 100% !important;
        }


        .sub_branch {
            width: 64%;
            margin-left: 112px;
        }
    </style>
@endsection




@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading"
        style="background-color: #a3b0c2; color: white; font-family: serif;">
        <div class="col-lg-10">
            <h2><b align="center">Report</b></h2>
            <ol class="breadcrumb" style="background-color: #a3b0c2">
                <li class="breadcrumb-item">
                    <a href=""><b style="color: white">UBS Unlock Request Report</b></a>
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
                        <h5>UBS Unlock Request Report</h5>
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

                        <form action="{{ url('ubs_unlock_report_data') }}" method="POST" name="info" >
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>From Date</b></label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="from_date" required id="datepicker" placeholder="dd-mm-yyyy" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>To Date</b></label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="to_date" required id="datepicker1" placeholder="dd-mm-yyyy" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>Branches</b></label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" required="" name="branch" id="branch">
                                                <option value="">--ALL--</option>
                                                <?php
                                                    foreach ($branch_data as $item) {
                                                ?>
                                                <option value="{{$item->bnk_br_id}}">{{$item->name}} ({{$item->bnk_br_id}})</option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>Division’s</b></label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" required="" name="division" id="division">
                                                <option value="">--ALL--</option>
                                                <?php
                                                    foreach ($division_data as $item) {
                                                ?>
                                                <option value="{{$item->division_name}}">{{$item->division_name}}
                                                </option>
                                                <?php 
                                                    } 
                                                ?>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>Status</b></label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" required="" name="usb_status" id="usb_status">
                                                <option value="">--ALL--</option>
                                                <option value="0">Initiate</option>
                                                <option value="1">Authorized</option>
                                                <option value="2">decliend</option>
                                               
                                                @error('usb_status')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>UBS User ID</b></label>
                                        <div class="col-lg-8">
                                            <input type="text" name="user_id" id="" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-lg-8 col-lg-8">
                                            <input type="button" name="search" class="btn btn-sm btn-success" value="Search" onclick="generateReport()">
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
        $(document).ready(function() {
            $("#datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
            });

            $("#datepicker1").datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
            });
        });
        
        //Open in a new window

        function generateReport() {
            var ref = new Date().getTime();
            popupWindow = window.open(  "{{ url('ubs_unlock_report_data') }}?from_date=" + document.info.from_date.value + "&to_date="+document.info.to_date.value +"&branch="+document.info.branch.value+"&division="+document.info.division.value+"&status="+document.info.usb_status.value+"&user="+document.info.user_id.value ,'newWindow','top=200, width=800, height=500, left=50, scrollbars=1, toolbar=no,resizable=false');
            return false;
        }

//   No need down code by Kawsar khan
        $('.division_div').hide();

        function check_head_office(branch_code) {
            // alert(branch_code);

            if (branch_code == '202') {

                $('.division_div').show();

            } else {

                $('.division_div').hide();
                document.info.division.value = '';

            }

        }


        $('.request_type_div').hide();


        function hide_request_type(system_id, user_role) {



            if (user_role == '2' || user_role == '6' || user_role == '8' || user_role == '11' || user_role == '12') {

                if (system_id == '6') {



                    $('#request_type').html(
                        "<select class='form-control select2' name='request_type' id='request_type' ><option value=''>--Select--</option><option value='33'> Enhancement</option></select>"
                        );
                    $('.request_type_div').show();

                } else {

                    $('#request_type').html('');
                    $('.request_type_div').hide();

                }

            }



        } // hide_request type function


        $(".sub_branch").hide();

        function check_sub_br(has_br_code) {

            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            if (has_br_code != '202') {

                var formData = {

                    "branch_id": has_br_code
                };

                $.ajax({

                    type: 'POST',
                    url: "{{ url('find-sub-branch') }}",
                    data: formData,
                    success: function(data) {


                        // alert('Successfull');
                        // if (data!=0) {
                        //     console.log(data);
                        //      $('.sub_branch').css('display','');
                        //     $('.sub_branch').html(data.html);

                        // }else{
                        //         console.log(data);
                        //      $('.sub_branch').css('display','none');

                        // }


                        if (data != '0') {

                            $(".sub_branch").show();
                            $("#sub_branch_id").empty().append(data);

                        } else {

                            $(".sub_branch").hide();

                        }



                    },
                    error: function(response) {

                        console.log(response);

                    }
                });


            } else if (has_br_code == '202') {
                $(".sub_branch").hide();
                $("#sub_branch_id").empty();

            }
        }
    </script>
@endpush
