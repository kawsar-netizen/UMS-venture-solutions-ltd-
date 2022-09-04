@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Division Setup</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Division</b></a>
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
                
               
              <?php 


              $get_branch_data_count =  DB::table('branch_info')->where('agent_br_key',$id)->where('brinfo_flag',1)->count();


              if ($get_branch_data_count>0) {
               
              

              $get_branch_data =  DB::table('branch_info')->where('agent_br_key',$id)->where('brinfo_flag',1)->first();

              ?>
                <div class="col-lg-6" style="
                <?php 
                  if ($get_branch_data_count=='0') {
                    echo "display: none;";
                  }
                ?>
                ">
                   @if(session()->has('status'))
                      <div class="alert alert-success">
                          {{ session()->get('status') }}
                      </div>
                  @endif

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Branch Edit</h5>
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

                            <form action="{{ url('branch_update') }}" method="POST">
                               @csrf


                               <input type="hidden" name="hidden_branch_id" value="{{$get_branch_data->agent_br_key}}">


                              <div class="row">
                                <div class="col-md-12">
                                  

                                <div class="form-group row">

                                  <label class="col-lg-2 col-form-label"><b>Branch Name </b></label>

                                    <div class="col-lg-10">
                                        <input type="text" id="branch_name" placeholder="Branch Name" class="form-control" name="branch_name" value="{{$get_branch_data->name}}" required="">
                                    </div>

                                </div>


                                <div class="form-group row">

                                  <label class="col-lg-2 col-form-label"><b>Branch Code </b></label>

                                    <div class="col-lg-10">
                                        <input type="text" id="branch_code" placeholder="Branch Code" class="form-control" name="branch_code"  value="{{$get_branch_data->bnk_br_id}}"  required="">
                                    </div>

                                </div>
                               
                                
                                 <div class="form-group row">
                                    <div class="offset-lg-2 col-lg-10">

                                        <input type="submit" name="update_branch" class="btn btn-sm btn-success" value="submit">
                                       
                                    </div>
                                </div>

                                </div>
                              </div>


                             


                            </form>

                        </div>
                    </div>
                </div>



                <?php 

                }

              $get_sub_branch_data_count =  DB::table('branch_info')->where('agent_br_key',$id)->where('brinfo_flag',2)->count();

            if ($get_sub_branch_data_count>0) {

                 $get_sub_branch_data =  DB::table('branch_info')->where('agent_br_key',$id)->where('brinfo_flag',2)->first();
              

            

              ?>

                 <div class="col-lg-6" style="
                <?php 
                  if ($get_sub_branch_data_count=='0') {
                    echo "display: none;";
                  }
                ?>
                ">
                   @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sub Branch Edit</h5>
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

                            <form action="{{ url('sub_branch_update') }}" method="POST">
                               @csrf

                               <input type="hidden" name="sub_branch_hidden_id" value="{{$get_sub_branch_data->agent_br_key}}">

                              <div class="row">
                                <div class="col-md-12">
                                  

                                  <div class="form-group row">

                                  <label class="col-lg-2 col-form-label"><b>Select Main Branch </b></label>

                                    <div class="col-lg-10">
                                       

                                        <select class="form-control select2" name="select_main_branch">
                                            <option value="">--select--</option>

                                            <?php 
                                            $get_branch_data =  DB::table('branch_info')->where('brinfo_flag',1)->where('bnk_br_id','!=','202')->get();

                                            foreach ($get_branch_data as $single_branch) {
                                             ?>

                                             <option value="{{$single_branch->bnk_br_id}}" <?php 

                                              if ($get_sub_branch_data->bnk_br_id==$single_branch->bnk_br_id) {
                                                echo 'selected';
                                              }

                                             ?>

                                             >{{$single_branch->name}} ({{$single_branch->bnk_br_id}})</option>

                                             <?php 
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">

                                  <label class="col-lg-2 col-form-label"><b>Sub Branch Name </b></label>

                                    <div class="col-lg-10">
                                        <input type="text" id="sub_branch_name" placeholder="Sub Branch Name" class="form-control" name="sub_branch_name" value="{{$get_sub_branch_data->name}}" required="">
                                    </div>

                                </div>


                               
                               
                                
                                 <div class="form-group row">
                                    <div class="offset-lg-2 col-lg-10">

                                        <input type="submit" name="sub_branch_update" class="btn btn-sm btn-success" value="submit">
                                       
                                    </div>
                                </div>

                                </div>
                              </div>


                             


                            </form>

                        </div>
                    </div>
                </div> <!-- end col-6 -->


                <?php 

              }
                ?>



                
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

  					alert('Please give division Title');
  					exit;

            }
			            

            var formData = {

              
                designation_name: designation_name,
            
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('division_submit') }}",
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
            url: "{{ url('division_edit_data') }}",
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

  					alert('Please give division Title');
  					exit;

            }


            var formData = {

                hidden_id: hidden_id,
                edit_designation_name: edit_designation_name,
               
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('update_division_title') }}",
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