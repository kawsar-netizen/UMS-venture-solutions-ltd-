@extends('master.master')

@section('css')
    <style type="text/css">
        label {
            margin-left: 20px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 0.5rem !important;
        }

        .template_number_readonly {
            background: #c7c7c796;
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading"
        style="background-color: #a3b0c2; color: white; font-family: serif;">
        <div class="col-lg-10">
            <h2><b align="center">User Request Form</b></h2>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item">
                                <a href=""><b>User Request Form</b></a>
                            </li> -->
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection



@section('content')
    <!-- loader part -->
    <div class="loader" style="margin-left: -14px; padding-top: 10px">
        <img src="{{ asset('assets/img/loader2.gif') }}" style="margin-left: -150px">
    </div>
    <!-- loader part ends -->


    <div class="container wrapper wrapper-content" style="max-height: 80%">
        <div class="p-2 mb-4" align="center" style="background-color: #a3b0c2; color: white"><b>User Information Details</b>
        </div>

        <div class="wrapper  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <form>
                                        <?php
                                        $user_id = Auth::user()->id;
                                        
                                        $user_form_data = DB::table('users')
                                            ->where('id', $user_id)
                                            ->first();
                                        
                                        // echo"<pre>";
                                        // print_r($user_form_data);
                                        
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b>Employee Id </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="{{ $user_form_data->emp_id }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b>Branch </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="<?php
                                                $branch_code = $user_form_data->branch;
                                                $branch_info = DB::table('branch_info')
                                                    ->where('bnk_br_id', $branch_code)
                                                    ->first();
                                                
                                                echo $branch_info->name;
                                                echo ' (' . $branch_code . ')';
                                                ?> " type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b> Email </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="{{ $user_form_data->email }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b> Login Id </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="{{ $user_form_data->user_id }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <!-- end col-md-6 -->
                                <div class="col-md-6">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b>Employee Name </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name=""
                                                    value="{{ $user_form_data->name }} ({{ $user_form_data->emp_id }})"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b>Designation </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="{{ $user_form_data->designation }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><b> Mobile </b></label>
                                            <div class="col-sm-7">
                                                <input readonly name="" value="{{ $user_form_data->contact }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>

                                        <!--  <div class="form-group row">
                                      <label class="col-sm-4 col-form-label"><b> Department </b></label>
                                      <div class="col-sm-7">
                                         <input readonly name="" value="{{ $user_form_data->department }}" type="text" class="form-control">
                                      </div>
                                   </div> -->

                                    </form>
                                </div>
                                <!-- end col-md-6 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="systemList" id="systemList" value="">
    <input type="hidden" name="requestTypeList" id="requestTypeList" value="">
    <input type="hidden" name="parameterList" id="parameterList" value="">

    <div class="container wrapper wrapper-content" style="max-height: 80%">


        <form action="" method="post" enctype="multipart/form-data" id="sys_form">
            @csrf
            <div class="modal fade halimmodal_for_assign_person" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Person </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">



                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary bat">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!--  end Assign person -->

            <!-- system -->
            <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Systems</b></div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="row">
                                    <?php
                                    $checkListArray = [];
                                    
                                    foreach ($systemList as $key => $value) {
                                        array_push($checkListArray, '#check_' . $value->id);
                                    }
                                    
                                    $checkList = implode(',', $checkListArray);
                                    
                                    ?>
                                    @foreach ($systemList->chunk(2) as $chunks)
                                        <div class="col-lg-4">
                                            @foreach ($chunks as $sysL)
                                                <div class="form-group row">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <div class="i-checks">
                                                            <input name="{{ $sysL->system_name }}"
                                                                value="{{ $sysL->id }}"
                                                                id="check_{{ $sysL->id }}"
                                                                class="{{ $sysL->id }}_box" type="checkbox">
                                                            <label class="form-check-label"
                                                                for="check_{{ $sysL->id }}">{{ $sysL->system_name }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- system ends -->







            <!-- for parameters-->
            <div id="para_list" style="display: block;">



                @foreach ($systemList as $sl)
                    <!--  ******************** -->




                    <!-- for request Type-->

                    <div class="wrapper wrapper-content animated fadeInRight request_type_class"
                        id="{{ $sl->id }}_request_box" style="display: none;">

                        <div class="p-2 mb-4 request_background_color_{{ $sl->id }}" align="center"
                            style="color: white">

                            <b>{{ $sl->system_name }} Request Type</b>
                        </div>


                        <!-- for checkbox -->
                        <div class="ibox">

                            <div class="ibox-content">

                                <!-- radio start -->
                                <div class="row">
                                    @foreach ($request_data as $single_request)
                                        @if ($sl->id == $single_request->system_id)
                                            <?php 

                         if ($single_request->status !=1) {
                            
                            ?>

                                            <div class="col-lg-4">


                                                <div class="form-group row">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <div class="i-checks">

                                                            <input id="requst_type_user_id{{ $single_request->id }}"
                                                                name="radio{{ $sl->id }}"
                                                                onclick="request_type_hide({{ $single_request->system_id }}),setRequestTypeId('{{ $single_request->id }}',1,'{{ $single_request->system_id }}'),requestSectionHide('{{ $single_request->id }}','{{ $single_request->system_id }}', '{{ $single_request->request_type_name }}'), requestSectionHide2('{{ $single_request->id }}','{{ $single_request->system_id }}', '{{ $single_request->request_type_name }}')"
                                                                required value="{{ $single_request->request_type_name }}"
                                                                type="radio">

                                                            <label style="color: black;"
                                                                for="requst_type_user_id{{ $single_request->id }}"
                                                                id="requst_type_user_id{{ $single_request->id }}">{{ $single_request->request_type_name }}</label>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>



                                            <?php 

                           }

                         elseif ($single_request->status==1) {
                            
                            ?>

                                            <div class="col-lg-4">


                                                <div class="form-group row">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <div class="i-checks">

                                                            <input id="requst_type_user_id{{ $single_request->id }}"
                                                                name="radio{{ $sl->id }}"
                                                                onclick="req_type_func({{ $single_request->id }}, {{ $single_request->system_id }});requestSectionHide('{{ $single_request->id }}','{{ $single_request->system_id }}', '{{ $single_request->request_type_name }}'),requestSectionHide2('{{ $single_request->id }}','{{ $single_request->system_id }}', '{{ $single_request->request_type_name }}')"
                                                                value="{{ $single_request->request_type_name }}"
                                                                type="radio" required>


                                                            <label style="color: black;"
                                                                for="requst_type_user_id{{ $single_request->id }}">{{ $single_request->request_type_name }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <?php 

                           if ($single_request->status==1 && $single_request->show_input_field==1) {
                             
                           
                         ?>

                                            <div class="form-group row" id="box{{ $single_request->id }}"
                                                style="display: none;">

                                                <div class="col-lg-12">
                                                    <label>User ID : </label>
                                                    <input type="text" name="new_u_{{ $single_request->id }}"
                                                        id="new_u_{{ $single_request->id }}" value="">
                                                </div>

                                            </div>

                                            <?php 

                            }

                           }
                           ?>
                                        @endif
                                    @endforeach
                                </div>
                                <!-- radio ends -->





                            </div>


                        </div> <!-- end ibox -->



                    </div>

                    <!-- request Type end -->




                    <div class="wrapper wrapper-content animated fadeInRight {{ $sl->id }}_hasan"
                        id="{{ $sl->id }}_box" style="display: none;">

                        <div class="p-2 mb-2 request_background_color_{{ $sl->id }}" align="center"
                            style="color: white;"><b>{{ $sl->system_name }} Roles</b></div>

                        <!-- for checkbox -->
                        <div class="ibox">
                            <div class="ibox-content">

                                <!-- Radio Start -->
                                <div class="row">
                                    @php
                                        $rtgs_count = 0;
                                    @endphp
                                    <?php foreach($system_parameters as $sys_para){


                     
                  if(Auth::user()->role=='1' || Auth::user()->role=='5'){
                        

                        if($sl->id == $sys_para->system_id && $sys_para->system_id=='6'){                   
                     if($rtgs_count === 1){
                              continue;
                     }else{
                        ?>
                                    <input type="hidden" name="operation_system_name" value="rtgs">
                                    <?php 
                     }
                           $rtgs_count = 1;
                        ?>


                                    <table class="table mcr">

                                        <tr>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="131" name="131"
                                                        onclick="setparameterId('131','chk',1,'6')">&nbsp; Maker
                                                </label>

                                            </td>


                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="134" name="134"
                                                        onclick="setparameterId('134','chk',1,'6')">&nbsp; Report Viewer

                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="2113" name="2113"
                                                        onclick="setparameterId('2113','chk',1,'6')">&nbsp;Checker (Temp
                                                    1): SO/Officer

                                                </label>

                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="2114" name="2114"
                                                        onclick="setparameterId('2114','chk',1,'6')">&nbsp;Checker (Temp
                                                    2): PO
                                                </label>

                                            </td>


                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="2115" name="2115"
                                                        onclick="setparameterId('2115','chk',1,'6')">&nbsp;Checker (Temp
                                                    3): AVP/SPO

                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="2116" name="2116"
                                                        onclick="setparameterId('2116','chk',1,'6')">&nbsp;Checker (Temp
                                                    4): FVP/SAVP

                                                </label>

                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="2117" name="2117"
                                                        onclick="setparameterId('2117','chk',1,'6')">&nbsp;Checker (Temp
                                                    5): SVP/VP

                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">

                                                    <input type="checkbox" value="2118" name="2118"
                                                        onclick="setparameterId('2118','chk',1,'6')">&nbsp;Checker (Temp
                                                    6): SEVP/EVP

                                                </label>

                                            </td>

                                        </tr>

                                    </table>


                                    <table class="table display">



                                        <tr>

                                            <td></td>
                                            <td>
                                                <h4 class="text-center display">Checker Authorizer Limit</h4>
                                            </td>
                                            <td></td>
                                        </tr>


                                        <tr class="display">
                                            <th>Officers' Designation</th>
                                            <th>Template Number</th>
                                            <th>Highest Approval Limit</th>
                                        </tr>

                                        <tr class="display">

                                            <td><input name="rtgs_radio" value="135" id="parameter_id_rtgs_template0"
                                                    type="radio" onclick="setparameterId('135','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template0">Head Office </label>
                                            </td>

                                            <td> Template-0 </td>
                                            <td> BDT 150.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="136" id="parameter_id_rtgs_template1"
                                                    type="radio" onclick="setparameterId('136','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template1"> SO/Officer </label>
                                            </td>

                                            <td> Template-1 </td>
                                            <td> BDT 1.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="137" id="parameter_id_rtgs_template2"
                                                    type="radio" onclick="setparameterId('137','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template2"> PO </label>
                                            </td>

                                            <td> Template-2 </td>
                                            <td> BDT 5.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="138" id="parameter_id_rtgs_template3"
                                                    type="radio" onclick="setparameterId('138','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template3">AVP/SPO </label>
                                            </td>

                                            <td> Template-3 </td>
                                            <td> BDT 50.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="139" id="parameter_id_rtgs_template4"
                                                    type="radio" onclick="setparameterId('139','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template4">FVP/SAVP </label>
                                            </td>

                                            <td> Template-4 </td>
                                            <td> BDT 2.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="140" id="parameter_id_rtgs_template5"
                                                    type="radio" onclick="setparameterId('140','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template5">SVP/VP </label>
                                            </td>

                                            <td> Template-5 </td>
                                            <td> BDT 3.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="141" id="parameter_id_rtgs_template6"
                                                    type="radio" onclick="setparameterId('141','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template6">SEVP/EVP </label>

                                            </td>

                                            <td> Template-6 </td>
                                            <td> BDT 5.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="142" id="parameter_id_rtgs_template7"
                                                    type="radio" onclick="setparameterId('142','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template7">Special (***) </label>
                                            </td>

                                            <td> Template 7 </td>
                                            <td> -- </td>
                                        </tr>


                                    </table>






                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-lg-6 display_tmp_exp_date">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">

                                                    <input name="rtgs2_radio" class="showRtgsEnhanceMentDateTime"
                                                        value="143" id="temporay_exp_date" type="radio"
                                                        onclick="rtgsEnhancementDateTimeLabelSelect('143','chk',1,'6');">

                                                    <label for="temporay_exp_date" class="temporay_exp_date">Temporary
                                                        Expire Date and Time</label>
                                                    <br>

                                                    <input type="text" name="rtgs_tmp_exp_date" id="rtgs_tmp_exp_date"
                                                        class="rtgs_tmp_exp_date"
                                                        onclick="rtgsEnhancementDateTimeAdd('1814',document.getElementById('rtgs_tmp_exp_date').value,1,'6');">

                                                    <input type="text" name="rtgs_tmp_exp_time" id="rtgs_tmp_exp_time"
                                                        class="rtgs_tmp_exp_time"
                                                        onclick="rtgsEnhancementDateTimeAdd('1815',document.getElementById('rtgs_tmp_exp_date').value,1,'6');">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 display_permanent">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">

                                                    <input name="rtgs2_radio" value="144" id="permanent"
                                                        type="radio"><label for="permanent"
                                                        onclick="rtgs_permanent();rtgsEnhancementParmanentAdd('144','chk',1,'6');">Permanent</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 display">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-6">
                                                <label>Reason For RTGS Enhancement</label>
                                                <input type="text" name="158" value=""
                                                    onchange="setparameterId('158',this.value,1,'6');">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 display">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-6">
                                                <label>Previous Level of the checker Template Number</label>
                                                <input class="template_number_readonly" type="text" name="145"
                                                    value="{{ $user_form_data->designation }}"
                                                    onclick="setparameterId('145',this.value,1,'6');" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                        


                           }
                     
                  }if(Auth::user()->role=='2' || Auth::user()->role=='6' || Auth::user()->role=='8' || Auth::user()->role=='9' || Auth::user()->role=='10'){
                     
                     if($sl->id == $sys_para->system_id && $sys_para->system_id=='6'){                   
                     if($rtgs_count === 1){
                              continue;
                     }else{
                        ?>
                                    <input type="hidden" name="operation_system_name" value="rtgs">
                                    <?php 
                     }
                           $rtgs_count = 1;
                     
                     ?>


                                    <table class="table mcr">

                                        <tr>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="148" name="148"
                                                        onclick="setparameterId('148','chk',1,'6')">&nbsp; Maker
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="2129" name="2129"
                                                        onclick="setparameterId('2129','chk',1,'6')">&nbsp; Checker
                                                </label>
                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="150" name="150"
                                                        onclick="setparameterId('150','chk',1,'6')">&nbsp; Report Viewer
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="151" name="151"
                                                        onclick="setparameterId('151','chk',1,'6')">&nbsp; Fund Manager
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="152" name="152"
                                                        onclick="setparameterId('152','chk',1,'6')">&nbsp; Admin
                                                </label>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="153" name="153"
                                                        onclick="setparameterId('153','chk',1,'6')">&nbsp; Banks
                                                    Miscellaneous (HO)
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="154" name="154"
                                                        onclick="setparameterId('154','chk',1,'6')">&nbsp; Inter Bank Forex
                                                    (HO)
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="155" name="155"
                                                        onclick="setparameterId('155','chk',1,'6')">&nbsp; Inter Bank Local
                                                    (HO)
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="156" name="156"
                                                        onclick="setparameterId('156','chk',1,'6')">&nbsp; UM Maker (For
                                                    IT)
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="157" name="157"
                                                        onclick="setparameterId('157','chk',1,'6')">&nbsp; UM Checker (For
                                                    IT)
                                                </label>

                                            </td>

                                        </tr>
                                        {{-- Coding by Sizar(Start) --}}
                                        <tr>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="158" name="158"
                                                        onclick="setparameterId('158','chk',1,'6')">&nbsp;Inter Bank Forex
                                                    (Branch)
                                                </label>

                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="159" name="159"
                                                        onclick="setparameterId('159','chk',1,'6')">&nbsp;Banks
                                                    Miscellaneous (Branch)
                                                </label>
                                            </td>

                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="160" name="160"
                                                        onclick="setparameterId('160','chk',1,'6')">&nbsp;Inter Bank Local
                                                    (Branch)
                                                </label>

                                            </td>
                                        </tr>

                                        {{-- Coding by Sizar(End) --}}

                                    </table>


                                    <table class="table display">

                                        <tr class="display">

                                            <td></td>

                                            <td>
                                                <h4 class="text-center">Checker Authorizer Limit</h4>
                                            </td>
                                            <td></td>
                                        </tr>


                                        <tr class="display">
                                            <th>Officers' Designation</th>
                                            <th>Template Number</th>
                                            <th>Highest Approval Limit</th>
                                        </tr>

                                        <tr class="display">

                                            <td><input name="rtgs_radio" value="135" id="parameter_id_rtgs_template0"
                                                    type="radio"><label for="parameter_id_rtgs_template0"
                                                    onclick="setparameterId('135','chk',1,'6')">Head Office </label></td>

                                            <td> Template-0 </td>
                                            <td> BDT 150.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td><input name="rtgs_radio" value="136" id="parameter_id_rtgs_template1"
                                                    type="radio"><label for="parameter_id_rtgs_template1"
                                                    onclick="setparameterId('136','chk',1,'6')"> SO/Officer </label> </td>

                                            <td> Template-1 </td>
                                            <td> BDT 1.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="137" id="parameter_id_rtgs_template2"
                                                    type="radio">
                                                <label for="parameter_id_rtgs_template2"
                                                    onclick="setparameterId('137','chk',1,'6')"> PO </label>
                                            </td>

                                            <td> Template-2 </td>
                                            <td> BDT 5.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="138" id="parameter_id_rtgs_template3"
                                                    type="radio" onclick="setparameterId('138','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template3">AVP/SPO </label>
                                            </td>

                                            <td> Template-3 </td>
                                            <td> BDT 50.00 Lac </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="139" id="parameter_id_rtgs_template4"
                                                    type="radio" onclick="setparameterId('139','chk',1,'6')">
                                                <label for="parameter_id_rtgs_template4">FVP/SAVP </label>
                                            </td>

                                            <td> Template-4 </td>
                                            <td> BDT 2.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="140" id="parameter_id_rtgs_template5"
                                                    type="radio" onclick="setparameterId('140','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template5">SVP/VP </label>
                                            </td>

                                            <td> Template-5 </td>
                                            <td> BDT 3.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="141" id="parameter_id_rtgs_template6"
                                                    type="radio" onclick="setparameterId('141','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template6">SEVP/EVP </label>

                                            </td>

                                            <td> Template-6 </td>
                                            <td> BDT 5.00 Crore </td>
                                        </tr>

                                        <tr class="display">
                                            <td>
                                                <input name="rtgs_radio" value="142" id="parameter_id_rtgs_template7"
                                                    type="radio" onclick="setparameterId('142','chk',1,'6')">

                                                <label for="parameter_id_rtgs_template7">Special (***) </label>
                                            </td>

                                            <td> Template 7 </td>
                                            <td> -- </td>
                                        </tr>


                                    </table>






                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-lg-6 display">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">

                                                    <input name="rtgs2_radio" value="143" id="temporay_exp_date2"
                                                        class="showRtgsEnhanceMentDateTime" type="radio"
                                                        onclick="rtgsEnhancementDateTimeLabelSelect('143','chk',1,'6');">

                                                    <label for="temporay_exp_date2">Temporary Expire Date and Time </label>

                                                    <br>

                                                    <input type="text" name="rtgs_tmp_exp_date" id="rtgs_tmp_exp_date"
                                                        class="rtgs_tmp_exp_date"
                                                        onclick="rtgsEnhancementDateTimeAdd('1814',document.getElementById('rtgs_tmp_exp_date').value,1,'6');">

                                                    <input type="text" name="rtgs_tmp_exp_time" id="rtgs_tmp_exp_time"
                                                        class="rtgs_tmp_exp_time"
                                                        onclick="rtgsEnhancementDateTimeAdd('1815',document.getElementById('rtgs_tmp_exp_date').value,1,'6');">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 display_permanent">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">

                                                    <input name="rtgs2_radio" value="144" id="permanent"
                                                        type="radio"><label for="permanent"
                                                        onclick="rtgs_permanent();rtgsEnhancementParmanentAdd('144','chk',1,'6');">Permanent</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="i-checks">


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 display">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-6">
                                                <label>Reason For RTGS Enhancement</label>
                                                <input type="text" name="158" value=""
                                                    onclick="setparameterId('158',this.value,1,'6');">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 display">
                                        <div class="form-group row" style="">
                                            <div class="col-lg-6">
                                                <label>Previous Level of the checker Template Number</label>
                                                <input type="text" class="template_number_readonly" name="145"
                                                    value="{{ $user_form_data->designation }}"
                                                    onclick="setparameterId('145',this.value,1,'6');" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <?php 
                     
                     }  // end system 6 = rtgs condition
                     
                     
                  } // end if role 2 (HO Maker)

                        } // end foreach sys_para

                         ?>

                                </div>
                                <!-- For RTGS ends -->





                                <!-- checkbox Start -->
                                <div class="row">
                                    @foreach ($system_parameters as $sys_para)
                                        @if ($sl->id == $sys_para->system_id && $sys_para->system_id != '6')
                                            @if ($sys_para->para_type == 2)
                                                <div class="col-lg-4">
                                                    <div class="form-group row" style="">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <div class="i-checks">
                                                                <input name="{{ $sys_para->para_id }}"
                                                                    value="{{ $sys_para->para_id }}"
                                                                    id="parameter_id{{ $sys_para->para_id }}"
                                                                    type="checkbox"
                                                                    onclick="setparameterId('{{ $sys_para->para_id }}','chk',1,'{{ $sys_para->system_id }}')">

                                                                <label
                                                                    for="parameter_id{{ $sys_para->para_id }}">{{ $sys_para->para_name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <!-- checkbox ends -->


                                <!-- for input -->
                                <div class="row">
                                    @foreach ($system_parameters as $sys_para)
                                        @if ($sl->id == $sys_para->system_id && $sys_para->system_id != '6')
                                            @if ($sys_para->para_type == 1)
                                                <div class="col-lg-4">
                                                    <div class="form-group row" style="">
                                                        <div class="col-lg-6">
                                                            <label>{{ $sys_para->para_name }}:</label>
                                                            <input type="text" name="{{ $sys_para->para_id }}"
                                                                value=""
                                                                onchange="setparameterId('{{ $sys_para->para_id }}',this.value,1,'{{ $sys_para->system_id }}')">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <!-- input ends -->
                            </div>
                        </div> <!-- end ibox -->









                    </div>
                @endforeach
            </div>
            <!-- parameter ends -->
            <br>
            <div class="form-group wrapper wrapper-content animated fadeInRight" align="center">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-lg btn-info  fisrt_assign" type="button"
                        style="padding: 10px 15px 10px 15px">Submit</button>
                </div>
            </div>
            <br>
            <br>
        </form>
        <!-- form submission ends here -->
    </div>
@endsection('content')


@push('scripts')
    <script src="{{ asset('public/assets/custom-js/user-request-form/rtgs_enhancement.js') }}"></script>





    <script type="text/javascript">
        $(function() {
            enable_cb();


            $("#check8").click(enable_cb);
        });

        function enable_cb() {

            if (this.checked) {

                // $("div.check8").show(); 

                document.getElementById('para_list').style.display = 'none';
            } else

            {
                // $("div.check8").removeAttr("style").hide();
                document.getElementById('para_list').style.display = 'block';


            }
        }
    </script>


    <script>
        var checkbox = document.querySelectorAll("#check8");

        for (i = 0; i < checkbox.length; i++) {
            checkbox[i].onclick = function() {


                if (this.checked) {
                    document.getElementById(this.getAttribute('class')).style['display'] = 'none';

                } else {
                    document.getElementById(this.getAttribute('class')).style['display'] = 'block';
                }
            };
        }
    </script>



    <script>
        function setSystemId(sysId, action) //set system id or remove from list
        {

            if (action == 1) //add to list
            {
                var previousId = document.getElementById('systemList').value;
                if (previousId == '') {
                    var newIdList = sysId;
                } else {
                    var newIdList = previousId + "," + sysId;
                }
                document.getElementById('systemList').value = newIdList;
            } else //remove from list
            {
                var previousId = document.getElementById('systemList').value;
                if (previousId == null) {

                } else {
                    var array = previousId.split(",");
                    var newList = null;
                    for (let i = 0; i < array.length; i++) {
                        if (array[i] != sysId) {
                            if (newList == null)
                                newList = array[i];
                            else
                                newList = newList + "," + array[i];
                        }
                    }

                }
                document.getElementById('systemList').value = newList;
            }
        }

        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        function setRequestTypeId(requestTypeId, action, sysId) //set Request type id or remove from list
        {
            if (action == 1) //add to list
            {
                // alert(sysId+"----"+requestTypeId);
                var previous = document.getElementById('requestTypeList').value;
                var newString = null;
                if (previous == '') {
                    newString = sysId + "-" + requestTypeId;
                } else {
                    var sysSet = previous.split(",");
                    var sys = null;
                    for (let i = 0; i < sysSet.length; i++) {
                        sys = sysSet[i].split("-");
                        if (sys[1] == requestTypeId && sys[0] ==
                            sysId) //already request type clicked so now it will be removed 
                        {

                        } else if (sys[1] != requestTypeId && sys[0] == sysId) //new request type clicked
                        {
                            // sys=sysId+"-"+requestTypeId;
                            if (newString == null) {

                                newString = sysId + "-" + requestTypeId;
                            } else {
                                newString = newString + "," + sys[0] + "-" + requestTypeId;
                            }
                        } else {
                            if (newString == null) {
                                newString = sys[0] + "-" + sys[1];
                                newString = newString + "," + sysId + "-" + requestTypeId;
                            } else {
                                newString = newString + "," + sys[0] + "-" + sys[1];
                            }
                        }
                    }
                }
                var array = newString.split(",");
                var a = array.filter(onlyUnique);
                document.getElementById('requestTypeList').value = a.toString();
            } else {
                var sysSet = previous.split(",");
                var sys = null;
                for (let i = 0; i < sysSet.length; i++) {
                    sys = sysSet[i].split("-");
                    if (sys[0] == sysId) //already request type clicked so now it will be removed 
                    {

                    } else {
                        if (newString == null) {
                            newString = sys[0] + "-" + sys[1];
                            newString = newString + "," + sysId + "-" + requestTypeId;
                        } else {
                            newString = newString + "," + sys[0] + "-" + sys[1];
                        }
                    }
                }
                var array = newString.split(",");
                var a = array.filter(onlyUnique);
                document.getElementById('requestTypeList').value = a.toString();
            }

        }


        function setparameterId(parameterId, parameterVal, action, sysId) {


            var seletected_parameter_id = parameterId;



            if (action == 1) //add to list
            {

                var previous = document.getElementById('parameterList').value;


                //alert(sysId+"----"+parameterId+"----"+parameterVal+"#"+previous);
                var newString = null;
                if (previous == '') {
                    newString = sysId + "-" + parameterId + "-" + parameterVal;
                } else {
                    var sysSet = previous.split(",");
                    var sys = null;
                    if (sysSet.indexOf(sysId + "-" + parameterId + "-" + parameterVal) !== -1) {
                        var index = sysSet.indexOf(sysId + "-" + parameterId + "-" + parameterVal);
                        sysSet.splice(index, 1);
                        previous = sysSet.toString()
                        newString = previous
                    } else {
                        newString = previous + "," + sysId + "-" + parameterId + "-" + parameterVal
                    }
                    console.log(newString);
                    // for (let i = 0; i < sysSet.length; i++)
                    // {
                    //    sys=sysSet[i].split("-");
                    //    if(sys[1]==parameterId && sys[0]==sysId && sys[2]==parameterVal)//already request type clicked so now it will be removed 
                    //    {

                    //    }
                    //    else if(sys[1]!=parameterId && sys[0]==sysId && sys[2]==parameterVal)
                    //    {
                    //       if(newString==null)
                    //       {
                    //          newString=sys[0]+"-"+sys[1]+"-"+sys[2];
                    //          newString=newString+","+sysId+"-"+parameterId+"-"+parameterVal;

                    //       }
                    //       else
                    //       {
                    //          newString=newString+","+sys[0]+"-"+sys[1]+"-"+sys[2];

                    //       }
                    //    }
                    //    else
                    //    {
                    //       if(newString==null)
                    //       {
                    //          newString=sys[0]+"-"+sys[1]+"-"+sys[2];
                    //          newString=newString+","+sysId+"-"+parameterId+"-"+parameterVal;

                    //       }
                    //       else
                    //       {
                    //          newString=newString+","+sys[0]+"-"+sys[1]+"-"+sys[2];

                    //       }
                    //    }
                    // }
                }

                var array = newString.split(",");
                var a = array.filter(onlyUnique);

                var prameter_list = a.toString();

                // if seletected rtgs parmanent then remove 
                if (seletected_parameter_id == 144 || seletected_parameter_id == 1814 || seletected_parameter_id == 1815) {
                    parameter_list = removeRtgsDateTimePermanentFiledFromParameterList(prameter_list,
                        seletected_parameter_id);
                    console.log("hasan" + parameter_list);
                }

                document.getElementById('parameterList').value = prameter_list;


            } else {
                var sysSet = previous.split(",");
                var sys = null;
                for (let i = 0; i < sysSet.length; i++) {
                    sys = sysSet[i].split("-");
                    if (sys[0] == sysId) //already request type clicked so now it will be removed 
                    {

                    } else {
                        if (newString == null) {
                            newString = sys[0] + "-" + sys[1] + "-" + sys[2];

                        } else {
                            newString = newString + "," + sys[0] + "-" + sys[1] + "-" + sys[2];
                        }
                    }
                }


                document.getElementById('parameterList').value = newString;
            }
        }
        //console.log('document.querySelectorAll("<?php print $checkList; ?>")');
        var checkbox = document.querySelectorAll("<?php print $checkList; ?>");

        const colors = ["#ffb700", "#a3b0c2", "#ff6666", "#19b319", "#b300b3", "#3385ff", "#66cc66", "#206020", "#ffb700",
            "#a3b0c2", "#ffb700", "#a3b0c2"
        ];

        for (i = 0; i < checkbox.length; i++) {
            checkbox[i].onclick = function() {
                if (this.checked) {
                    var system_id = this.getAttribute('value');
                    setSystemId(system_id, 1)
                    document.getElementById(this.getAttribute('class')).style['display'] = 'block';
                    var request_id = ("#" + system_id + "_request_box");
                    $(request_id).attr('style', 'display: block');
                    var sl = 0;
                    $('.request_type_class').each(function() {
                        if ($(this).css('display') == 'block') {
                            var backgroun_color = colors[sl];
                            $(".request_background_color_" + system_id).css("background-color",
                                backgroun_color);
                            sl++;
                        }
                    });


                } else if (!this.checked) {
                    var system_id = this.getAttribute('value');
                    document.getElementById(this.getAttribute('class')).style['display'] = 'none';
                    var request_id = ("#" + system_id + "_request_box");

                    $(request_id).attr('style', 'display: none');

                    setSystemId(system_id, 0);
                    setRequestTypeId('', 0, system_id);
                    setparameterId('', '', 0, system_id);


                } else {
                    document.getElementById(this.getAttribute('class')).style['display'] = 'none';
                }
            };
        }

        function req_type_func(id, system_id) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            var formData = {

                system_id: system_id,

            };

            $.ajax({
                type: 'POST',
                url: "{{ url('get_sys_user_id_val') }}",
                data: formData,
                success: function(data) {


                    // console.log(data);

                    // $("#box"+data).css('display','none'); 
                    //  $('#'+system_id+"_box").css('display','block');
                    document.querySelector('#new_u_' + id).value = data;


                },
                error: function(response) {

                }
            });




            $("#box" + id).css('display', 'block');
            $('#' + system_id + "_box").css('display', 'none');
            setRequestTypeId(id, 1, system_id)





        }

        function request_type_hide(system_id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            var formData = {

                system_id: system_id,

            };

            $.ajax({
                type: 'POST',
                url: "{{ url('request_type_hide') }}",
                data: formData,
                success: function(data) {


                    // console.log(data);

                    $("#box" + data).css('display', 'none');
                    $('#' + system_id + "_box").css('display', 'block');

                },
                error: function(response) {
                    alert(response);
                    console.log(response);
                }
            });

        } // end -:- request_type_hide.
    </script>


    <script type="text/javascript">
        $(".fisrt_assign").click(function(e) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            $.ajax({
                type: 'POST',
                url: "{{ url('my_branch_assgin_person') }}",

                success: function(data) {


                    // console.log(data);

                    $('.halimmodal_for_assign_person').modal('show');
                    $('.modal-body').html(data.html);

                },
                error: function(response) {
                    alert(response);
                    console.log(response);
                }
            });



        });
    </script>
    <!-- Custom function -->


    <script>
        $(".display").css('display', 'none');

        $(".mcr").css('display', '');

        $(".display_tmp_exp_date").css('display', 'none');
        $(".display_permanent").css('display', 'none');


        function requestSectionHide(id, system_id, request_type_name) {
            if (system_id == '6' && request_type_name == 'Enhancement') {

                $(".display").css('display', '');

                $(".mcr").css('display', 'none');

                $(".display_tmp_exp_date").css('display', '');
                $(".display_tmp_exp_time").css('display', '');
                $(".display_permanent").css('display', '');


            } else if (system_id == '6' && request_type_name != 'Enhancement') {


                $(".display").css('display', 'none');

                $(".mcr").css('display', '');

                $(".display_tmp_exp_date").css('display', 'none');
                $(".display_tmp_exp_time").css('display', 'none');
                $(".display_permanent").css('display', 'none');



            }
        }
    </script>

    <!-- request  type input field hide -->
    <script>
        function requestSectionHide2(id, system_id, requestTypeName) {
            // alert(id);
            //     alert(system_id);
            //     alert(requestTypeName);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            var formData = {
                id: id,
                system_id: system_id,
                requestTypeName: requestTypeName
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('request_type_parameter_show_hide') }}",
                data: formData,
                success: function(data) {
                    var myjson = JSON.parse(data);
                    //alert(myjson.system_id);
                    console.log(myjson);


                    if (myjson.input_id != null && myjson.input_show == '0') {

                        $("#box" + myjson.input_id).css('display', 'none');
                    }




                },
                error: function(response) {
                    alert(response);
                    console.log(response);
                }
            });

        }
    </script>
    <!-- request  type input field hide -->



    <!-- for ajax -->
    <script type="text/javascript">
        $(".bat").click(function(e) {

            // var test = $("#rtgs_tmp_exp_datetime").val();

            // alert(test);return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });




            var queryString = $("#sys_form").serialize();



            // console.log(queryString);

            //      alert("asdsad");
            // return false; 
            var sysList = document.getElementById('systemList').value;
            var requestList = document.getElementById('requestTypeList').value;
            var parameterList = document.getElementById('parameterList').value;





            var formData = {
                'form_serialize_data': queryString,
                'sysList': sysList,
                'requestList': requestList,
                'parameterList': parameterList,

            };


            $.ajax({
                type: 'POST',
                url: "{{ route('my-data') }}",
                data: formData,



                beforeSend: function() {
                    jQuery(".loader").show();
                },

                success: function(data) {
                    console.log(data);



                    var splitStr = data.split("<>");



                    if (splitStr[0] == 0) {
                        cuteAlert({
                            type: "warning",
                            title: "User Request Failed",
                            message: splitStr[1],
                            buttonText: "Okay",
                            timer: 10000
                        })

                    } else {
                        console.log(data);


                        cuteAlert({
                            type: "success",
                            title: "Your Request Is Sent !",
                            message: "",
                            buttonText: "Okay"
                        }).then((e) => {

                            location.reload(true);

                        });
                    }





                },
                error: function(response) {

                    //console.log(response.success_requesttype);

                    cuteAlert({
                        type: "warning",
                        title: "Insert failed !",
                        message: "Please Select System and  Request Type or Parameter ",
                        buttonText: "Okay",
                        timer: 10000
                    })


                    // location.reload();
                },

                complete: function() {

                    jQuery(".loader").hide();
                }

            });




        });
    </script>
@endpush
