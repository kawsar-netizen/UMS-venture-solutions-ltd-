@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Designation Setup</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Designation</b></a>
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
                            <h5>Designation</h5>
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

                          
                                <div class="form-group row"><label class="col-lg-2 col-form-label"><b>Title</b></label>

                                    <div class="col-lg-10">
                                        <input type="text" id="designation_name" placeholder="Designation Title" class="form-control" name="designation_name" required="">
                                    </div>

                                </div>
                               
                                <div class="form-group row">
                                    <div class="offset-lg-2 col-lg-10">

                                        <input type="button" name="submit" class="btn btn-sm btn-success request_submit" value="submit">
                                       
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Designation list</h5>
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
                                        
                                      
                                        <th scope="col" style="color: black">Designation</th>

                                      
                                       
                                         <th scope="col" style="color: black;width:28%;">Action</th>
                                         <th></th>
                                      </tr>
                                    </thead>



                                    <tbody>

                                       @php
                                            $designation_data = DB::table('designation')->orderBy('sl', 'desc')->get();
                                            $sl=1;
                                        @endphp

                                        @foreach($designation_data as $designation)

                                        <tr>
                                        	<td>{{ $sl++ }}</td>
                                        	<td>{{ $designation->designation_name }}</td>

                                        	 <td style="width:28%">

                                        	 	<button onclick="edit_designation(<?php echo $designation->sl; ?>)" class="btn btn-sm btn-info">Edit</button> </td>
                                            <td></td>
  
                                        </tr>

                                        @endforeach
                                        
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
        <h4 class="modal-title" id="exampleModalLabel"> <b>Designation Title Edit  </b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal_data">
       

     
       
          
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_designation">Update</button>
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
   

     $(".request_submit").click(function(e){
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();

        cuteAlert({
          type: "question",
          title: "Do You Want To Insert ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

            
             var designation_name = $("#designation_name").val();
            
            if(designation_name =='')
            {

  					alert('Please give designation Title');
  					exit;

            }
			            

            var formData = {

              
                designation_name: designation_name,
            
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('degingation_submit') }}",
                data: formData,
                success: function(data) {


                 cuteAlert({
                      type: "success",
                      title: "Successfully Inserted ! ",
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


     function edit_designation(id){


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
            url: "{{ url('designation_edit_data') }}",
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


     $(".update_designation").click(function(){


          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        

        cuteAlert({
          type: "question",
          title: "Do You Want To Update ?",
          message: "",
          confirmText: "Okay",
          cancelText: "Cancel"
        }).then((e)=>{

          if ( e == ("confirm")){

             var hidden_id = $("#hidden_id").val();
             var edit_designation_name = $("#designtaion_title").val();
          
            if(edit_designation_name =='')
            {

  					alert('Please give designation Title');
  					exit;

            }


            var formData = {

                hidden_id: hidden_id,
                edit_designation_name: edit_designation_name,
               
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('update_designation_title') }}",
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
</script>

  @endpush