@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">System User Id Map</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">System User Id Map</b></a>
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
                            <h5>System User Id Map</h5>
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

                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>System</b></label>

                                    <div class="col-lg-10">

                                        <select class="form-control select2" required="" name="system_id" id="system_id">

                                            <option value="">--select--</option>
                                            <?php

                                               foreach ($system_data as $system_value) {
                                                  ?>
                                            
                                           <option value="{{$system_value->id}}">{{$system_value->system_name}}</option>
                                           
                                           <?php


                                              }
                                            ?>
                                           
                                        </select>
                                    </div>

                                </div>


                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>System User Id</b></label>

                                    <div class="col-lg-10">

                                       <input type="text" name="system_user_id" id="system_user_id" class="form-control">
                                    </div>

                                </div>



                               
                               
                                <div class="form-group row">
                                    <div class="offset-lg-2 col-lg-10">
                                        <input type="button"  name="submit" class="btn btn-sm btn-success insert_btn" value="Submit">
                                       
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>System User Id Map Table</h5>
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
                                        
                                    

                                        <th scope="col" style="color: black">System Name</th>
                                        <th scope="col" style="color: black">System user Id</th>
                                        <th scope="col" style="color: black">Entry Date</th>

                                       
                                      

                                       
                                         <th scope="col" style="color: black;width: 22%;">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                       <?php

                                       $sl=0;
                                     

                                        foreach($system_get_data as $data){

                                                $sl++;



                                              

                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?> </td>
                                                <td><?php echo $data->system_name; ?></td>

                                                <td>{{$data->sys_user_id}}</td>

                                             

                                               <td>{{$data->entry_date}}</td>

                                                <td style="width: 22%;">

                                                    <button class="btn btn-info btn-sm" onclick="edit_sys_para(<?php echo $data->id; ?>)">Edit</button> 

                                                    <button class="btn btn-danger btn-sm" onclick="delete_sys_para(<?php echo $data->id; ?>)">Delete</button></td>
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
        <h4 class="modal-title" id="exampleModalLabel"> <b>System User Id  Edit  </b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_data">
       

     
       
          
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_system_user_id">Update</button>
      </div>

    </div>
  </div>
</div>

         
@endsection


  @push('scripts')

   


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


  $(".insert_btn").click(function(){

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });



    

        cuteAlert({
          type: "question",
          title: "Do You Want To Insert ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

     var system_id = $("#system_id").val();
     var system_user_id = $("#system_user_id").val();

     if (system_id==null || system_id=='') {
          cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Select System ",
                      message: "",
                      timer: 10000
                    });

                return false;
     }


     if (system_user_id==null || system_user_id=='') {
          cuteAlert({
                      type: "warning", // or 'info', 'error', 'warning'
                       title: "Please Select System User Id",
                      message: "",
                      timer: 10000
                    });

                return false;
     }

      var formData = {
                system_id:system_id,
                system_user_id:system_user_id,
               
            };



        $.ajax({

             type: 'POST',
            url: "{{ url('system_user_id_map_insert') }}",
            data: formData,

            success: function(data) {

                  console.log(data);


                  if(data=='0') {

                       cuteAlert({
                      type: "warning",
                      title: "This System Already Exist ! ",
                      message: "",
                      buttonText: "Okay"

                    });
                  }

                  if (data=='1') {

                       cuteAlert({
                      type: "success",
                      title: "Successfully Inserted ! ",
                      message: "",
                      buttonText: "Okay"

                    }).then((e)=>{

                         location.reload(true);

                    });

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

  });



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
            url: "{{ url('system_user_id_edit_data') }}",
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




     $(".update_system_user_id").click(function(e) {

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
             var edit_system_user_id = $("#edit_system_user_id").val();
          
             // alert(user_role);return false;


            var formData = {

                hidden_id: hidden_id,
             
                edit_system_user_id: edit_system_user_id,
               
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('update_system_user_id') }}",
                data: formData,
                success: function(data) {

                    
                  $('.halimmodal_for_show_details').modal('hide');

                  if (data=='1') {

                    cuteAlert({
                      type: "success",
                      title: "Successfully Updated ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });

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

    });



    function delete_sys_para(id){


        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        var formData = {
                id:id
               
            };

            

          cuteAlert({
          type: "question",
          title: "Do You Want To Delete ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

        $.ajax({

             type: 'POST',
            url: "{{ url('system_user_id_delete_data') }}",
            data: formData,

            success: function(data) {

                  console.log(data);

                if (data=='1') {

                     cuteAlert({
                      type: "success",
                      title: "Delete Successfully ! ",
                      message: "",
                      buttonText: "Okay"

                    }).then((e)=>{

                         location.reload(true);

                    });

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

    }

</script>

  @endpush