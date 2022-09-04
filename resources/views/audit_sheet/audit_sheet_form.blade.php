@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User Audit Sheet</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Audit Sheet Form</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection




    @section('content')

    <!-- loader part -->
   <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div>
  <!-- loader part ends -->


   
  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User Audit Sheet</h5>
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

                            

                            <form action="{{ url('audit_sheet_form_submit') }}" method="POST" name="auditForm" id="auditForm">
                               @csrf

                               <h4 class="text-center"><b>User Access Audit Sheet Acknowledgement Form</b></h4>

                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label">Email To:</label>

                                    <div class="col-lg-8"><input type="text" placeholder="" class="form-control" name="email_to" id="email_to" required> 
                                    </div>

                                </div>
                                <br>
                                 <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Branch Name:</label>

                                    <div class="col-lg-4">
                                        <!-- <input type="text" placeholder="Branch Name" class="form-control" name="branch_name"> -->

                                        <select class="form-control select2" name="branch_name" id="branch_name" onchange="get_sub_br(this.value);" required="">

                                            <option value="">--select--</option>
                                          <?php 

                                           $branch_data = DB::table('branch_info')->where('brinfo_flag',1)->get();

                                           foreach($branch_data as $single_branch_data){
                                            ?>


                                            <option value="<?php echo $single_branch_data->bnk_br_id; ?>"><?php echo $single_branch_data->name; 
                                            echo" ($single_branch_data->bnk_br_id)"; ?></option>
                                            <?php
                                           }
                                          ?>
                                        </select>
                                    </div>

                                  
                                </div>


                                <div class="form-group row division" style="display:none;">
                                    <label class="col-lg-2 col-form-label">Division Name:</label>

                                    <div class="col-lg-4">
                                        <select class="form-control select2" name="division_name" id="division_name" style="width: 100%;">

                                            <option value="">--select--</option>
                                            <?php

                                            $division_data = DB::table('division')->get();

                                            foreach($division_data as $single_division_data){

                                                ?>

                                           
                                            
                                            <option value="{{$single_division_data->division}}">{{$single_division_data->division}}</option>

                                            <?php 

                                             }

                                             ?>
                                        </select>

                                    </div>

                                </div>


                                  <div class="form-group row sub_branch" >
                                   

                                </div>

                                <div class="form-group row">

                                <label class="col-lg-2 col-form-label">Branch Code:</label>

                                    <div class="col-lg-4">
                                        <input type="text"  class="form-control" name="branch_code" id="branch_code" readonly="">
                                    </div>


                                    <div class="col-lg-4">
                                        <label><b>Date : </b></label>
                                        <input type="text"  name="date" 
                                        value="" required="" class="datepicker-1" id="just_date">
                                    </div>

                                </div>

                                <div class="form-group row"><label class="col-lg-2 col-form-label">Received Date:</label>

                                    <div class="col-lg-4">

                                        <input type="text" id="select_date"  class="form-control datepicker-1" name="received_date" required="">
                                    </div>

                                  
                                </div>

                            <p>   Dear Sir, <br>
Thank you for providing <b>User Access Audit Sheet</b> for the month of <b><span id="previous_mnth">{{ date('M,Y', strtotime('-1 month')) }} </span> <input type="hidden" name="previous_mnth" class="previous_mnth"></b> 
We have received user access audit sheet from your Branch/Division for following systems:</p>

    
    {{-- &nbsp; --}}
    <label class="checkbox-inline">
      <input type="checkbox" value="1" name="UBS" id="UBS" onclick="ubs_click();">&nbsp; UBS
    </label>

      &nbsp;
    <label class="checkbox-inline">
      <input type="checkbox" value="6" name="RTGS" id="RTGS" onclick="rtgs_click();">&nbsp; RTGS
    </label>

     &nbsp;
    <label class="checkbox-inline">
      <input type="checkbox" value="4" name="CPS" id="CPS" onclick="cps_click();">&nbsp; CPS
    </label>

    &nbsp;
    <label class="checkbox-inline">
      <input type="checkbox" value="5" name="EFTN" id="EFTN" onclick="eftn_click();">&nbsp; EFTN
    </label>

   
        &nbsp;
     <label class="checkbox-inline">

      <input type="checkbox" value="1012" id="GEFU" name="GEFU" onclick="gefu_click();">&nbsp; GEFU

    </label> 

    
    <!--&nbsp;

    <label class="checkbox-inline">

      <input type="checkbox" value="1002" id="Passport" name="Passport" 
      onclick="passport_click();">&nbsp; Passport

    </label>-->
    
    &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1001" id="BKash" name="BKash" onclick="bkash_click();">&nbsp; BKash

    </label>

    &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1003" id="Utility_Bill" name="Utility_Bill" onclick="utility_click();">&nbsp; Utility_Bill

    </label>

     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="2" id="remitbook" name="remitbook" onclick="remitbook_click();">&nbsp; RemitBook

    </label>

     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1004" id="docudex" name="docudex" onclick="docudex_click();">&nbsp; Docudex

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1005" id="csms" name="csms" onclick="csms_click();">&nbsp; CSMS

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1013" id="nsmart" name="nsmart" onclick="nsmart_click();">&nbsp; nScreen And nSmart

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1018" id="land" name="land" onclick="land_click();">&nbsp; E-landing

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1014" id="call_center" name="call_center" onclick="call_center_click();">&nbsp; Call Center System

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1011" id="tp_kyc" name="tp_kyc" onclick="tp_kyc_click();">&nbsp;TP & KYC System

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1026" id="cpc" name="cpc" onclick="cpc_click();">&nbsp;CPC Plus

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1025" id="solution" name="solution" onclick="solution_click();">&nbsp;C Solution

    </label>
     &nbsp;
    <label class="checkbox-inline">

      <input type="checkbox" value="1020" id="automated" name="automated" onclick="automated_click();">&nbsp;Automated Challan System

    </label>
     &nbsp;
        <label class="checkbox-inline">

          <input type="checkbox" value="3" id="dbcube" name="dbcube"
           onclick="dbcube_click();">&nbsp; New_Dbcube
        </label>


<br>
<br>
     
    <label class="checkbox-inline">
         <b>Change Requested :  </b>

      <input type="checkbox" value="Yes" id="change_req_yes" onclick="check_request()" name="change_req_yes">&nbsp; <label for="change_req_yes">Yes</label>

      <input type="checkbox" value="No" id="change_req_no" onclick="uncheck_request()" name="change_req_no">&nbsp; <label for="change_req_no">NO</label> 

    </label>

<br>

       <label class="checkbox-inline">
         <b>Change Executed : &nbsp; </b>
         
      <input type="checkbox" value="Yes" id="change_exe_yes" onclick="check_execute()" name="change_exe_yes">&nbsp; <label for="change_exe_yes">Yes</label> 
      <input type="checkbox" value="No" id="change_exe_no" onclick="uncheck_execute()" name="change_exe_no">&nbsp; <label for="change_exe_no">NO</label>

    </label>

    <p>As per your request we have made following changes:</p>



    <div style="display:none;"   id="div_ubs">
        
        <h4>UBS</h4>
    <table class="table table-bordered">
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>ACTIONS</th>
            <th>Disable Period</th>
            <th>REMARKS</th>
            <th><a href="javascript:void(0);" class="add_button_ubs" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
        </tr>
        <tbody class="field_wrapper_ubs">
            
        </tbody>
    </table>


    </div>
    

    <div style="display:none;" id="rtgs_div">
        
        <br>
        <h4>RTGS</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_rtgs" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_rtgs">
                
            </tbody>
        </table>

     </div>



    <div style="display:none;" id="cps_div">
        <h4>CPS</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_cps" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_cps">
                
            </tbody>
        </table>
    </div>
  

    <div style="display:none;" id="remitbook_div">
        <h4>Remit Book</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_remitbook" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_remitbook">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="docudex_div">
        <h4>Docudex</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_docudex" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_docudex">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="csms_div">
        <h4>CSMS</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_csms" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_csms">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="nsmart_div">
        <h4>nScreen And nSmart</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_nsmart" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_nsmart">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="land_div">
        <h4>E-lending</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_land" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_land">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="call_center_div">
        <h4>E-call_centering</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_call_center" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_call_center">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="tp_kyc_div">
        <h4>TP & KYC System</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_tp_kyc" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_tp_kyc">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="cpc_div">
        <h4>CPC Plus</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_cpc" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_cpc">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="solution_div">
        <h4>C Solution</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_solution" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_solution">
                
            </tbody>
        </table>

    </div>
    <div style="display:none;" id="automated_div">
        <h4>Automated Challan System</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_automated" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_automated">
                
            </tbody>
        </table>

    </div>



    <div style="display:none;" id="dbcube_div">
        <h4>New DB cube</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_dbcube" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_dbcube">
                
            </tbody>
        </table>

    </div>

    <br>

    <div style="display:none;" id="gefu_div">
        <h4>GEFU</h4>
        <table class="table table-bordered">
            <tr>
                <th>USER ID</th>
                <th>NAME</th>
                <th>ACTIONS</th>
                <th>Disable Period</th>
                <th>REMARKS</th>
                <th><a href="javascript:void(0);" class="add_button_gefu" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
            </tr>
            <tbody class="field_wrapper_gefu">
                
            </tbody>
        </table>

    </div>


    <div style="display:none;" id="eftn_div">
    <h4>EFTN</h4>
    <table class="table table-bordered">
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>ACTIONS</th>
            <th>Disable Period</th>
            <th>REMARKS</th>
            <th><a href="javascript:void(0);" class="add_button_eftn" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
        </tr>

        <tbody class="field_wrapper_eftn">
            
        </tbody>
    </table>

    </div>


    <div style="display:none;" id="passport_div">
    <h4>Passport</h4>
    <table class="table table-bordered">
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>ACTIONS</th>
            <th>Disable Period</th>
            <th>REMARKS</th>
            <th><a href="javascript:void(0);" class="add_button_passport" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
        </tr>

        <tbody class="field_wrapper_passport">
            
        </tbody>
    </table>

    </div>

    <div style="display:none;" id="bkash_div">
    <h4>Bkash</h4>
    <table class="table table-bordered">
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>ACTIONS</th>
            <th>Disable Period</th>
            <th>REMARKS</th>
            <th><a href="javascript:void(0);" class="add_button_bkash" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
        </tr>

        <tbody class="field_wrapper_bkash">
            
        </tbody>
    </table>

    </div>

    <div style="display:none;" id="utility_div">
    <h4>Utility</h4>
    <table class="table table-bordered">
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>ACTIONS</th>
            <th>Disable Period</th>
            <th>REMARKS</th>
            <th><a href="javascript:void(0);" class="add_button_utility" title="Add field"><img src="{{ asset('assets/img/add-icon.png') }}"/></a></th>
        </tr>

        <tbody class="field_wrapper_utility">
            
        </tbody>
    </table>

    </div>

    <p id="remarks_box"><b> Remarks: </b> <!-- <span class="all_system"> (UBS, RTGS, CPS, EFTN, GEFU, Passport, BKash, Utility Bill, Remit Book, New Dbcube) </span> -->
        
     Please note that we did not receive User Access Audit Sheet of  

         <span id="ubs_remarks">UBS,</span>
        <span id="rtgs_remarks">RTGS,</span>
        <span id="cps_remarks">CPS,</span>
        <span id="eftn_remarks">EFTN,</span>
        <span id="gefu_remarks">GEFU,</span>
        <!--<span id="passport_remarks">Passport,</span>-->
        <span id="bkash_remarks">BKash,</span>
        <span id="utility_bill_remarks">Utility Bill,</span>
        <span id="remitbook_remarks">Remit Book,</span>
        <span id="docudex_remarks">Docudex,</span>
        <span id="csms_remarks">CSMS,</span>
        <span id="nsmart_remarks">nScreen And nSmart,</span>
        <span id="land_remarks">E-lending,</span>
        <span id="call_center_remarks">Call Center System,</span>
        <span id="tp_kyc_remarks">TP & KYC System,</span>
        <span id="cpc_remarks">CPC Plus,</span>
        <span id="solution_remarks">C Solution,</span>
        <span id="automated_remarks">Automated Challan System,</span>
        <span id="dbcube_remarks">New Dbcube</span>. You are requested to send the
file as early as possible.</p>
<p><b> N:B: </b>
This is a auto generated document. No signature is required.
</p>
<br>
<br>
<hr>


    <address><b>Information Technology Division, 71, Purana Paltan Lane, Dhaka-1000, Bangladesh
Tel: 58314424, Fax: 880-2-58314419, Website: <a href="https://dhakabankltd.com/">www.dhakabankltd.com</a> ,E-mail :

<a href="">info@dhakabank.com.bd</a>
</b></address>

                             
                             <br>
                               
                                <div class="form-group row">
                                    <div class="offset-lg-5 col-lg-1">
                                        <!-- <input type="submit" name="submit" id="submitbtn"  class="btn btn-sm btn-success" value="submit"> -->

                                        <input type="button" name="submit_form1" id="submitbtn"  class="btn btn-sm btn-success" value="Submit Data" onclick="submit_form()"> 
                                       
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
  
     <!-- loader script -->
<script type="text/javascript">
        $(function(){
            setTimeout(()=>{
                $(".loader").fadeOut(500);
            },1000)
        });
    </script>
<!-- loader script ends -->

<script type="text/javascript">
    //for ubs
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_ubs'); //Add button selector
    var wrapper = $('.field_wrapper_ubs'); //Input field wrapper
    var fieldHTML = '<tr><td><input type="text" name="ubs_user_id[]" class="form-control"></td><td><input type="text" name="ubs_name[]" class="form-control"></td><td><input type="text" name="ubs_action[]" class="form-control"></td><td><input type="text" name="ubs_dbl_period[]" class="form-control"></td><td><input type="text" name="ubs_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_ubs" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_ubs', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for rtgs
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_rtgs'); //Add button selector
    var wrapper = $('.field_wrapper_rtgs'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="rtgs_user_id[]" class="form-control"></td><td><input type="text" name="rtgs_name[]" class="form-control"></td><td><input type="text" name="rtgs_action[]" class="form-control"></td><td><input type="text" name="rtgs_dbl_period[]" class="form-control"></td><td><input type="text" name="rtgs_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_rtgs" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_rtgs', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for cps
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_cps'); //Add button selector
    var wrapper = $('.field_wrapper_cps'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="cps_user_id[]" class="form-control"></td><td><input type="text" name="cps_name[]" class="form-control"></td><td><input type="text" name="cps_action[]"  class="form-control"></td><td><input type="text" name="cps_dbl_period[]" class="form-control"></td><td><input type="text" name="cps_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_cps" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_cps', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for Remitbook
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_remitbook'); //Add button selector
    var wrapper = $('.field_wrapper_remitbook'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="remitbook_user_id[]" class="form-control"></td><td><input type="text" name="remitbook_name[]" class="form-control"></td><td><input type="text" name="remitbook_action[]" class="form-control"></td><td><input type="text" name="remitbook_dbl_period[]" class="form-control"></td><td><input type="text" name="remitbook_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_remitbook" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_remitbook', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for Docudex
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_docudex'); //Add button selector
    var wrapper = $('.field_wrapper_docudex'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="docudex_user_id[]" class="form-control"></td><td><input type="text" name="docudex_name[]" class="form-control"></td><td><input type="text" name="docudex_action[]" class="form-control"></td><td><input type="text" name="docudex_dbl_period[]" class="form-control"></td><td><input type="text" name="docudex_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_docudex" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_docudex', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>

<script type="text/javascript">
    //for CSMS
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_csms'); //Add button selector
    var wrapper = $('.field_wrapper_csms'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="csms_user_id[]" class="form-control"></td><td><input type="text" name="csms_name[]" class="form-control"></td><td><input type="text" name="csms_action[]" class="form-control"></td><td><input type="text" name="csms_dbl_period[]" class="form-control"></td><td><input type="text" name="csms_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_csms" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_csms', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for nScreen And nSmart
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_nsmart'); //Add button selector
    var wrapper = $('.field_wrapper_nsmart'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="nsmart_user_id[]" class="form-control"></td><td><input type="text" name="nsmart_name[]" class="form-control"></td><td><input type="text" name="nsmart_action[]" class="form-control"></td><td><input type="text" name="nsmart_dbl_period[]" class="form-control"></td><td><input type="text" name="nsmart_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_nsmart" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_nsmart', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for E-landing
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_land'); //Add button selector
    var wrapper = $('.field_wrapper_land'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="land_user_id[]" class="form-control"></td><td><input type="text" name="land_name[]" class="form-control"></td><td><input type="text" name="land_action[]" class="form-control"></td><td><input type="text" name="land_dbl_period[]" class="form-control"></td><td><input type="text" name="land_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_land" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_land', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for Call Center System
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_call_center'); //Add button selector
    var wrapper = $('.field_wrapper_call_center'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="call_center_user_id[]" class="form-control"></td><td><input type="text" name="call_center_name[]" class="form-control"></td><td><input type="text" name="call_center_action[]" class="form-control"></td><td><input type="text" name="call_center_dbl_period[]" class="form-control"></td><td><input type="text" name="call_center_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_call_center" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_call_center', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for TP & KYC System
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_tp_kyc'); //Add button selector
    var wrapper = $('.field_wrapper_tp_kyc'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="tp_kyc_user_id[]" class="form-control"></td><td><input type="text" name="tp_kyc_name[]" class="form-control"></td><td><input type="text" name="tp_kyc_action[]" class="form-control"></td><td><input type="text" name="tp_kyc_dbl_period[]" class="form-control"></td><td><input type="text" name="tp_kyc_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_tp_kyc" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_tp_kyc', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>

<script type="text/javascript">
    //for CPC Plus
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_cpc'); //Add button selector
    var wrapper = $('.field_wrapper_cpc'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="cpc_user_id[]" class="form-control"></td><td><input type="text" name="cpc_name[]" class="form-control"></td><td><input type="text" name="cpc_action[]" class="form-control"></td><td><input type="text" name="cpc_dbl_period[]" class="form-control"></td><td><input type="text" name="cpc_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_cpc" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_cpc', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for C Solution
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_solution'); //Add button selector
    var wrapper = $('.field_wrapper_solution'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="solution_user_id[]" class="form-control"></td><td><input type="text" name="solution_name[]" class="form-control"></td><td><input type="text" name="solution_action[]" class="form-control"></td><td><input type="text" name="solution_dbl_period[]" class="form-control"></td><td><input type="text" name="solution_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_solution" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_solution', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>
<script type="text/javascript">
    //for Automated Challan System
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_automated'); //Add button selector
    var wrapper = $('.field_wrapper_automated'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="automated_user_id[]" class="form-control"></td><td><input type="text" name="automated_name[]" class="form-control"></td><td><input type="text" name="automated_action[]" class="form-control"></td><td><input type="text" name="automated_dbl_period[]" class="form-control"></td><td><input type="text" name="automated_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_automated" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_automated', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for DBCube
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_dbcube'); //Add button selector
    var wrapper = $('.field_wrapper_dbcube'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="dbcube_user_id[]" class="form-control"></td><td><input type="text" name="dbcube_name[]" class="form-control"></td><td><input type="text" name="dbcube_action[]" class="form-control"></td><td><input type="text" name="dbcube_dbl_period[]" class="form-control"></td><td><input type="text" name="dbcube_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_dbcube" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_dbcube', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for GEFU
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_gefu'); //Add button selector
    var wrapper = $('.field_wrapper_gefu'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="gefu_user_id[]" class="form-control"></td><td><input type="text" name="gefu_name[]" class="form-control"></td><td><input type="text" name="gefu_action[]" class="form-control"></td><td><input type="text" name="gefu_dbl_period[]"  class="form-control"></td><td><input type="text" name="gefu_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_gefu" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_gefu', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<script type="text/javascript">
    //for eftn
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_eftn'); //Add button selector
    var wrapper = $('.field_wrapper_eftn'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="eftn_user_id[]" class="form-control"></td><td><input type="text" name="eftn_name[]" class="form-control"></td><td><input type="text" name="eftn_action[]" class="form-control"></td><td><input type="text" name="eftn_dbl_period[]" class="form-control"></td><td><input type="text" name="eftn_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_eftn" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_eftn', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>

<!-- for passport -->
<script type="text/javascript">
    //for passport
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_passport'); //Add button selector
    var wrapper = $('.field_wrapper_passport'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="passport_user_id[]" class="form-control"></td><td><input type="text" name="passport_name[]" class="form-control"></td><td><input type="text" name="passport_action[]" class="form-control"></td><td><input type="text" name="passport_dbl_period[]" class="form-control"></td><td><input type="text" name="passport_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_passport" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_passport', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<!-- for Bkash -->
<script type="text/javascript">
    //for Bkash
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_bkash'); //Add button selector
    var wrapper = $('.field_wrapper_bkash'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="bkash_user_id[]" class="form-control"></td><td><input type="text" name="bkash_name[]" class="form-control"></td><td><input type="text" name="bkash_action[]" class="form-control"></td><td><input type="text" name="bkash_dbl_period[]" class="form-control"></td><td><input type="text" name="bkash_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_bkash" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_bkash', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>


<!-- for Utility -->
<script type="text/javascript">
    //for Utility
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_utility'); //Add button selector
    var wrapper = $('.field_wrapper_utility'); //Input field wrapper

    var fieldHTML = '<tr><td><input type="text" name="utility_user_id[]" class="form-control"></td><td><input type="text" name="utility_name[]" class="form-control"></td><td><input type="text" name="utility_action[]" class="form-control"></td><td><input type="text" name="utility_dbl_period[]"  class="form-control"></td><td><input type="text" name="utility_remarks[]" class="form-control"></td><td><a href="javascript:void(0);" class="remove_button_utility" title="Remove"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td></tr>'; //New input field html 

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_utility', function(e){
        // alert("dok");
        e.preventDefault();
        $(this).closest("tr").remove();
        console.table(data);
        x--; //Decrement field counter
    });

});
</script>




<script type="text/javascript">
    
    function ubs_click() {

       if($('input#UBS').is(':checked'))
        {
            $('#div_ubs').show();
            $("#ubs_remarks").hide();
            
        }else{
            $('#div_ubs').hide();
             $("#ubs_remarks").show();
             
        }

        checkAllCheckedItem();

    }

    

    function rtgs_click() {

       if($('input#RTGS').is(':checked'))
        {
            $('#rtgs_div').show();
             $("#rtgs_remarks").hide();
            
        }else{
            $('#rtgs_div').hide();
            $("#rtgs_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function cps_click() {
       if($('input#CPS').is(':checked'))
        {
            $('#cps_div').show();
             $("#cps_remarks").hide();
            
        }else{
            $('#cps_div').hide();
            $("#cps_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function eftn_click() {
       if($('input#EFTN').is(':checked'))
        {
            $('#eftn_div').show();
             $("#eftn_remarks").hide();
            
        }else{
            $('#eftn_div').hide();
              $("#eftn_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function gefu_click(){
        if($('input#GEFU').is(':checked'))
        {
            $('#gefu_div').show();
            $("#gefu_remarks").hide();
            
        }else{
            $('#gefu_div').hide();
              $("#gefu_remarks").show();
             
        }

        checkAllCheckedItem();
    }


    function remitbook_click(){
        if($('input#remitbook').is(':checked'))
        {
            $('#remitbook_div').show();
            $("#remitbook_remarks").hide();
            
        }else{
            $('#remitbook_div').hide();
             $("#remitbook_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function docudex_click(){
        if($('input#docudex').is(':checked'))
        {
            $('#docudex_div').show();
            $("#docudex_remarks").hide();
            
        }else{
            $('#docudex_div').hide();
             $("#docudex_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function csms_click(){
        if($('input#csms').is(':checked'))
        {
            $('#csms_div').show();
            $("#csms_remarks").hide();
            
        }else{
            $('#csms_div').hide();
             $("#csms_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function nsmart_click(){
        if($('input#nsmart').is(':checked'))
        {
            $('#nsmart_div').show();
            $("#nsmart_remarks").hide();
            
        }else{
            $('#nsmart_div').hide();
             $("#nsmart_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function land_click(){
        if($('input#land').is(':checked'))
        {
            $('#land_div').show();
            $("#land_remarks").hide();
            
        }else{
            $('#land_div').hide();
             $("#land_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function call_center_click(){
        if($('input#call_center').is(':checked'))
        {
            $('#call_center_div').show();
            $("#call_center_remarks").hide();
            
        }else{
            $('#call_center_div').hide();
             $("#call_center_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function tp_kyc_click(){
        if($('input#tp_kyc').is(':checked'))
        {
            $('#tp_kyc_div').show();
            $("#tp_kyc_remarks").hide();
            
        }else{
            $('#tp_kyc_div').hide();
             $("#tp_kyc_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function cpc_click(){
        if($('input#cpc').is(':checked'))
        {
            $('#cpc_div').show();
            $("#cpc_remarks").hide();
            
        }else{
            $('#cpc_div').hide();
             $("#cpc_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function solution_click(){
        if($('input#solution').is(':checked'))
        {
            $('#solution_div').show();
            $("#solution_remarks").hide();
            
        }else{
            $('#solution_div').hide();
             $("#solution_remarks").show();
             
        }

        checkAllCheckedItem();
    }
    function automated_click(){
        if($('input#automated').is(':checked'))
        {
            $('#automated_div').show();
            $("#automated_remarks").hide();
            
        }else{
            $('#automated_div').hide();
             $("#automated_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function dbcube_click(){

        if($('input#dbcube').is(':checked'))
        {
            $('#dbcube_div').show();
             $("#dbcube_remarks").hide();
            
        }else{
            $('#dbcube_div').hide();
            $("#dbcube_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function bkash_click()
    {
        if($('input#BKash').is(':checked'))
        {
            $('#bkash_div').show();
             $("#bkash_remarks").hide();
            
        }else{
            $('#bkash_div').hide();
              $("#bkash_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function passport_click()
    {
        if($('input#Passport').is(':checked'))
        {
            $('#passport_div').show();
             $("#passport_remarks").hide();
            
        }else{
            $('#passport_div').hide();
             $("#passport_remarks").show();
             
        }

        checkAllCheckedItem();
    }

    function utility_click()
    {
        if($('input#Utility_Bill').is(':checked'))
        {
            $('#utility_div').show();
             $("#utility_bill_remarks").hide();
            
        }else{
            $('#utility_div').hide();
             $("#utility_bill_remarks").show();
             
        }

        checkAllCheckedItem();
    }


    //date script 

    $('#select_date').on('change', function(){
        
         var select_date = $('#select_date').val();

        const current = new Date(select_date);
        current.setMonth(current.getMonth()-1);
        const previousMonth = current.toLocaleString('default', { month: 'long' });
        var year = current.getFullYear();

        $('#previous_mnth').html(previousMonth+','+year);
        $('.previous_mnth').val(previousMonth+','+year);
        
       /* console.log(previousMonth+''+year);*/ // "September"
        
    });


</script>

<!-- checkbox single check -->
<script type="text/javascript">

   function check_request()
   {
     $('#change_req_no').prop('checked', false);
   }

    function uncheck_request()
   {
     $('#change_req_yes').prop('checked', false);
   }


   function check_execute()
   {
     $('#change_exe_no').prop('checked', false);
   }

    function uncheck_execute()
   {
     $('#change_exe_yes').prop('checked', false);
   }
    
</script>

<!-- get  branch_code --> 
<script type="text/javascript">
    $('#branch_name').on('change', function(){

         var branch_id = $('#branch_name').val();

         $.ajax({
            type:'post',
            url:" {{ url('get_branch_code') }} ",
            data:{
                 "_token": "{{ csrf_token() }}",
                 "branch_id": branch_id
             }, 

            success:function(data)
            {
                var result = JSON.parse(data);
               
                $('#branch_code').val(result.bnk_br_id);

             

              if (result.bnk_br_id=='202') {



                 $(".division").attr('style',  "display:''");

                 $("#division_name").attr('required','required');

              }else if(result.bnk_br_id !='202'){

                 $(".division").attr('style',  'display:none');
                  $("#division_name").removeAttr('required');
                 
              }
                //$('#branch_code').prop('disabled', true);
                //console.log(result.bnk_br_id);

            } 
         })

    });


    function get_sub_br(branch_code){
       
             $.ajax({
            type:'post',
            url:" {{ url('get_sub_branch') }} ",
            data:{
                 "_token": "{{ csrf_token() }}",
                 "branch_code": branch_code
             }, 

            success:function(data)
            {

               if (data) {

                    $(".sub_branch").html(data.html);
               }else{

                $(".sub_branch").html('');
               }
            

            } 

         })
    }





function submit_form(){

var email_to = $("#email_to").val();


if (email_to==null || email_to=='') {

            cuteAlert({
                      type: "warning",
                      title: "Please Enter Email",
                      message: "",
                      buttonText: "Okay"
                    });

            return false;

}

var branch_name = $("#branch_name").val();


if (branch_name==null || branch_name=='') {

            cuteAlert({
                      type: "warning",
                      title: "Please Select a Branch",
                      message: "",
                      buttonText: "Okay"
                    });

            return false;

}

var division_name = $("#division_name").val();

if (branch_name=='202' && (division_name=='' || division_name==null)  ) {

            cuteAlert({
                      type: "warning",
                      title: "Please Select a Division",
                      message: "",
                      buttonText: "Okay"
                    });

            return false;

}

var just_date = $("#just_date").val();


if (just_date==null || just_date=='') {

            cuteAlert({
                      type: "warning",
                      title: "Please Select Date",
                      message: "",
                      buttonText: "Okay"
                    });

            return false;
}

var select_date = $("#select_date").val();

if (select_date==null || select_date=='') {

            cuteAlert({
                      type: "warning",
                      title: "Please Select Received Date",
                      message: "",
                      buttonText: "Okay"
                    });

            return false;
}


 var UBS =$('#UBS').is(':checked');

 var RTGS = $("#RTGS").is(':checked');
 var EFTN = $("#EFTN").is(':checked');
 var GEFU = $("#GEFU").is(':checked');
 var Passport = $("#Passport").is(':checked');
 var BKash = $("#BKash").is(':checked');
 var Utility_Bill = $("#Utility_Bill").is(':checked');
 var remitbook = $("#remitbook").is(':checked');
 var docudex = $("#docudex").is(':checked');
 var csms = $("#csms").is(':checked');
 var nsmart = $("#nsmart").is(':checked');
 var land = $("#land").is(':checked');
 var call_center = $("#call_center").is(':checked');
 var tp_kyc = $("#tp_kyc").is(':checked');
 var cpc = $("#cpc").is(':checked');
 var c_solution = $("#solution").is(':checked');
 var automated_challan = $("#automated").is(':checked');
 var dbcube = $("#dbcube").is(':checked');
 var change_req_yes=$("#change_req_yes").is(':checked');
 var change_req_no=$("#change_req_no").is(':checked');
 var change_exe_yes=$("#change_exe_yes").is(':checked');
 var change_exe_no=$("#change_exe_no").is(':checked');
 //alert(UBS);

 if (UBS===false &&  RTGS===false  &&  EFTN===false &&  GEFU===false &&  Passport===false &&  BKash===false &&  Utility_Bill===false &&  remitbook===false && docudex===false && csms===false && nsmart===false && land===false && call_center===false && tp_kyc===false && cpc===false && c_solution===false && automated_challan===false && dbcube===false) {
                cuteAlert({
                      type: "warning",
                      title: "Please Select at least 1 System",
                      message: "",
                      buttonText: "Okay"
                    });
   
return false;
 }
 else if(change_req_no===false && change_req_yes===false)
 {
    cuteAlert({
                      type: "warning",
                      title: "Please Select Change Request Yes/No",
                      message: "",
                      buttonText: "Okay"
                    });
 }
 else if(change_exe_yes===false && change_exe_no===false)
 {
    cuteAlert({
                      type: "warning",
                      title: "Please Select Change Executed Yes/No",
                      message: "",
                      buttonText: "Okay"
                    });
 }
 else
 {
    document.forms["auditForm"].submit();
 }



}


function checkAllCheckedItem() {
			console.log('ok');
            var UBS = $('#UBS').is(':checked');
            var RTGS = $("#RTGS").is(':checked');
            var EFTN = $("#EFTN").is(':checked');
            var GEFU = $("#GEFU").is(':checked');
            // var Passport = $("#Passport").is(':checked');
            var cps = $("#CPS").is(':checked');
            var BKash = $("#BKash").is(':checked');
            var Utility_Bill = $("#Utility_Bill").is(':checked');
            var remitbook = $("#remitbook").is(':checked');
            var docudex = $("#docudex").is(':checked');
            var csms = $("#csms").is(':checked');
            var nsmart = $("#nsmart").is(':checked');
            var land = $("#land").is(':checked');
            var call_center = $("#call_center").is(':checked');
            var tp_kyc = $("#tp_kyc").is(':checked');
            var cpc = $("#cpc").is(':checked');
            var c_solution = $("#solution").is(':checked');
            var automated_challan = $("#automated").is(':checked');
            var dbcube = $("#dbcube").is(':checked');

            if (UBS === true && RTGS === true && EFTN === true && GEFU === true && BKash === true && cps === true &&
                Utility_Bill === true && remitbook === true && docudex === true && csms === true && nsmart === true &&
                land === true && call_center === true && tp_kyc === true && cpc === true && c_solution === true &&
                automated_challan === true && dbcube === true) {
                $("#remarks_box").hide();
            } else {
                $("#remarks_box").show();
            }

        }
   
   
</script>


 @if(session()->has('response'))
                <script type="text/javascript">
                     cuteAlert({
                      type: "success",
                      title: "Successfully Inserted !",
                      message: "",
                      buttonText: "Okay"
                    });
                </script>
            @endif

@endpush