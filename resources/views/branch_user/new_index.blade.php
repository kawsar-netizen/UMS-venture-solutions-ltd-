
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

     
<div class="container wrapper wrapper-content" style="max-height: 80%">


<br>

<!-- <div class="p-2 mb-2 row-12" align="center" style="background-color: #a3b0c2; color: white;"><h3>User Request Form</h3></div> -->
<br>


<form action="{{route('br-user')}}" method="post" enctype="multipart/form-data">
@csrf
<!-- information details -->


<!-- <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>User Information Details</b></div>


<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-6">
      <p>User ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="input_user_id"></p>
      <p style="margin-top: -20px"><br>Employee ID : &nbsp;<input type="text" name="emp_id"></p>
      <p style="margin-top: -20px"><br>Branch : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="branch"></p>
      <p style="margin-top: -20px"><br>Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="user_email"></p>
    </div>

    <div class="col-lg-6">
      <p>Domain ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="domain_id"></p>
      <p style="margin-top: -20px"><br>Employee Name : &nbsp;<input type="text" name="emp_name"></p>
      <p style="margin-top: -20px"><br>Designation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="designation"></p>
      <p style="margin-top: -20px"><br>Mobile : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="emp_mobile"></p>
    </div>
  </div>
</div> -->

<!-- information details ends -->








<!-- operation category -->
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Systems</b></div>



<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">



                       
                            
                            <div class="row"> 

                          <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check1" name="ubs" value="UBS" class="box" type="checkbox"> <label>UBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="pbm" value="PBM" type="checkbox"> <label>PBM </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check3" name="cps" value="CPS2" class="box3" type="checkbox"> <label>CPS2 </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check4" name="beftn" value="BEFTN" class="box4" type="checkbox"> <label>BEFTN </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check2" name="rtgs" value="RTGS" type="checkbox" class="box2"> <label>RTGS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="docudex" value="Docudex" type="checkbox"> <label>Docudex</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newdbcube" value="newdbcube" id="check5" class="box5" type="checkbox"> <label>New DBcube </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rbs" value="RBS" type="checkbox"> <label>RBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="gefu" value="GEFU" type="checkbox"> <label>GEFU </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="directbank" value="Direct Banking" id="check7" class="box7" type="checkbox"> <label>Direct Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="bkash" value="Bkash" id="check6" class="box6" type="checkbox"> <label>Bkash</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="portal" value="Portal" type="checkbox"> <label>Portal</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="rit" value="RIT" type="checkbox"> <label>RIT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="forex" value="FOREX" type="checkbox"> <label>FOREX </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="csms" value="CSMS" type="checkbox"> <label>CSMS </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passport" value="PASSPORT" type="checkbox"> <label>PASSPORT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="nscreen" value="N SCREEN" type="checkbox"> <label>N SCREEN</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="swift" value="SWIFT" type="checkbox"> <label>SWIFT</label></div>
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

<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Request Type</b></div>
    


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                            
                            <div class="row"> 
                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="newidcreate" value="New ID Creation" type="checkbox"> <label>New ID Creation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="amendment" value="Amendment" type="checkbox"> <label>Amendment </label></div>
                                    </div>
                                </div>
                              
                            </div>


                           



                              <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="transfer" value="Transfer" type="checkbox"> <label>Transfer </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="enable" value="Enable" type="checkbox"> <label>Enable </label></div>
                                    </div>
                                </div>
                              
                            </div>




                               <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="disable" value="Disable" type="checkbox"> <label>Disable</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="passreset" value="Unlock User" id="check8" class="box" type="checkbox"> <label>Unlock User</label></div>
                                    </div>
                                </div>


                            <div class="form-group row check8" id="box8">
                                    <div class="col-lg-12">
                                        <label>User ID : </label>
                                        <input type="text" name="new_u_id" value="">
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

    
      
         <div class="wrapper wrapper-content animated fadeInRight"  id="box" style="display: none;">
           
    <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>UBS</b></div>
          <!-- <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href=""><b>UBS</b></a>
                    </li>
                </ol>
            </div> -->

            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 

                                <!-- <label>my test</label><input type="text" name="department" value=""> -->

                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manager" value="Manager" type="checkbox"> <label>Manager </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="manops" value="Manager OPS" type="checkbox"> <label>Manager OPS </label></div>
                                    </div>
                                </div>


                            </div>



                              <div class="col-lg-3">

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="genralbank_ubs" value="General Banking" type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="credit_ubs" value="Credit" type="checkbox"> <label>Credit </label></div>
                                    </div>
                                </div>

                            </div>



                              <div class="col-lg-3">
                                   
                              



                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="foreigntrade" value="Foreign Trade" type="checkbox"> <label>Foreign Trade</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash" value="Teller/Cash" type="checkbox"> <label>Teller/Cash</label></div>
                                    </div>
                                </div>

                            </div>



                              <div class="col-lg-3">

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="view_ubs" value="View" type="checkbox"> <label>View </label></div>
                                    </div>
                                </div>

                            </div>  


                              
                              <div class="col-lg-4">
                                <br>
                                   <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        <input type="text" name="depart_ubs" value="">
                                    </div>
                                </div>                            
                              </div>


                              <div class="col-lg-4">
                                <br>
                                 <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Existing User ID : </label>
                                       <input type="text" name="exist_user_id_ubs">
                                    </div>
                                </div>
                                  
                              </div>



                              <div class="col-lg-4">
                              <br>
                                  <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Special Role : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="special_role_ubs">
                                    </div>
                                </div> 
                              </div>


                              <div class="col-lg-4">
                                <br>
                                <br>
                                  <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>User ID : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="input_user_id">
                                    </div>
                                </div> 


                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Branch : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="branch">
                                    </div>
                                </div> 

                               
                              </div>


                              <div class="col-lg-4">
                                <br>
                                <br>

                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Domain ID : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="domain_id">
                                    </div>
                                </div> 
                                   

                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Email : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="user_email">
                                    </div>
                                </div> 
                              </div>



                              <div class="col-lg-4">
                               <br>
                              <br>
                              
                                  <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Employee ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input type="text" name="emp_id">
                                    </div>
                                </div> 

                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Employee Name : </label>
                                       <input type="text" name="emp_name">
                                    </div>
                                </div> 
                              </div>


                              <div class="col-lg-4">
                                <br>
                                  <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Designation : </label>
                                        &nbsp;<input type="text" name="designation">
                                    </div>
                                </div> 

                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Mobile : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="emp_mobile">
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
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>RTGS</b></div>
          
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

                             <div class="col-lg-6">
                                <br>
                                   <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        <input type="text" name="depart_rtgs" value="">
                                    </div>
                                </div>


                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Role : </label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="roles_rtgs">
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
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>CPS2</b></div>
          
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



                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        <input type="text" name="depart_cps" value="">
                                    </div>
                                </div>


                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Role : </label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="roles_cps">
                                    </div>
                                </div>

                                 

                             </div>  
                              
                                
                             <div class="col-lg-6">
                               

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



                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Existing User ID (if any) : </label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="exist_user_id_cps">
                                    </div>
                                </div>



                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Special Function/Role (if any) : </label>
                                       <input type="text" name="special_role_cps">
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
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>BEFTN</b></div>
          
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




                             <div class="col-lg-6">
                                   
                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="depart_beftn" value="">
                                    </div>
                                </div>


                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Role : </label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="roles_beftn">
                                    </div>
                                </div>


                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Existing User ID (if any) : </label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="exist_user_id_beftn">
                                    </div>
                                </div>



                                <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Special Function/Role (if any) : </label>
                                       <input type="text" name="special_role_beftn">
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
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>BKASH</b></div>
          
            <div class="row" style="padding-left: 20px">
  
             <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 

                            <div class="col-lg-6">
                                   
                              
                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_bank_bkash" type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Department : </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="depart_bkash" value="">
                                    </div>
                                </div>

                                

                                  
                             </div>  

                             <div class="col-lg-6">
                               
                                   <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="tellerorcash_bkash" type="checkbox"> <label>Teller /Cash </label></div>
                                    </div>
                                </div>


                              <div class="form-group row" style="">
                                    <div class="col-lg-12">
                                        <label>Role : </label>
                                       <input type="text" name="roles_bkash">
                                    </div>
                                </div>
                              </div>




                            
                            <div class="col-lg-12">
                                 <div class="form-group row">
                                   <div class="col-lg-12">
                                        <label>Existing User ID (if any) : </label>
                                       <input type="text" name="exist_user_id_bkash">
                                    </div>
                              </div>
                            </div>
                             

                              
                        </div>
                    </div>
                </div>
            </div>




              <!-- <div class="col-lg-12">
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
              </div> -->
             
           
        </div>        

</div>

<!-- New Bkash ends -->












<!-- for Direct Banking -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box7" style="display: none;">
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Direct Banking</b></div>
          
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 

                            <div class="col-lg-4">
                                                               
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

                             </div>  
                              
                            



                            <div class="col-lg-4">
                                  
                                  

                                 <!-- <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_admin_foradmin" type="checkbox"> <label>Admin</label></div>
                                    </div>
                                </div> -->


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



                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="general_admin_foradmin" type="checkbox"> <label>General Admin for Admin </label></div>
                                    </div>
                                </div>                                
                                                           
                            </div>



                            <div class="col-lg-4">
                                  
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




                            <div class="col-lg-6">
                                  <br>
                                  <div class="form-group row">
                                   <div class="col-lg-12">
                                        <label>Department : </label>
                                        <input type="text" name="depart_directbank" value="">
                                    </div>
                                </div> 
     
                            </div>


                            <div class="col-lg-6">
                                  <br>
                                  <div class="form-group row">
                                   <div class="col-lg-12">
                                        <label>Existing User ID (if any) : </label>
                                       <input type="text" name="exist_user_id_directbank">
                                    </div>
                                </div> 
     
                            </div>





                            <div class="col-lg-6">
                                  
                                  <div class="form-group row">
                                   <div class="col-lg-12">
                                        <label>Role : </label>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="roles_directbank">
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


<div class="form-group wrapper wrapper-content animated fadeInRight" align="center">
            <div class="col-lg-offset-2 col-lg-10">
                <button class="btn btn-lg btn-info" type="submit" style="padding: 10px 15px 10px 15px">Submit</button>
            </div>
</div>

<br>
<br>

    </form>

             <!-- form submission ends here -->
</div>





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

   @endsection('content')



   @push('scripts')


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




<script type="text/javascript">
  $(function() {
  enable_cb();
  $("#check8").click(enable_cb);
});

function enable_cb() 
{
  if (this.checked) 
  {
   
     $("div.check8").show(); 
  } 

  else 

  {
    $("div.check8").removeAttr("style").hide();
    
  }
}
</script>





<!-- <script type="text/javascript">
  $(function() {
  enable_cb();
  $("#check8").click(enable_cb);
});

function enable_cb() 
{
  if (this.checked) 
  {
    $("input.check8").removeAttr("disabled");
   
  } 

  else 

  {
     $("input.check8").attr("disabled", true);
  }
}
</script> -->


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