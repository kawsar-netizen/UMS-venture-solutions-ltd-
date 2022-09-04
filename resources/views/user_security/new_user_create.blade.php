
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
                        <a href=""><b style="color: white">New User Create</b></a>
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

                    <div class="col-lg-5">
                     <div class="ibox ">
                        <div class="ibox-title">
                            <h5>New User Create</h5>
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

                            <form action="{{ url('new_user_create_submit') }}" method="POST">
                               @csrf

                               <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">User Name</label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="user_name"  id="user_name" />
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">User Role</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="user_role" name="user_role">

                                        	<option value="1">Branch Maker</option>
                                        	<option value="5">Branch Checker</option>
                                        	<option value="2">Head Office Maker</option>
                                        	<option value="6">Head Office Checker</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Branch Name</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" name="branch_name" id="branch_name">
                                        	<?php

                                        		$branch_data = DB::table('branch_info')->get();

                                        		foreach($branch_data as $single_branch){

                                        			?>
                                        			<option value="<?php echo $single_branch->br_code;  ?>"><?php echo $single_branch->name; ?></option>

                                        			<?php
                                        		}
                                        	?>
                                        	
                                        </select>
                                    </div>

                                </div>
                                

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Phone</label>

                                    <div class="col-sm-8">

                                       <input type="text" name="phone" id="phone" class="form-control">
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Email</label>

                                    <div class="col-sm-8">

                                       <input type="text" name="email" id="email" class="form-control">
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Designation</label>

                                    <div class="col-sm-8">

                                       <input type="text" name="designation" id="designation" class="form-control">
                                    </div>

                                </div> 

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Password</label>

                                    <div class="col-sm-8">

                                       <input type="text" name="password" id="password" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">User Id</label>

                                    <div class="col-sm-8">

                                       <input type="text" name="user_id" id="user_id" class="form-control">

                                    </div>

                                </div> 

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Status</label>

                                    <div class="col-sm-8">

                                       <select class="form-control" name="status" id="status">
                                       		<option value="1">Active</option>
                                       		<option value="0">Deactive</option>
                                       </select>

                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Expire Date</label>

                                    <div class="col-sm-8">

                                    	<input type="text" name="exp_date" id="datepicker" class="form-control">

                                    </div>

                                </div>
                            


                        <div class="form-group">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="button" class="btn btn-primary submit_btn" value="submit"></input>
                        </div>
                    </div>


                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>User Info</h5>
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
                   
                              <table id="myTable"  class="table table-striped" >
                                    <thead>
                                    <tr>
	                                       <th scope="col" style="color: black">Sl</th>
	                                        
	                                       <th scope="col" style="color: black">User Name</th>

	                                        <th scope="col" style="color: black">Role</th>

	                                        <th scope="col" style="color: black">Branch</th>
	                                        <th scope="col" style="color: black">Phone</th>
	                                        <th scope="col" style="color: black">Email</th>
	                                        <th scope="col" style="color: black">Designation</th>
	                                      
	                                        <th scope="col" style="color: black">User Id</th>
	                                        <th scope="col" style="color: black">Status</th>
	                                      
	                                      

	                                         <th scope="col" style="color: black">Action </th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                    	<?php

                                    	$data_users =DB::table('users')->get();
                                    	$sl=0;
                                    	foreach($data_users as $single_data_usr ){
                                    		$sl++;

                                    		?>

                                    	<tr>
                                        	
                                        	<td><?php echo $sl; ?></td>	
                                        	<td><?php echo $single_data_usr->name; ?></td>	
                                        	<td><?php 

                                             $role_id = $single_data_usr->role;

                                           
                                                
                                                $role_data = DB::table('role_table')->where('sl',$role_id)->first();

                                                if ($role_data) {
                                                   echo $role_data->role_name;
                                                }else{
                                                    echo "--";
                                                }
                                              
                                            
	                                           

                                        	 ?></td>

                                        	 <td>
                                        	 	<?php

                                        	 		$branch_code = $single_data_usr->branch;

                                                   $branch_data = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();

                                                   if ($branch_data) {

                                                      echo $branch_data->name;
                                                   }else{

                                                    echo"--";
                                                   }
                                                   // echo "<pre>";
                                                   // print_r($branch_data);
                                        	 	?>
                                        	 </td>	

                                        	 <td><?php echo $single_data_usr->contact;  ?></td>
                                        	 <td><?php echo $single_data_usr->email;  ?></td>
                                        	 <td><?php echo $single_data_usr->designation;  ?></td>
                                        	 <td>user id</td>
                                        	 <td><?php 

                                        	 $status_id = $single_data_usr->status_id;
                                        	 if ($status_id==1) {

                                        	 	echo"<span class='badge badge-info'>Active</span>";
                                        	 }else{
                                        	 	echo"<span class='badge badge-danger'>Inactive</span>";
                                        	 }
                                        	   ?></td>

                                        	   

                                        	   <td><button onclick="edit_user(<?php echo $single_data_usr->id;  ?>)" class="btn btn-info "><i style="color:#fff;" class="fa fa-pencil-square-o" aria-hidden="true"></i></button>  <br> <br> <button class="btn btn-danger "><i style="color:#fff;" class="fa fa-trash" aria-hidden="true"></i></button></td>

                                        </tr>

                                    		<?php

                                    			}
                                    		?>
                                       
                                        
                                    </tbody>

                                </table>

                               </div> 

                     </div>

                </div>

            </div>


<div class="modal fade bd-example-modal-lg halimmodal_for_show_details" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"> <b> User Edit  </b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_data">
       

     
       
          
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_system">Update</button>
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
       $(document).ready(function() {

        

        $('#menu_name_all').select2();
       

    });


     $(".submit_btn").click(function(e) {

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();


         cuteAlert({
          type: "question",
          title: "Do You Want To Insert  ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

			  	  var user_name = $("#user_name").val();
			  	  var user_role = $("#user_role").val();
			      var branch_name = $("#branch_name").val();
			      var phone = $("#phone").val();
			      var email = $("#email").val();
			      var designation = $("#designation").val();
			      var password = $("#password").val();
			      var user_id = $("#user_id").val();
			      var status = $("#status").val();
			      var datepicker = $("#datepicker").val();


		        
		         var formData = {
		            user_name: user_name,
		            user_role: user_role,
		            branch_name: branch_name,
		            phone: phone,
		            email: email,
		            designation: designation,
		            password: password,
		            user_id: user_id,
		            status: status,
		            datepicker: datepicker,
		        };

            $.ajax({
            type: 'POST',
            url: "{{ url('new_user_data_submit') }}",
            data: formData,
            success: function(data) {

               	cuteAlert({
                      type: "success",
                      title: "Successfully Updated ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });

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
  
  
  <script type="text/javascript">
  	function edit_user(id){

  		 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        var formData = {
                id:id,
               
            };

         $.ajax({

             type: 'POST',
            url: "{{ url('user_edit_data') }}",
            data: formData,

            success: function(data) {

                  console.log(data);

               $('.halimmodal_for_show_details').modal('show');
                 $('.modal_data').html(data.html);

            },

             error: function(response) {

                alert(response);
                console.log(response);
            }
            
        });     

  	}

    $(".update_system").click(function(e){


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
                  var user_name = $("#edit_user_name").val();
                 

                  var user_role = $("#edit_user_role").val();
                  var branch_name = $("#edit_branch_name").val();

                 
                  var phone = $("#edit_phone").val();
                  var email = $("#edit_email").val();
                  var designation = $("#edit_designation").val();
                  
                  var user_id = $("#edit_user_id").val();
                  var status = $("#edit_status").val();
                 

                 var formData = {
                    hidden_id: hidden_id,
                    user_name: user_name,
                    user_role: user_role,
                    branch_name: branch_name,
                    phone: phone,
                    email: email,
                    designation: designation,
                    
                    user_id: user_id,
                    status: status,
                   
                };

            $.ajax({
            type: 'POST',
            url: "{{ url('new_user_data_update') }}",
            data: formData,
            success: function(data) {

                cuteAlert({
                      type: "success",
                      title: "Successfully Updated ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });

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


    });
  </script>

  @endpush