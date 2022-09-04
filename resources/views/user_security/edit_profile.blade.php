
@extends('master.master')



@section('css')

<link rel='stylesheet' href="{{ asset('assets/css/jquery-ui.css') }}">
  

 @endsection

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User and Security</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Edit Your Profile</b></a>
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
                   

                <div class="row"  style="margin-top:20px;">

                    <div class="col-lg-12">
                     <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit Profile</h5>
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

                            <form action="" method="POST">

                               @csrf

                               <div class="row">
                                   <div class="col-md-6">
                                       
                                  <?php

                                    $user_id = Auth::user()->id;
                                   $my_data = DB::table('users')->where('id',$user_id)->first();

                                  ?>

                                  <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo Auth::user()->id; ?>">

                                       <div class="form-group row">

                                            <label class="col-sm-4 control-label" required="required">User Name</label>

                                            <div class="col-sm-8">

                                                <input type="text" required="" class="form-control" name="user_name"  id="user_name"  value="{{$my_data->name}}"  readonly />
                                            </div>

                                        </div>


                                         <div class="form-group row">

                                            <label class="col-sm-4 control-label" required="required">Employee Id</label>

                                            <div class="col-sm-8">

                                                <input type="text" class="form-control" name="emp_id"  id="emp_id" required=""  value="{{$my_data->emp_id}}"  />
                                            </div>

                                        </div>



                                        <div class="form-group row">

                                            <label class="col-sm-4 control-label" >Present Branch Name</label>

                                            <div class="col-sm-8">

                                                <?php 

                                                $branch_id =  Auth::user()->branch;
                                                $br_pk_id =  Auth::user()->br_pk_id;

                                                if ($br_pk_id && ($br_pk_id!=NULL || $br_pk_id!='') && $br_pk_id!='0' ) {
                                                      
                                                      // echo $br_pk_id."sub branch ache";

                                                   $get_sub_br_data =   DB::table('branch_info')->where('agent_br_key',$br_pk_id)->first();

                                                 $show_branch =  $get_sub_br_data->name."( $branch_id )";

                                                }else{

                                                    $get_br_data =   DB::table('branch_info')->where('bnk_br_id',$branch_id)->first();

                                                    $show_branch =  $get_br_data->name."( $branch_id )";

                                                }


                                                 ?>
                                               <input type="text" name="" class="form-control" value="<?php echo $show_branch; ?>" readonly>
                                            </div>

                                        </div>


                                        <div class="form-group row">

                                            <label class="col-sm-4 control-label" required="required">Branch Name (if you want to update)</label>

                                            <div class="col-sm-8">

                                                <select class="form-control select2" name="branch_name" id="branch_name" onchange="get_branch_id(this.value);get_division(this.value);">
                                                  <option value="">--select--</option>
                                                  <?php

                                                    $branch_data = DB::table('branch_info')->where('brinfo_flag', 1)->get();

                                                    foreach($branch_data as $single_branch){

                                                      ?>
                                                      <option value="<?php echo $single_branch->bnk_br_id;  ?>" > <?php echo $single_branch->name; ?> ({{ $single_branch->bnk_br_id }})</option>

                                                      <?php
                                                    }
                                                  ?>
                                                  
                                                </select>
                                            </div>

                                        </div>
                                        
                                        <div class="form-group row" id="sub_branch_id_section">

                                            <label class="col-sm-4 control-label" required="required">Sub Branch</label>

                                            <div class="col-sm-8">

                                                <select class="form-control" name="sub_branch_id" id="sub_branch_id">
                                                  
                                                </select>
                                            </div>

                                        </div>





                                      <div class="form-group row" id="division_name_div">

                                        <label class="col-sm-4 control-label" required="required">Present Division Name</label>

                                        <div class="col-sm-8">
                                            
                                             <input type="text" name="" class="form-control" readonly value="<?php echo Auth::user()->division_name; ?>">

                                         
                                        </div>

                                    </div> 


                                     <div class="form-group row" id="division_section">

                                        <label class="col-sm-4 control-label" required="required">Division (if you want to update)</label>

                                        <div class="col-sm-8">
                                            
                                              <select class="form-control select2" name="division_name" id="division_name" onchange="edit_get_division(this.value);">
                                                    <option value="">Select Division</option>
                                                    <?php

                                                     $get_division = DB::table('division')->get();

                                                     foreach ($get_division as  $divison_value) {
                                                        ?>

                                                         <option value="{{$divison_value->division}}">{{$divison_value->division}}</option>

                                                        <?php 
                                                     }
                                                      ?>
                                                   
                                                </select>

                                         
                                        </div>

                                    </div> 



                                        

                                 </div>
                               

                                 <div class="col-md-6">

                                    <div class="form-group row">

                                          <label class="col-sm-4 control-label" required="required">Phone</label>

                                          <div class="col-sm-8">

                                             <input type="text" name="phone" id="phone" value="<?php echo Auth::user()->contact; ?>" class="form-control" >
                                          </div>

                                      </div>
                                     
                                 
                                    <div class="form-group row">

                                        <label class="col-sm-4 control-label" required="required">Email</label>

                                        <div class="col-sm-8">

                                           <input type="text" name="email" value="<?php echo Auth::user()->email; ?>" id="email" class="form-control" readonly>
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-4 control-label" required="required">Designation</label>

                                        <div class="col-sm-8">

                                          

                                           <select class="form-control select2" name="designation" id="designation" >
                                               <option value="">--select--</option>
                                               <?php 

                                               $get_designations = DB::table('designation')->get();

                                               foreach($get_designations as $single_designation){

                                                ?>

                                                <option value="{{$single_designation->designation_name}}" <?php if(Auth::user()->designation==$single_designation->designation_name){echo"selected";} 
                                            ?> >{{$single_designation->designation_name}}</option>
                                                <?php

                                               }
                                               ?>
                                           </select>

                                        </div>

                                    </div> 

                                   

                                     <div class="form-group row" >

                                            <label class="col-sm-4 control-label" required="required">Present User Role</label>

                                            <div class="col-sm-8">

                                              <?php

                                               $present_role_id = Auth::user()->role;

                                               $role_data = DB::table('role_table')->where('sl',$present_role_id)->first();

                                              
                                               
                                               ?>

                                                <input type="text" name="" readonly class="form-control" value="<?php  echo $role_data->role_name; ?>">
                                            </div>

                                        </div>


                                    <div class="form-group row user_role_div" >

                                            <label class="col-sm-4 control-label" required="required">User Role</label>

                                            <div class="col-sm-8">

                                                <select class="form-control" id="user_role" name="user_role">

                                                
                                                  <option value="">--Select --</option>
                                               
                                                
                                                  

                                                </select>
                                            </div>

                                        </div>

                                    <div class="form-group row">

                                        <label class="col-sm-4 control-label" required="required">IP Phone</label>

                                        <div class="col-sm-8">

                                           <input type="text" name="ip_phone" value="<?php echo Auth::user()->ip_phone; ?>" id="ip_phone" class="form-control">
                                        </div>

                                    </div>
                                       
                                   
                                    

                                </div>
                                
                            </div>
                            


                        <div class="form-group">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="button" class="btn btn-primary submit_btn" value="Update"></input>
                        </div>
                    </div>
                    <input type="hidden" id="initial_branch_code" value="{{ Auth::user()->branch }}">

                            </form>

                        </div>
                    </div>
                </div>

                

            </div>

    


  @endsection  

 


  @push('scripts')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

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

   $("user_role_div").hide();
      

    function edit_get_division(division_name){
      


               
             //    $(".it_user").show();
             //    $(".non_it").hide();
             //     $("#user_role").val('');
               
             // }else if(division_name !='IT Division' ){

             //     $(".it_user").hide();
             //     $(".non_it").show();
             //     $("#user_role").val('');

             // }


              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            
             

            $.ajax({
                type: 'POST',
                url: "{{ url('find-user-role') }}",
                data: {
                    "division_name" : division_name
                },
                success: function(data) {
                    console.log(data);

                       if (data!='0') {

                             $("#user_role_div").show();
                            $("#user_role").empty().append(data);

                        }else{

                             $("#user_role_div").hide();
                           
                        } 
                        
                
                   
                },
                error: function(response) {
                    console.log(response);
                }
            });


    }


       $(document).ready(function() {
           
           // initial division show hide check  
            var initial_branch_code = $("#initial_branch_code").val();      
            
            if(initial_branch_code == '202'){
                $("#division_section").show();
                $("#division_name_div").show();
            }else{
                $("#division_section").hide();
                $("#division_name_div").hide();
            }
            
            
            // initial user role check
             if (initial_branch_code=='202') {
                 $("#division_section").show();
                 $("#division_name_div").show();

                $("#opt_br_maker").css('display','none');
                $("#opt_br_checker").css('display','none');
                

                $("#opt_ho_maker").css('display','');
                $("#opt_ho_checker").css('display','');
                $("#opt_hodiv_maker").css('display','');
                $("#opt_hodiv_checker").css('display','');
                $("#opt_ho_authorizer").css('display','');

            }else if(initial_branch_code!='202'){
                $("#division_section").hide();
                $("#division_name_div").hide();
                
                   $("#opt_br_maker").css('display','');
                  $("#opt_br_checker").css('display','');

                  $("#opt_ho_maker").css('display','none');
                  $("#opt_ho_checker").css('display','none');
                  $("#opt_hodiv_maker").css('display','none');
                  $("#opt_hodiv_checker").css('display','none');
                  $("#opt_ho_authorizer").css('display','none');

              }
            
        

        $('#menu_name_all').select2();
       

    });


      function get_division(branch_id){

        // alert(branch_id);return false;

     
        

          if (branch_id=='202') {
             $("#division_section").show();
             $("#division_name_div").show();
           

          }else if(branch_id!='202'){
            $("#division_section").hide();
            $("#division_name_div").hide();

             $("#user_role").html("<option value=''>--select--</option> <option value='1'>Branch Maker</option> <option value='5'>Branch Checker</option>");
            
          }
      } 
      
      $("#sub_branch_id_section").hide();

      function get_branch_id(branch_id){ // fetch sub branch list


        if(branch_id == '202'){
            $("#sub_branch_id_section").hide();


        }else{

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            $.ajax({
                type: 'POST',
                url: "{{ url('find-sub-branch') }}",
                data: {
                    "branch_id" : branch_id
                },
                success: function(data) {
                    console.log(data);

                        if (data!='0') {
                             $("#sub_branch_id_section").show();
                            $("#sub_branch_id").empty().append(data);
                        }else{
                             $("#sub_branch_id_section").hide();
                           
                        }
                        
                
                   
                },
                error: function(response) {
                    console.log(response);
                }
            });


        } //end else
         
      }

     $(".submit_btn").click(function(e) {

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();


         cuteAlert({
          type: "question",
          title: "Do You Want To Update  ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

                  var hidden_id = $("#hidden_id").val();
                 
                  var user_role = $("#user_role").val();
                  var branch_name = $("#branch_name").val();

                  var emp_id = $("#emp_id").val();
                  var phone = $("#phone").val();
                
                
                  var designation = $("#designation").val();
                  var department = $("#department_name").val();
                  var sub_branch_id = $("#sub_branch_id").val();
                  var ip_phone = $("#ip_phone").val();


                  if (branch_name=='') {

                       cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Select Branch",
                          message: "",
                          timer: 10000
                        });
                        return false;

                  }

                  if (emp_id=='') {

                       cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Enter Emnployee Id",
                          message: "",
                          timer: 10000
                        });
                        return false;

                  }


                   if (phone=='') {

                       cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Enter Your phone Number",
                          message: "",
                          timer: 10000
                        });
                        return false;

                  }
                  
                  if(branch_name == '202'){
                    
                    var division_name = $("#division_name").val(); 

                    if (division_name=='') {

                      cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Select Division",
                          message: "",
                          timer: 10000
                        });
                        return false;
                    }


                  }else{
                     var division_name = '';
                  }



                  if(user_role == ''){
                      cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Select User Role",
                          message: "",
                          timer: 10000
                        });
                        return false;
                  }
                  
                 

                  if(designation == ''){
                      cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Select Designation",
                          message: "",
                          timer: 10000
                        });
                        return false;
                  }
                  
                  
                  if(branch_name=='202' && (division_name==null || division_name=='')){
                      cuteAlert({
                          type: "warning", // or 'info', 'error', 'warning'
                           title: "Please Select Division ",
                          message: "",
                          timer: 10000
                        });

                    return false;
                  }
                 
                  var status = $("#status").val();
                 
                
                 var formData = {

                    hidden_id: hidden_id,
                   
                    user_role: user_role,
                    branch_name: branch_name,
                    emp_id: emp_id,
                    phone: phone,
                   
                    designation: designation,
                   
                    status: status,
                    division_name: division_name,
                    ip_phone: ip_phone,
                    sub_branch_id: sub_branch_id                   
                };
            $.ajax({
            type: 'POST',
            url: "{{ url('update_profile') }}",
            data: formData,
            success: function(data) {
                console.log(data);

                if (data!='0') {

                     cuteAlert({
                      type: "success",
                      title: "Successfully Updated ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);
                         return false;

                    });

                }else if(data=='0'){
                  cuteAlert({
                      type: "warning",
                      title: "Please Select Proper Role ",
                      message: "",
                      buttonText: "Okay"
                    });

                  location.reload(true);
                }
               

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });




        } else {

                cuteAlert({
                  type: "warning",
                  title: "Cancel",
                  message: "",
                  timer: 10000
                })
          }
        })

    

       

      }); // end -:- Edit Event Using Modal.   


      $(function() {

            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });

        });

  </script>
   


  @if(Session::has('status_warning'))

    <script type="text/javascript">
      toastr.warning("{!!Session::get('status_warning')!!}");
    </script>

  @endif


 

    @if(Session::has('status_success'))

    <script type="text/javascript">

      toastr.success("{!!Session::get('status_success')!!}");

    </script>

  @endif
  
  

  @endpush