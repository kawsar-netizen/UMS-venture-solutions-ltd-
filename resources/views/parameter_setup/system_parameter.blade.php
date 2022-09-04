@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">parameter Setup</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">System Parameter</b></a>
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
           
                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>System Parameter</h5>
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

                            <form action="{{ url('system_parameter_submit') }}" method="POST">
                               @csrf

                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>System</b></label>

                                    <div class="col-lg-10">

                                        <select class="form-control select2" name="system">

                                            <option>--select--</option>
                                            <?php

                                               $system_data = DB::table('systems')->where('sys_status','1')->get();

                                               foreach ($system_data as $key => $system_value) {
                                                  ?>
                                            
                                           <option value="{{$system_value->id}}">{{$system_value->system_name}}</option>
                                           
                                           <?php


                                              }
                                            ?>
                                           
                                        </select>
                                    </div>

                                </div>


                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>Parameter Type</b></label>

                                    <div class="col-lg-10">

                                        <select class="form-control" name="para_type">

                                            <option>--select--</option>
                                            
                                           <option value="1">Input Field</option>
                                           <option value="2">Check Box</option>
                                           <option value="3">Radio</option>
                                           
                                         
                                           
                                        </select>
                                    </div>

                                </div>



                                <div class="form-group row"><label class="col-lg-2 col-form-label"><b>Parameter Name</b></label>

                                    <div class="col-lg-10"><input type="text" placeholder="Parameter Name" class="form-control" name="parameter_name"></div>

                                </div>


                                 <div class="form-group row"><label class="col-lg-2 col-form-label"><b>User Role</b></label>

                                    <div class="col-lg-10">
                                        
                                        <select class="form-control" name="user_role">
                                            <?php 

                                                $role_data = DB::table('role_table')->get();

                                                foreach($role_data as $single_role_info){

                                                    ?>
                                                 <option value="{{$single_role_info->sl}}">{{$single_role_info->role_name}}</option>

                                                    <?php 
                                                }

                                            ?>
                                           
                                           
                                        </select>
                                    </div>

                                </div>
                               
                                <div class="form-group row">
                                    <div class="offset-lg-2 col-lg-10">
                                        <input type="submit" name="submit" class="btn btn-sm btn-success" value="submit">
                                       
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>System Parameter Table</h5>
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
                   
                              <table id="example"  class="table table-striped" >
                                    <thead>
                                    <tr>
                                       <th scope="col" style="color: black">Sl</th>
                                        
                                    

                                        <th scope="col" style="color: black">System Name</th>
                                        <th scope="col" style="color: black">Parameter Type</th>

                                        <th scope="col" style="color: black">Parameter Name</th>
                                        <th scope="col" style="color: black">User Role</th>
                                      

                                       
                                         <th scope="col" style="color: black;width: 22%;">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                       <?php

                                       $sl=0;
                                        $system_parameters_data = DB::select(DB::raw("SELECT  sp.[para_id]
                                            ,sp.[system_id]
                                          ,sp.[para_name]
                                          ,sp.[para_type]
                                        
                                          ,sp.[para_status]
                                          ,sp.[user_role]
                                          ,sys.[system_name]

                                      FROM [sys_parameters] sp

                                      left join systems sys on sys.id = sp.[system_id] where sp.para_status!=0  order by sp.para_id desc "));

                                        foreach($system_parameters_data as $single_data){

                                                $sl++;


     //                                      print "INSERT INTO [dbo].[sys_parameters]
     //       ([system_id]
     //       ,[para_name]
     //       ,[para_type]
     //       ,[entry_date]
     //       ,[entry_by]
     //       ,[para_status]
     //       ,[user_role])
     // VALUES
     //       ('$single_data->system_id'
     //       ,'$single_data->para_name'
     //       ,'$single_data->para_type'
     //       ,''
     //       ,''
     //       ,'$single_data->para_status'
     //       ,'8')";

     //       echo "<br>";
     //       echo "<br>";
                                              

                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?> </td>
                                                <td><?php echo $single_data->system_name; ?></td>
                                                <td><?php

                                                 $para_type = $single_data->para_type;

                                                        if($para_type==1){

                                                            echo "Input Field";

                                                        }elseif($para_type==2){

                                                            echo "Check Box";
                                                        }elseif($para_type==3){

                                                            echo "Radio";
                                                        }
                                                 ?></td>

                                                <td><?php echo $single_data->para_name; ?></td>

                                                <td><?php 

                                                $user_role = $single_data->user_role;
                                                if ($user_role) {
                                                    
                                                    $usr_role_data = DB::table('role_table')->where('sl',$user_role)->first();

                                                    echo $usr_role_data->role_name;
                                                }
                                               
                                                 ?></td>

                                                <td style="width: 22%;">

                                                    <button class="btn btn-info btn-sm" onclick="edit_sys_para(<?php echo $single_data->para_id; ?>)">Edit</button> 

                                                     <button class="btn btn-danger btn-sm" onclick="disable(<?php echo $single_data->para_id; ?>);">Delete</button></td>
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
           
          
        </div>

    <div class="modal fade halimmodal_for_show_details" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"> <b>System Parameter Edit  </b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_data">
       

     
       
          
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_system_para">Update</button>
      </div>

    </div>
  </div>
</div>

         
@endsection


  @push('scripts')

   @if(Session::has('status_success'))

    <script type="text/javascript">

      toastr.success("{!!Session::get('status_success')!!}");

    </script>

  @endif


  @if(Session::has('status_warning'))

    <script type="text/javascript">
      toastr.warning("{!!Session::get('status_warning')!!}");
    </script>

  @endif
  
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
    function edit_sys_para(id){

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
            url: "{{ url('system_para_edit_data') }}",
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


     $(".update_system_para").click(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();

        cuteAlert({
          type: "question",
          title: "Do You Want To Update ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

             var hidden_id = $("#hidden_id").val();
             var system_name = $("#system_name").val();
             var para_type = $("#para_type").val();
             var para_name = $("#para_name").val();
             var user_role = $("#user_role").val();

             // alert(user_role);return false;


            var formData = {

                hidden_id: hidden_id,
             
                system_name: system_name,
                para_type: para_type,
                para_name: para_name,
                user_role: user_role,
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('update_system_parameter') }}",
                data: formData,
                success: function(data) {

                    
                  $('.halimmodal_for_show_details').modal('hide');

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



// delete operation start


       function disable(id){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
      

        cuteAlert({
          type: "question",
          title: "Do You Want To Delete It ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

           
            
             // alert(user_role);return false;


            var formData = {

                id: id
              
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('delete_system_parameter') }}",
                data: formData,
                success: function(data) {

                 cuteAlert({
                      type: "success",
                      title: "Successfully Deleted ! ",
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
    }

    // delete operation end
</script>

  @endpush