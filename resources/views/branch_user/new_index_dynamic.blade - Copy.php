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
  
  <!-- loader part -->
   <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div>
  <!-- loader part ends -->
  
  
  <div class="container wrapper wrapper-content" style="max-height: 80%">
   <div class="p-2 mb-4" align="center" style="background-color: #a3b0c2; color: white"><b>User Information Details</b></div>

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
                              
                              $user_form_data = DB::table('users')->where('id', $user_id)->first();
                              
                              // echo"<pre>";
                              // print_r($user_form_data);
                              
                              ?>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b>Employee Id </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->id}}" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b>Branch </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="<?php 
                                    $branch_code = $user_form_data->branch;
                                    $branch_info = DB::table('branch_info')->where('bnk_br_id', $branch_code)->first();
                                    
                                    echo $branch_info->name;
                                   echo  ' ('.$branch_code.')';
                                     ?> " type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b> Email </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->email}}" type="text" class="form-control">
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b> Login Id </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->user_id}}" type="text" class="form-control">
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
                                 <input readonly name="" value="{{$user_form_data->name}} ({{$user_form_data->id}})" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b>Designation  </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->designation}}" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b> Mobile  </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->contact}}" type="text" class="form-control">
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><b> Department </b></label>
                              <div class="col-sm-7">
                                 <input readonly name="" value="{{$user_form_data->department}}" type="text" class="form-control">
                              </div>
                           </div>

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

  
  <input type="hidden" name="systemList" id="systemList"  value="" >
<input type="hidden" name="requestTypeList" id="requestTypeList" value="" >
<input type="hidden" name="parameterList" id="parameterList" value="" >

<div class="container wrapper wrapper-content" style="max-height: 80%">


   <form action="" method="post" enctype="multipart/form-data" id="sys_form">
      @csrf

      
       <div class="modal fade halimmodal_for_assign_person" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           $checkListArray=array();
                           
                           foreach ($systemList as $key => $value) {
                           
                              
                             array_push($checkListArray,"#check_".$value->id);
                            
                           }
                           
                           
                           $checkList=implode(",",$checkListArray);
                           
                           ?>
                        @foreach($systemList->chunk(2) as $chunks)
                        <div class="col-lg-4">
                           @foreach($chunks as $sysL)
                           <div class="form-group row">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <div class="i-checks"> 
                                    <input name="{{$sysL->system_name}}" value="{{$sysL->id}}" id="check_{{$sysL->id}}" class="{{$sysL->id}}_box" type="checkbox">
                                    <label class="form-check-label" for="check_{{$sysL->id}}">{{$sysL->system_name}}</label>
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

        
         
         @foreach($systemList as $sl) 


         <!--  ******************** -->




            <!-- for request Type-->
   
         <div class="wrapper wrapper-content animated fadeInRight request_type_class"  id="{{$sl->id}}_request_box" style="display: none;">

            <div class="p-2 mb-4 request_background_color_{{$sl->id}}" align="center" style="color: white">

                <b>System {{$sl->system_name}} Request Type</b></div>


                <!-- for checkbox -->
            <div class="ibox">

               <div class="ibox-content">

                 <!-- radio start -->
                  <div class="row">
                     @foreach($request_data as $single_request)

                     @if($sl->id == $single_request->system_id)

                        <?php 

                         if ($single_request->status !=1) {
                            
                            ?>
                       
                         <div class="col-lg-4">
                            

                            <div class="form-group row">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <div class="i-checks"> 

                                    <input id="requst_type_user_id{{$single_request->id}}" name="radio{{$sl->id}}" onclick="request_type_hide({{$single_request->system_id}});req_type_id({{$single_request->id}});" required value="{{$single_request->request_type_name}}" type="radio"> 

                                    <label style="color: black;" for="requst_type_user_id{{$single_request->id}}">{{$single_request->request_type_name}}</label>
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

                                    <input id="requst_type_user_id{{$single_request->id}}" 

                                    name="radio{{$sl->id}}" onclick="req_type_func({{$single_request->id}}, {{$single_request->system_id}})" value="{{$single_request->request_type_name}}" type="radio" required> 


                                    <label style="color: black;" for="requst_type_user_id{{$single_request->id}}">{{$single_request->request_type_name}}</label>
                                </div>
                              </div>
                           </div>

                         </div>

                           <div class="form-group row" id="box{{$single_request->id}}" style="display: none;">

                              <div class="col-lg-12">
                                 <label>User ID : </label>
                                 <input type="text" name="new_u_{{$single_request->id}}" value="">
                              </div>

                           </div>

                           <?php 

                           }
                           ?>

                     @endif
                     @endforeach
                  </div>
                  <!-- radio ends -->


                 

                 
               </div>


            </div>  <!-- end ibox -->


            
         </div>
        
      <!-- request Type end -->


      

         <div class="wrapper wrapper-content animated fadeInRight"  id="{{$sl->id}}_box" style="display: none;">
            
            <div class="p-2 mb-2 request_background_color_{{$sl->id}}" align="center" style="color: white;"><b>System {{$sl->system_name}}</b></div>

            <!-- for checkbox -->
            <div class="ibox">
               <div class="ibox-content">

                   <!-- Radio Start -->
                  <div class="row">
                     @php
                        $rtgs_count = 0;
                     @endphp
                     <?php foreach($system_parameters as $sys_para){
                     
            if(Auth::user()->role=='1'){
                        

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
                      
                     
                      

                      <table class="table">
                         
                         <tr>

                            <td>
                               <label class="checkbox-inline">
                                 <input type="checkbox" value="131" name="131" class="maker">&nbsp; Maker
                               </label>

                            </td>

                            <td>
                                <label class="checkbox-inline">
                                 <input type="checkbox" value="133" name="133" class="checker">&nbsp; Checker
                               </label>
                            </td>

                            <td>
                               <label class="checkbox-inline">
                                 <input type="checkbox" value="134" name="134" class="report_viewer">&nbsp; Report Viewer
                               </label>

                            </td>

                         </tr>


                        
                            
                         
                               <tr class="enhancement_and_checker">

                                 <td></td>
                                  <td><h4 class="text-center">Checker Authorizer Limit</h4></td> 
                                  <td></td>
                              </tr>


                               <tr class="enhancement_and_checker">
                                  <th>Officers' Designation</th>
                                  <th>Template Number</th>
                                  <th>Highest Approval Limit</th>
                               </tr>

                               <tr class="enhancement_and_checker">

                                  <td><input name="rtgs_radio" value="135" id="parameter_id_rtgs_template0" type="radio"><label for="parameter_id_rtgs_template0">Head Office  </label></td>

                                  <td> Template-0  </td>
                                  <td> BDT 150.00 Lac </td>
                               </tr> 

                               <tr class="enhancement_and_checker">
                                  <td><input name="rtgs_radio" value="136" id="parameter_id_rtgs_template1" type="radio"><label for="parameter_id_rtgs_template1"> SO/Officer  </label> </td>

                                  <td> Template-1  </td>
                                  <td> BDT 1.00 Lac </td>
                               </tr class="enhancement_and_checker">


                                 <tr class="enhancement_and_checker">
                                     <td>
                                      <input name="rtgs_radio" value="137" id="parameter_id_rtgs_template2" type="radio">
                                      <label for="parameter_id_rtgs_template2"> PO </label>
                                    </td>

                                     <td>   Template-2   </td>
                                     <td>  BDT 5.00 Lac </td>
                               </tr>

                               <tr class="enhancement_and_checker">
                                    <td>
                                      <input name="rtgs_radio" value="138" id="parameter_id_rtgs_template3" type="radio">

                                      <label for="parameter_id_rtgs_template3">AVP/SPO   </label>
                                    </td>

                                     <td>  Template-3  </td>
                                     <td>  BDT 50.00 Lac </td>
                               </tr>

                               <tr class="enhancement_and_checker">
                                    <td>
                                      <input name="rtgs_radio" value="139" id="parameter_id_rtgs_template4" type="radio">
                                      <label for="parameter_id_rtgs_template4">FVP/SAVP    </label>
                                    </td>

                                     <td> Template-4  </td>
                                     <td> BDT 2.00 Crore </td>
                               </tr>

                               <tr class="enhancement_and_checker">
                                    <td>
                                       <input name="rtgs_radio" value="140" id="parameter_id_rtgs_template5" type="radio">

                                       <label for="parameter_id_rtgs_template5">SVP/VP    </label>
                                    </td>

                                     <td> Template-5  </td>
                                     <td> BDT 3.00 Crore </td>
                               </tr>

                               <tr class="enhancement_and_checker">
                                    <td>
                                       <input name="rtgs_radio" value="141" id="parameter_id_rtgs_template6" type="radio">

                                       <label for="parameter_id_rtgs_template6">SEVP/EVP   </label>

                                    </td>

                                     <td> Template-6   </td>
                                     <td> BDT 5.00 Crore </td>
                               </tr>

                               <tr class="enhancement_and_checker">
                                    <td>
                                       <input name="rtgs_radio" value="142" id="parameter_id_rtgs_template7" type="radio">

                                       <label for="parameter_id_rtgs_template7">Special (***)   </label>
                                    </td>

                                     <td> Template 7  </td>
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



                        <div class="col-lg-6">
                           <div class="form-group row" style="">
                              <div class="col-lg-offset-2 col-lg-10">
                                 
                                     <label for="temporay_exp_date">Temporary Expire Date and Time </label>
                                    <input name="143" value="" id="temporay_exp_date" type="datetime-local">
                                   
                                
                              </div>
                           </div>
                        </div>

                         <div class="col-lg-6">
                           <div class="form-group row" style="">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <div class="i-checks">

                                    <input name="rtgs2_radio" value="144" id="permanent" type="radio"><label for="permanent">Permanent</label>

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


                     <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>For RTGS Enhancement</label>
                              <input type="text" name="158" value="">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>Reason</label>
                              <input type="text" name="146" value="">
                           </div>
                        </div>
                     </div>

                      <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>Previous Level of the checker Template Number</label>
                              <input type="text" name="145" value="">
                           </div>
                        </div>
                     </div>

                        <?php 
                        


                           }
              
            }if(Auth::user()->role=='2'){
              
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
               
               
               <table class="table">
                         
                         <tr>

                            <td>
                               <label class="checkbox-inline">
                                 <input type="checkbox" value="148" name="148" class="maker">&nbsp; Maker
                               </label>

                            </td>

                            <td>
                                <label class="checkbox-inline">
                                 <input type="checkbox" value="149" name="149" class="checker">&nbsp; Checker
                               </label>
                            </td>

                            <td>
                               <label class="checkbox-inline">
                                 <input type="checkbox" value="150" name="150" class="report_viewer">&nbsp; Report Viewer
                               </label>

                            </td>
              
              
              
              
              
                         </tr>
             
             <tr>
             
              
              
              <td>
              
                <label class="checkbox-inline">
                                 <input type="checkbox" value="153" name="153">&nbsp; Banks Miscellaneous (HO)
                               </label>
                 
              </td>
              
              <td>
              
                <label class="checkbox-inline">
                                 <input type="checkbox" value="154" name="154">&nbsp; Inter Bank Forex (HO)
                               </label>
                 
              </td>
              
              <td>
              
                <label class="checkbox-inline">
                                 <input type="checkbox" value="155" name="155">&nbsp; Inter Bank Local (HO)
                               </label>
                 
              </td>
              
             </tr>  
             
             <tr>
              
              <td>
                
                <label class="checkbox-inline">
                                 <input type="checkbox" value="156" name="156">&nbsp; UM Maker (For IT)
                               </label>
              </td>
              
              <td>
                
                <label class="checkbox-inline">
                                 <input type="checkbox" value="157" name="157">&nbsp; UM Checker (For IT)
                               </label>
              </td>
              
              <td>
                               <label class="checkbox-inline">
                                 <input type="checkbox" value="151" name="151">&nbsp; Fund Transfer
                               </label>

                            </td>
              
              
             </tr>
             
             <tr>
             
              <td>
              
              
                <label class="checkbox-inline">
                                 <input type="checkbox" value="152" name="152">&nbsp; Admin
                               </label>
                 
              </td>
              
             </tr>


                   

                         <tr class="enhancement_and_checker">

                           <td></td>
               
                            <td><h4 class="text-center">Checker Authorizer Limit</h4></td> 
                            <td></td>
                        </tr>


                         <tr class="enhancement_and_checker">
                            <th>Officers' Designation</th>
                            <th>Template Number</th>
                            <th>Highest Approval Limit</th>
                         </tr>

                         <tr class="enhancement_and_checker">

                            <td><input name="rtgs_radio" value="135" id="parameter_id_rtgs_template0" type="radio"><label for="parameter_id_rtgs_template0">Head Office  </label></td>

                            <td> Template-0  </td>
                            <td> BDT 150.00 Lac </td>
                         </tr> 

                         <tr class="enhancement_and_checker">
                            <td><input name="rtgs_radio" value="136" id="parameter_id_rtgs_template1" type="radio">
                              <label for="parameter_id_rtgs_template1"> SO/Officer  </label> </td>

                            <td> Template-1  </td>
                            <td> BDT 1.00 Lac </td>
                         </tr>

                           <tr class="enhancement_and_checker">
                               <td>
                                <input name="rtgs_radio" value="137" id="parameter_id_rtgs_template2" type="radio">
                                <label for="parameter_id_rtgs_template2"> PO </label>
                              </td>

                               <td>   Template-2   </td>
                               <td>  BDT 5.00 Lac </td>
                         </tr>

                         <tr class="enhancement_and_checker">
                              <td>
                                <input name="rtgs_radio" value="138" id="parameter_id_rtgs_template3" type="radio">

                                <label for="parameter_id_rtgs_template3">AVP/SPO   </label>
                              </td>

                               <td>  Template-3  </td>
                               <td>  BDT 50.00 Lac </td>
                         </tr>

                         <tr class="enhancement_and_checker">
                              <td>
                                <input name="rtgs_radio" value="139" id="parameter_id_rtgs_template4" type="radio">
                                <label for="parameter_id_rtgs_template4">FVP/SAVP    </label>
                              </td>

                               <td> Template-4  </td>
                               <td> BDT 2.00 Crore </td>
                         </tr>

                         <tr class="enhancement_and_checker">
                              <td>
                                 <input name="rtgs_radio" value="140" id="parameter_id_rtgs_template5" type="radio">

                                 <label for="parameter_id_rtgs_template5">SVP/VP    </label>
                              </td>

                               <td> Template-5  </td>
                               <td> BDT 3.00 Crore </td>
                         </tr>

                         <tr class="enhancement_and_checker">
                              <td>
                                 <input name="rtgs_radio" value="141" id="parameter_id_rtgs_template6" type="radio">

                                 <label for="parameter_id_rtgs_template6">SEVP/EVP   </label>

                              </td>

                               <td> Template-6   </td>
                               <td> BDT 5.00 Crore </td>
                         </tr>

                         <tr class="enhancement_and_checker">
                              <td>
                                 <input name="rtgs_radio" value="142" id="parameter_id_rtgs_template7" type="radio">

                                 <label for="parameter_id_rtgs_template7">Special (***)   </label>
                              </td>

                               <td> Template 7  </td>
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



                        

                        <div class="col-lg-6">
                           <div class="form-group row" style="">
                              <div class="col-lg-offset-2 col-lg-10">
                                

                                      <label for="temporay_exp_date">Temporary Expire Date and Time </label>
                                    <input name="1159" value="1159" id="temporay_exp_date" type="datetime-local" >


                                 
                              </div>
                           </div>
                        </div>

                         <div class="col-lg-6">
                           <div class="form-group row" style="">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <div class="i-checks">

                                    <input name="rtgs2_radio" value="144" id="permanent" type="radio"><label for="permanent">Permanent</label>

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


                     <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>For RTGS Enhancement</label>
                              <input type="text" name="158" value="">
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>Reason</label>
                              <input type="text" name="146" value="">
                           </div>
                        </div>
                     </div>

                      <div class="col-lg-6">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>Previous Level of the checker Template Number</label>
                              <input type="text" name="145" value="">
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
                     @foreach($system_parameters as $sys_para)

                    
                     @if($sl->id == $sys_para->system_id && $sys_para->system_id !='6')
                     @if($sys_para->para_type == 2)
                     <div class="col-lg-4">
                        <div class="form-group row" style="">
                           <div class="col-lg-offset-2 col-lg-10">
                              <div class="i-checks">
                                 <input name="{{$sys_para->para_id}}" value="{{$sys_para->para_id}}" id="parameter_id{{$sys_para->para_id}}" type="checkbox">

                                 <label for="parameter_id{{$sys_para->para_id}}">{{$sys_para->para_name}}</label>
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
                     @foreach($system_parameters as $sys_para)
                     @if($sl->id == $sys_para->system_id && $sys_para->system_id !='6')
                     @if($sys_para->para_type == 1)
                     <div class="col-lg-4">
                        <div class="form-group row" style="">
                           <div class="col-lg-6">
                              <label>{{$sys_para->para_name}}:</label>
                              <input type="text" name="{{$sys_para->para_id}}" value="">
                           </div>
                        </div>
                     </div>
                     @endif
                     @endif
                     @endforeach                               
                  </div>
                  <!-- input ends -->    
               </div>
            </div>  <!-- end ibox -->




           




         </div>
         @endforeach
      </div>
      <!-- parameter ends -->
      <br>
      <div class="form-group wrapper wrapper-content animated fadeInRight" align="center">
         <div class="col-lg-offset-2 col-lg-10">
            <button class="btn btn-lg btn-info  fisrt_assign"  type="button" style="padding: 10px 15px 10px 15px">Submit</button>
         </div>
      </div>
      <br>
      <br>
   </form>
   <!-- form submission ends here -->
</div>






   @endsection('content')
   
   
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
  //console.log('document.querySelectorAll("<?php print $checkList;?>")');
   var checkbox = document.querySelectorAll("<?php print $checkList;?>");
   const colors = ["#ffb700", "#a3b0c2","#ffb700", "#a3b0c2","#ffb700", "#a3b0c2","#ffb700", "#a3b0c2","#ffb700", "#a3b0c2","#ffb700", "#a3b0c2"];
   for (i = 0; i < checkbox.length; i++) {      
     checkbox[i].onclick = function() {
       if (this.checked) {
          var system_id =    this.getAttribute('value');

          document.getElementById(this.getAttribute('class')).style['display'] = 'block';
          var request_id = ("#"+system_id+"_request_box");
          $(request_id).attr('style','display: block');
          var sl = 0;
          $('.request_type_class').each(function(){
            if ($(this).css('display') == 'block'){
               var backgroun_color = colors[sl];
               $(".request_background_color_"+system_id).css("background-color",backgroun_color);
               sl++;
            }
         });


       }else if (!this.checked) {
          var system_id =    this.getAttribute('value');
          document.getElementById(this.getAttribute('class')).style['display'] = 'none';
          var request_id = ("#"+system_id+"_request_box");

          $(request_id).attr('style','display: none');

       } else{
         document.getElementById(this.getAttribute('class')).style['display'] = 'none';
       }
     };
   }



function req_type_func(id, system_id){
   
     

       $("#box"+id).css('display','block'); 
       $('#'+system_id+"_box").css('display','none'); 

   
}

function request_type_hide(system_id){




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

                
                console.log(data);

                 $("#box"+data).css('display','none'); 
                  $('#'+system_id+"_box").css('display','block');

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });

    } // end -:- request_type_hide.


</script>


<script type="text/javascript">
   $(".fisrt_assign").click(function(e){


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

<!-- for ajax -->
<script type="text/javascript">
  $(".bat").click(function(e) {
           
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();

            cuteAlert({
          type: "question",
          title: "Do You Want To Process The Request",
          message: "",
          confirmText: "Submit",
          cancelText: "Cancel"
        }).then((e)=>{

            
          
          if ( e == ("confirm")){


           

          var queryString = $("#sys_form").serialize();

            var sysList=document.getElementById('systemList').value;
          var requestList=document.getElementById('requestTypeList').value;

          // console.log(queryString);return false;

               var formData = {                
                   'form_serialize_data' : queryString,  
                   'sysList':   sysList,
                   'requestList':  requestList                
               };



             $.ajax({
                type: 'POST',
                url: "{{ route('my-data') }}",
                data: formData,

                 beforeSend: function() {
                   jQuery(".loader").show();
                },

                success: function(data) {

                    if(data.success === false){
                        cuteAlert({
                         type: "warning",
                         title: "User Request Failed",
                         message: data.message,
                         buttonText: "Okay",
                         timer: 10000
                       })
                    }else{
                        console.log(data);
                      

                       cuteAlert({
                         type: "success",
                         title: "Successfully Inserted !",
                         message: "",
                         buttonText: "Okay"
                       }).then((e)=>{

                            location.reload();

                       });
                    }
                    



                },
                error: function(response) {
                   
                    console.log(response);
                     
                        cuteAlert({
                      type: "warning",
                      title: "Insert failed !",
                      message: "",
                      buttonText: "",
                      timer: 10000
                    })


                      // location.reload();
                },

                complete: function() {

                     jQuery(".loader").hide();
                }
                
            });



        } else {

            cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Cancel",
                      message: "",
                      timer: 10000
                    });

          }
          
        })


  
               
        
    }); 



  function req_type_id(req_type_id){

     var rtgs_req_type_id = req_type_id;


   
   $(".checker").on('change',function(){

  var rtgs_checker_val = $(".checker").val();

  
  if((rtgs_checker_val=='149' || rtgs_checker_val=='133') &&  rtgs_req_type_id=='36' ) {

      $(".enhancement_and_checker").css('display','none');

  }else{

       $(".enhancement_and_checker").css('display','');
  }



});

  }





</script>







@endpush