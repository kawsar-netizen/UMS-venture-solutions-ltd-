
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management System|Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/cute_style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <!-- <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/favicon-32x32.png') }}"/> -->
    <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/dbl_fa2.jpg') }}"/>

    <style>
       
       .btn-primary {

            color: #fff !important;
            background-color: rgb(54,88,137) !important;
            border-color: rgb(54,88,137) !important;
        }

        .custom_align_center{
            align-items: center;
            display: flex;
            justify-content: center;
        }


        .for_head_office{
            display: none;
        }


    .ibox{
        position: relative;
    }
    .loader_center{
            position: absolute;
            z-index: 11111111;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }


    </style>

</head>

<body class="gray-bg">

    <div class="row">
                <div class="col-lg-10 offset-lg-1">

                     <!-- loader part -->
                   <div class="loader loader_center" style="">
                    <img src="{{asset('assets/img/loader2.gif')}}" style="">
                  </div>
                  <!-- loader part ends -->

                    <div class="ibox ">
                        <div class="ibox-title custom_align_center">
                            <h5 class="text-center ">

                                <a href="{{url('/')}}"><img src="{{ asset('assets/img/dbl_fa2_small.jpg') }}" > 

                                </a>
                                <span> User ID Creation </span></h5>
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

                           

                            <form method="post" >
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        
                                    
                                        <div class="form-group  row">

                                            <label class="col-sm-4 col-form-label">User ID <span style="color:red;">*</span></label>

                                            <div class="col-sm-8">
                                                <input type="text" name="user_id" id="user_id" value="" class="form-control" >
                                            </div>

                                        </div>

                                        <div class="hr-line-dashed"></div>



                                         <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Domain Password <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                                <input type="password" name="password" id="password" value="" class="form-control" onchange="get_ad(this.value);" placeholder="">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                       


                                         <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Department Name </label>
                                            <div class="col-sm-8">

                                                <input type="text" name="department_name" id="department_name" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Mobile Number <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                                <input type="text" name="mobile_number" id="mobile_number" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email Address <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                                <input type="text" name="email_address" id="email_address" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div> 


                                     <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Employee Id <span style="color:red;">*</span> </label>

                                        <div class="col-sm-8">

                                           <input type="text" name="emp_id" id="emp_id" class="form-control">

                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    </div>
                                

                                    <div class="col-md-6">
                                        
                                    
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Employee Full Name <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                                <input type="text" name="emp_name" id="emp_name" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                         <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Designation <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                              

                                                <select class="form-control select2" name="designation" id="designation">

                                                    <option value='' >--Select Designation--</option>
                                                    <?php 

                                                $designation_all = DB::table('designation')->get();
                                                foreach($designation_all as $single_designation){


                                                    ?>
                                                    
                                                    <option value="{{$single_designation->designation_name}}">{{$single_designation->designation_name}}</option>

                                                    <?php 

                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                         <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Branch Name <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">


                                                <select onchange="branch_name_func(this)" class="form-control select2" id="branch_name" name="branch_name"
                                                  >

                                                  <option value="">--select branch--</option>
                                                    <?php

                                                      $data_usr =  DB::table('branch_info')->where('brinfo_flag',1)->get();
                                                      foreach($data_usr as $single_usr){

                                                      ?>


                                                      
                                                <option   value="<?php echo $single_usr->bnk_br_id; ?>"> <?php echo $single_usr->name; ?> ( <?php  echo $single_usr->bnk_br_id; ?> )</option>
                                                <?php

                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                       


                                        <div class="hr-line-dashed"></div>
                                        
                                         <div class="form-group row sub_branch">
                                            
                                        </div>

                                        
                                             
                                    
                                        <div class="form-group row division" style="display: none" id="division-div">
                                            <label class="col-sm-4 col-form-label">Division Name <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">

                                               

                                                <select class="form-control select2" name="division_name" id="division_name"  onchange="get_division(this.value)" style="width: 100%">
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

                                        <div class="hr-line-dashed"></div>

                                         <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Role <span style="color:red;">*</span></label>
                                            <div class="col-sm-8">
                                                    <input type="hidden" name="user_roleMain" id="user_roleMain" >
                                                <select class="form-control" name="user_role" id="user_role" onchange="setUserRole(this.value)">
                                                    <option value="">--select--</option>
                                                    <option value="1">Branch Maker</option>
                                                    <option value="5">Branch Checker</option>
                                                </select>


                                                  <select class="form-control" name="user_role_ho_maker" id="user_role_ho_maker" style="display: none;" onchange="setUserRole(this.value)">
                                                    
                                                   <option value="">--select--</option>
                                                    <option value="2" class="it_user" >IT Maker</option>

                                                    <option value="6"  class="it_user">IT Checker</option>

                                                    <option value="9" class="non_it">Head Office Division Maker</option>

                                                    <option value="10" class="non_it">Head Office Division Checker</option>

                                                   
                                                </select>

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                       <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">IP Phone </label>
                                            <div class="col-sm-8">

                                                <input type="text" name="ip_phone" id="ip_phone" value="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                                                              

                                   </div>  <!--  end col-md-6 -->



                                 
                              
                                <a href="{{url('/')}}" class="btn btn-info btn-lg" style="margin-left:1%;">Back</a>


                                 
                                <input type="button" class="btn btn-primary submit_btn btn-lg" name="submit" style="margin-left:92%; margin-top: -33px;" value="Submit">


                               </div>

                               
                                       
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <input type="hidden" name="login_route" id="login_route" value="{{ route('login') }}">
            <input type="hidden" name="not_login_route" id="not_login_route" value="{{ url('selfreg') }}">


    <script src="{{ asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('assets/cute-alert.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>


    <script type="text/javascript">

         $(function(){
            setTimeout(()=>{
                $(".loader").fadeOut(500);
            },1000)
        });

       //start function data match in active directory
        function get_ad(password){

             $.ajaxSetup({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                }); 

              var user_id =  $("#user_id").val();

               var formData={                    
                    user_id:user_id,
                    password:password
                };


                $.ajax({

                    type:'POST',
                    url:"{{ url('get_data_from_ad') }}",
                    
                    data:formData,

                    success:function(data){
                       
                       var data_obj = JSON.parse(data);
                        // console.log(data_obj);

                        $("#email_address").val(data_obj.ad_mail);
                        $("#emp_name").val(data_obj.ad_fullname);
                        $("#designation").html(data_obj.ad_designation);
                        $("#designation").html("<option>"+ data_obj.ad_designation +"</option");
                       // $("#division_name").html("<option>"+ data_obj.ad_dept +"</option");
                       

                    },
                     error: function(response) {
                   
                        console.log(response);
                       
                    }
                });

        }

         //end get_ad function data match in active directory
       
       function branch_name_func(a) {

          $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
            });   


            var x = (a.value || a.options[a.selectedIndex].value); 
           

            if (x=='202') {

                  $(".division").css('display','');
                  $("#division-div").css('display','');
                $(".for_head_office").css('display','block');
                $("#user_role_ho_maker").css('display','block');
               
                 $("#user_role").css('display','none');
               

            }else{

                 $(".division").css('display','none');
                 $("#division-div").css('display','none');
                $(".for_head_office").css('display','none');
                $("#user_role_ho_maker").css('display','none');
               
                 $("#user_role").css('display','block');
                


            }

           
            // for sub branch ajax
       

          var formData={
                
                branch_code:x,
            };


             $.ajax({
                type: 'POST',
                url: "{{ url('sub_branch_show') }}",
                data: formData,
                success: function(data) {

                    
                 // alert('Successfull');
                    if (data!=0) {
                        console.log(data);
                         $('.sub_branch').css('display','');
                        $('.sub_branch').html(data.html);
                      
                    }else{
                            console.log(data);
                         $('.sub_branch').css('display','none');
                        
                    }
                    


                },
                error: function(response) {
                   
                    console.log(response);
                       
                }
            });

         // for sub branch ajax end
            

        }

        $(".submit_btn").click(function(e){

          var user_id = $("#user_id").val();
        
          var department_name = $("#department_name").val();
          var mobile_number = $("#mobile_number").val();
          var email_address = $("#email_address").val();
          var password = $("#password").val();
          var emp_name = $("#emp_name").val();
          var designation = $("#designation").val();
          var branch_name = $("#branch_name").val();
            
          

          var sub_branch_name = $("#sub_branch_name").val();
          var division_name = $("#division_name").val();
         
          var user_role = $("#user_roleMain").val();
          var user_role_ho_maker = $("#user_role_ho_maker").val();
          var emp_id = $("#emp_id").val();
          var ip_phone = $("#ip_phone").val();

          

          var email_prefix = email_address.split("@");
          var email_domain_id = email_prefix[0];

          if(user_id != email_domain_id){
            cuteAlert({
                type: "warning", // or 'info', 'error', 'warning'
                title: "Your domain id and email didn't same",
                message: "",
                timer: 10000
            });
            return false;
          }


      var mail_prefix = email_address.includes("@dhakabank.com.bd");

            


             if (user_id==null || user_id=='') {

                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Your User Id",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (mobile_number==null || mobile_number=='') {


                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Your Mobile Number",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (email_address==null || email_address=='') {

                 var mail_prefix = email_address.includes("@dhakabank.com.bd");



                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Your Email Address",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (mail_prefix==false) {

                

                

                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Invalid Mail Format ",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (password==null || password=='') {

                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Your Password",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (emp_name==null || emp_name=='') {

                 cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Your Employee Name",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (designation==null || designation=='') {

                cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Designation",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (branch_name==null || branch_name=='') {

               

                 cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Branch Name",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (emp_id==null || emp_id=='') {

                  cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter Employee Id ",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (branch_name=='202' && (division_name==null || division_name=='')) {

                  cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Select Division ",
                      message: "",
                      timer: 10000
                    });

                return false;

             }else if (branch_name!='202' && (user_role==null || user_role=='')) {

                  cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Enter User Role ",
                      message: "",
                      timer: 10000
                    });

                return false;

             }


             // if (division_name=='IT Division') {
             //    alert('IT Division');
             //    $(".it_user").attr('style',"display:''");
             //    $(".non_it").attr('style',"display:'none'");
               
             // }else if(division_name !='IT Division'){
             //     $(".it_user").attr('style',"display:'none'");
             //    $(".non_it").attr('style',"display:''");
             // }
         

             $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
            });
        e.preventDefault();

            cuteAlert({
          type: "question",
          title: "Do You Want To Create New Id",
          message: "",
          confirmText: "Submit",
          cancelText: "Cancel"
        }).then((e)=>{

            
          
          if ( e == ("confirm")){


       
               var formData = {
                
                'user_id' : user_id,
               
                'department_name' : department_name,
                'mobile_number' : mobile_number,
                'email_address' : email_address,
                'password' : password,
                'emp_name' : emp_name,
                'designation' : designation,
                'branch_name' : branch_name,
                'division_name' : division_name,
                
                'user_role' : user_role,
                'user_role_ho_maker' : user_role_ho_maker,
                'emp_id' : emp_id,
                'ip_phone' : ip_phone,
                'sub_branch_name' : sub_branch_name
                
               
            };



             $.ajax({
                type: 'POST',
                url: "{{ url('self_reg_submit') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                   jQuery(".ibox").css('display','none');
                },

                success: function(data) {

                    console.log(data);

                    
                    
                    if(data.success === false){
                        cuteAlert({
                         type: "warning",
                         title: "This User Already Exist",
                         message: data.message,
                         buttonText: "Okay",
                         timer: 10000
                       })

                    }else{

                         console.log(data);
                   
                           if (data==0) {

                                cuteAlert({
                                      type: "warning",
                                      title: "AD User Id Or Password Wrong",
                                      message: "",
                                      buttonText: "Okay"
                                    }).then((e)=>{

                                        var not_login_route = $("#not_login_route").val();
                                        // window.location.href = not_login_route;

                                    });


                           }else{   // data !=0
                               
                                cuteAlert({
                                      type: "success",
                                      title: "Successfully Id Created !",
                                      message: "",
                                      buttonText: "Okay"
                                    }).then((e)=>{

                                        var login_route = $("#login_route").val();
                                         window.location.href = login_route;

                                    });

                                } // data !=0

                           }
                    

                

                },
                error: function(response) {
                   
                    console.log(response);
                     
                        cuteAlert({
                      type: "warning",
                      title: "Please Insert Your Proper Domain Id and Domain Password !",
                      message: "",
                      buttonText: "Okay",
                      timer: 10000
                    })


                },

                 complete: function() {

                     jQuery(".loader").hide();

                     jQuery(".ibox").css('display','');
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


    
     function get_division(division_name){
        if (division_name=='IT Division') {

                $("#user_role_ho_maker").val('');
                $(".it_user").show();
                $(".non_it").hide();
               
               
             }else if(division_name !='IT Division'){

                 $("#user_role_ho_maker").val('');
                 $(".it_user").hide();
                $(".non_it").show();
              

             }
    }

    $(document).ready(function() {
         $('.select2').select2();
    });
function setUserRole(role)
{
     $("#user_roleMain").val(role);
}
    </script>






</body>
</html>





