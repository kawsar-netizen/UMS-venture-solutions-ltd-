@extends('layouts.app')


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





@section('content')



<div class="container">

@if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 2rem">
            <i class="fas fa-check fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 2rem">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<div class="p-2 mb-2" align="center" style="background-color: #e9ecef;"><b>User Request Form</b></div>
<br>


<form action="{{route('br-user')}}" method="post" enctype="multipart/form-data">
@csrf
<!-- information details -->

<div class="row wrapper white-bg page-heading">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>User Information Details</b></a>
                    </li>
                </ol>
            </div>
        </div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-6">
      <b>User ID :</b>
      <br>Employee ID :
      <br>Branch :
      <br>Email :
    </div>

    <div class="col-lg-6">
      <b>Domain ID :</b>
      <br>Employee Name :
      <br>Designation :
      <br>Mobile :
    </div>
  </div>
</div>

<!-- information details ends -->








<!-- operation category -->

<div class="row wrapper white-bg page-heading">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>Operation Category</b></a>
                    </li>
                </ol>
            </div>
        </div>




<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">



                       
                            
                            <div class="row"> 

                          <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check1" name="ubs" class="box" type="checkbox"> <label>UBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="pbm" type="checkbox"> <label>PBM </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check3" name="cps" class="box3" type="checkbox"> <label>CPS2 </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check4" name="beftn" class="box4" type="checkbox"> <label>BEFTN </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check2" name="rtgs" type="checkbox" class="box2"> <label>RTGS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="docudex" type="checkbox"> <label>Docudex</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newdbcube" id="check5" class="box5" type="checkbox"> <label>New DBcube </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rbs" type="checkbox"> <label>RBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="gefu" type="checkbox"> <label>GEFU </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="directbank" id="check7" class="box7" type="checkbox"> <label>Direct Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="bkash" id="check6" class="box6" type="checkbox"> <label>Bkash</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="portal" type="checkbox"> <label>Portal</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rit" type="checkbox"> <label>RIT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="forex" type="checkbox"> <label>FOREX </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="csms" type="checkbox"> <label>CSMS </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passport" type="checkbox"> <label>PASSPORT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="nscreen" type="checkbox"> <label>N SCREEN</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="swift" type="checkbox"> <label>SWIFT</label></div>
                                    </div>
                                </div>
                              
                            </div>



                            </div>  
                        </div>
                    </div>
                </div>
            </div>
           
        </div>



<!-- operation category ends -->







<!-- request type -->


    <div class="row wrapper white-bg page-heading">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>Request Type</b></a>
                    </li>
                </ol>
            </div>
        </div>


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                            
                            <div class="row"> 
                            <div class="col-lg-12">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newidcreate" type="checkbox"> <label>New ID Creation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="amendment" type="checkbox"> <label>Amendment </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="transfer" type="checkbox"> <label>Transfer </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="enable" type="checkbox"> <label>Enable </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="disable" type="checkbox"> <label>Disable</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passreset" type="checkbox"> <label>Password Reset</label></div>
                                    </div>
                                </div>
                              
                            </div>
                            </div>  
                                
                        </div>
                    </div>
                </div>
            </div>
           
        </div>


<!-- request types end -->




<!-- for UBS -->

            
    <div class="wrapper wrapper-content animated fadeInRight" id="box" style="display: none;">
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>UBS</b></a>
                    </li>
                </ol>
            </div>
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manager" type="checkbox"> <label>Manager </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manops" type="checkbox"> <label>Manager OPS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="genralbank_ubs" type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="credit_ubs" type="checkbox"> <label>Credit </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="foreigntrade" type="checkbox"> <label>Foreign Trade</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash" type="checkbox"> <label>Teller/Cash</label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="view_ubs" type="checkbox"> <label>View </label></div>
                                    </div>
                                </div>

                            </div>

                          
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
           
        </div>

<!-- UBS ends -->

<br>




<!-- for RTGS -->

            
    <div class="wrapper wrapper-content animated fadeInRight" id="box2" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>RTGS</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="checker_rtgs" type="checkbox"> <label>Checker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="maker_rtgs" type="checkbox"> <label>Maker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="report_view_rtgs" type="checkbox"> <label>Report Viewer </label></div>
                                    </div>
                                </div>

                                  
                             </div>  
                              
                        </div>
                    </div>
                </div>
            </div>
           
        </div>        

</div>

<!-- RTGS ends -->











<!-- for CPS2 -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box3" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>CPS2</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="scanman" type="checkbox"> <label>Scan Man </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="outward_check_cps" type="checkbox"> <label>Outward Checker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="outward_make_cps" type="checkbox"> <label>Outward Maker </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="report_view_cps" type="checkbox"> <label>Report Viewer </label></div>
                                    </div>
                                </div>
                             </div>  
                              
                                

                            
                          


                        </div>
                    </div>
                </div>
            </div>
           
        </div>        

</div>

<!-- CPS2 ends -->







<!-- for BEFTN -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box4" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>BEFTN</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="maker_beftn" type="checkbox"> <label>Maker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="check_beftn" type="checkbox"> <label>Checker </label></div>
                                    </div>
                                </div>


                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="report_view_beftn" type="checkbox"> <label>Report Viewer </label></div>
                                    </div>
                                </div>
                             </div>  
                              
                                

                            
                          


                        </div>
                    </div>
                </div>
            </div>
           
        </div>        

</div>

<!-- BEFTN ends -->







<!-- for New DBCUBE -->

            
        <!-- <div class="wrapper wrapper-content animated fadeInRight" id="" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>New DBcube</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
              <div class="col-lg-12">
                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <div class=""><label><b>Domain User Id : </b></label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_bank_bkash" type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash_bkash" type="checkbox"> <label>Teller /Cash </label></div>
                                    </div>
                                </div>
              </div>
             
           
        </div>        

</div> -->

<!-- New DBCUBE ends -->






<!-- for BKASH -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box6" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>BKASH</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
              <div class="col-lg-12">
                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <div class=""><label><b>Domain User Id : </b></label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_bank_bkash" type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash_bkash" type="checkbox"> <label>Teller /Cash </label></div>
                                    </div>
                                </div>
              </div>
             
           
        </div>        

</div>

<!-- New Bkash ends -->












<!-- for Direct Banking -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box7" style="display: none;">
          
          <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>Direct Banking</b></a>
                    </li>
                </ol>
            
            </div>
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_client_admin_directbank" type="checkbox"> <label>General Client Admin </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="user_submit_directbank" type="checkbox"> <label>User Submit </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="lock_unlock_client" type="checkbox"> <label>Lock Unlock Client </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="client_activation_maker" type="checkbox"> <label>Client Activation Maker </label></div>
                                    </div>
                                </div>
                                 
                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="client_activation_checker" type="checkbox"> <label>Client Activation Checker</label></div>
                                    </div>
                                </div>

                             </div>  
                              
                                

                            <div class="col-lg-6">
                                  
                                  

                                 <!-- <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_admin_foradmin" type="checkbox"> <label>Admin</label></div>
                                    </div>
                                </div> -->


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_admin_foradmin" type="checkbox"> <label>General Admin for Admin </label></div>
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="admin_activation_maker_directbank" type="checkbox"> <label>Admin Activation Maker </label></div>
                                    </div>
                                </div> 



                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="admin_activation_checker_directbank" type="checkbox"> <label>Admin Activation Checker </label></div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="lock_unlock_admin_directbank" type="checkbox"> <label>Lock Unlock Admin </label></div>
                                    </div>
                                </div> 
                              
                              
                            </div>
                          


                        </div>
                    </div>
                </div>
            </div>
           
        </div>        

</div>

<!-- Direct Banking ends -->






<br>




<div class="form-group row">
            <div class="col-lg-offset-2 col-lg-10">
                <button class="btn btn btn-success float-right" type="submit">Submit</button>
            </div>
          </div>


    </form>

             <!-- form submission ends here -->






<!-- extra for script practice -->

<!-- <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="col-md-2">
        <label>Practical:</label>&nbsp;&nbsp;
        <input id="check1" type="checkbox" class="box">
      </div>

      <div class="col-md-4" id="box" style="display: none;">
        <input type="number" name="practical1" class="form-control">
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <div class="col-md-2">
        <label>Dream:</label>&nbsp;&nbsp;
        <input id="check2" type="checkbox" class="box2">
      </div>

      <div class="col-md-4" id="box2" style="display: none;">
        <input type="number" name="practical2" class="form-control">
      </div>
    </div>
  </div>
</div> -->
@endsection


@push('scripts')

<script>
   var checkbox = document.querySelectorAll("#check1, #check2, #check3, #check4, #check5, #check6, #check7");
for (i = 0; i < checkbox.length; i++) {
  checkbox[i].onclick = function() {

    if (this.checked) {
      document.getElementById(this.getAttribute('class')).style['display'] = 'block';
    } else {
      document.getElementById(this.getAttribute('class')).style['display'] = 'none';
    }
  };
}
</script>
@endpush
