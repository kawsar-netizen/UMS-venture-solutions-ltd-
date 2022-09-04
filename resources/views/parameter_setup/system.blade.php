@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">parameter Setup</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">System</b></a>
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
                            <h5>System</h5>
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

                            <form action="{{ url('system_submit') }}" method="POST">
                               @csrf

                                <div class="form-group row"><label class="col-lg-2 col-form-label">System Name</label>

                                    <div class="col-lg-10"><input type="text" placeholder="System Name" class="form-control" name="system_name"> 
                                    </div>

                                </div>


                                <div class="form-group row"><label class="col-lg-2 col-form-label">System Id</label>

                                    <div class="col-lg-10"><input type="text" placeholder="System Id" class="form-control" name="system_id"></div>

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
                            <h5>System Table</h5>
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
                                        
                                       <th scope="col" style="color: black">System Id</th>

                                        <th scope="col" style="color: black">System Name</th>

                                        <th scope="col" style="color: black">System Status</th>
                                      

                                       
                                         <th scope="col" style="color: black">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                          $system_data =  DB::table('systems')->orderBy('id','DESC')->get();
                                          // echo"<pre>";
                                          // print_r($system_data);

                                          $sl=0;
                                          foreach($system_data as $single_data){

                                                $sl++
                                            ?>
                                        
                                        <tr>

                                            <td><?php echo $sl;  ?></td>
                                            <td><?php echo $single_data->sys_id;  ?></td>
                                            <td><?php echo $single_data->system_name;  ?></td>
                                            <td><?php 
                                            $status = $single_data->sys_status;
                                            if ($status==1) {
                                                echo "<span class='badge badge-info'> Active </span>";
                                            }else{

                                                 echo "<span class='badge badge-danger'> Deactive </span>";

                                            }
                                              ?></td>
                                            

                                            <td><button onclick="edit_system(<?php echo $single_data->id; ?>)" class="btn btn-sm btn-info">Edit</button> 

                                             <button class="btn btn-sm btn-danger" onclick="delete_system(<?php echo $single_data->id; ?>)">Delete</button></td>

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
        <h4 class="modal-title" id="exampleModalLabel"> <b>System Edit  </b></h4>
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
    function edit_system(id){
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
            url: "{{ url('system_edit_data') }}",
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

    $(".update_system").click(function(e) {

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
             var system_id = $("#system_id").val();
             var system_name = $("#system_name").val();
             var status = $("#status").val();

            var formData = {

                hidden_id: hidden_id,
                system_id: system_id,
                system_name: system_name,
                status: status,
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('update_system') }}",
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
</script>
<script>
    function delete_system(id){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        cuteAlert({
          type: "question",
          title: "Do You Want To Delete ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){


            var formData = {
                id:id
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('delete_system') }}",
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
</script>

  @endpush