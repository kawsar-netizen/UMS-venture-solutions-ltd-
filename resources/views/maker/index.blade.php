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
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: black">Hello! I am maker</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection








@section('content')



<div class="container wrapper wrapper-content" style="max-height: 80%">



<!-- <div class="p-2 mb-2" align="center" style="background-color: #e9ecef;"><b>User Request Form</b></div> -->
<br>


<form action="" method="post" enctype="multipart/form-data">
@csrf
<!-- information details -->

<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>User Information Details</b></div>


<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-6">
      <b>User ID : {{Auth::user()->id}}</b>
      <br>Employee ID :
      <br>Branch :
      <br>Email : <b>{{Auth::user()->email}}</b>
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
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Operation Category</b></div>


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">



                       
                            
                            <div class="row"> 

                          <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check1" class="box" type="checkbox"> <label>UBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>PBM </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check3" class="box3" type="checkbox"> <label>CPS2 </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check4" class="box4" type="checkbox"> <label>BEFTN </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check2" type="checkbox" class="box2"> <label>RTGS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Docudex</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check5" class="box5" type="checkbox"> <label>New DBcube </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>RBS </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>GEFU </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check7" class="box7" type="checkbox"> <label>Direct Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="check6" class="box6" type="checkbox"> <label>Bkash</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Portal</label></div>
                                    </div>
                                </div>
                              
                            </div>




                            <div class="col-lg-3">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>RIT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>FOREX </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>CSMS </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>PASSPORT </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>N SCREEN</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>SWIFT</label></div>
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
                            <div class="col-lg-12">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>New ID Creation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Amendment </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Transfer </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Enable </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Disable</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Password Reset</label></div>
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
        <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>UBS</b></div>
          
            <div class="row" style="padding-left: 20px">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>LC & Bills </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Corps. Loan </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Data Entry </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Fund Transfer </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL Clearing Batch</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Reconciliation</label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Money Market </label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>CPC Credit/CPC Trade </label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL FAD</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL Swift Massage</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL OBU </label></div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL ASU </label></div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Bank Guarantee</label></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Card Ops </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>ADC Ops </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Call Center </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Foreign Exchange </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Treasury</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Securities</label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>CCY Rate </label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Settlement Maintenance </label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Business Operation</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL EOD Operation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL SMS Admin (For IT) </label></div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>DBL Prod Maintenance (IT) </label></div>
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
                                        <div class="i-checks"> <input type="checkbox"> <label>UM Checker (For IT) </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>UM Maker (For IT) </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>RTGS Admin </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Fund Manager </label></div>
                                    </div>
                                </div>
                             </div>  
                              
                                

                            <div class="col-lg-6">
                                  
                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Bank Miscellaneous</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Inter Bank Forex</label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Inter Bank Local </label></div>
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
                                        <div class="i-checks"> <input type="checkbox"> <label>Administrator </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Inward Checker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Inward Maker </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Report Viewer </label></div>
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
                                        <div class="i-checks"> <input type="checkbox"> <label>Maker </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Checker </label></div>
                                    </div>
                                </div>


                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Report Viewer </label></div>
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

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box5" style="display: none;">
    <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>New DBcube</b></div>      
          
            <div class="row" style="padding-left: 20px">
              <div class="col-lg-12">
                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <div class=""><label><b>Domain User Id : </b></label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Teller /Cash </label></div>
                                    </div>
                                </div>
              </div>
             
           
        </div>        

</div>

<!-- New DBCUBE ends -->






<!-- for BKASH -->

            
        <div class="wrapper wrapper-content animated fadeInRight" id="box6" style="display: none;">
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>BKASH</b></div>  
          
            <div class="row" style="padding-left: 20px">
              <div class="col-lg-12">
                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <div class=""><label><b>Domain User Id : </b></label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>General Banking </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Teller /Cash </label></div>
                                    </div>
                                </div>
              </div>
             
           
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
                            <div class="col-lg-6">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>General Client Admin </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>User Submit </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Lock Unlock Client </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Client Activation Maker </label></div>
                                    </div>
                                </div>
                                 
                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Client Activation Checker</label></div>
                                    </div>
                                </div>

                             </div>  
                              
                                

                            <div class="col-lg-6">
                                  
                                  

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Admin</label></div>
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>General Admin for Admin </label></div>
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Admin Activation Maker </label></div>
                                    </div>
                                </div> 



                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Admin Activation Checker </label></div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input type="checkbox"> <label>Lock Unlock Admin </label></div>
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
                <button class="btn btn-lg btn-success float-right" type="submit">Submit</button>
            </div>
          </div>
<br>
<br>

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
