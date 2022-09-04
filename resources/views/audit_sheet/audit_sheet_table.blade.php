@extends('master.master')

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Audit sheet</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Audit sheet</b></a>
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
           
                
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Audit sheet Table</h5>
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
                                        
                                      
                                        <th scope="col" style="color: black">Branch Name</th>
                                        <th scope="col" style="color: black">Branch Code</th>
                                        <th scope="col" style="color: black">Division Name</th>

                                        <th scope="col" style="color: black">Status</th>
                                        <th scope="col" style="color: black">Entry Date</th>
                                        <th scope="col" style="color: black" >Mail To</th>
                                        <th scope="col" style="color: black">Entry By</th>
                                        <th scope="col" style="color: black">Authorized By</th>
                                        <th scope="col" style="color: black" style="width: 250px;">Action</th>
                                      

                                       
                                        </tr>

                                    </thead>


                                        <tbody>    

                                        <?php  

                                           $audit_sheet_data = DB::select(DB::raw("select distinct ai.id, ai.branch_name,ai.branch_code,  aus.audit_id, ai.status, ai.entry_date, ai.division_name, ai.maker, ai.checker, ai.sub_br_pk,ai.email from [audit_id] ai  left join [audit_system] aus on ai.id = aus.audit_id order by ai.id desc"));

                                           $sl=0;
                                       foreach($audit_sheet_data as $single_audit_data){
                                            $sl++;


                                            if ($single_audit_data->sub_br_pk) {

                                              $sub_br_pk = $single_audit_data->sub_br_pk;

                                            $sub_br_pk_data =  DB::table('branch_info')->where('agent_br_key',$sub_br_pk)->first();

                                            $branch_name = $sub_br_pk_data->name;

                                            }else{
                                               $branch_name = $single_audit_data->branch_name;
                                            }

                                       

                                         
                                             $status = $single_audit_data->status;

                                            ?>

                                        
                                       
                                        <tr>
                                            
                                            <td><?php echo $sl;?> </td>

                                            
                                            <td><?php echo $branch_name; ?> </td>
                                            <td><?php echo $single_audit_data->branch_code; ?> </td>
                                            <td><?php echo $single_audit_data->division_name; ?> </td>
                                           
                                            <td><?php if($status=='0'){
                                                echo '<span class="badge badge-warning">Waiting For Authorize</span>';

                                            }elseif($status=='1'){

                                                echo '<span class="badge badge-success">Authorized</span>';

                                            } ?> </td>


                                            <td>
                                              

                                             <?php echo $single_audit_data->entry_date; ?>
                                             
                                            </td>


                                            <td>{{$single_audit_data->email}}</td>

                                            <td><?php 

                                             $maker_id = $single_audit_data->maker;

                                             if ($maker_id) {
                                               
                                             
                                              $maker_data= DB::table('users')->where('id',$maker_id)->first();

                                              echo $maker_data->name;

                                            }

                                             ?></td>

                                            <td><?php 

                                             $checker_id = $single_audit_data->checker; 

                                             if ($checker_id) {
                                              
                                             
                                             $checker_data = DB::table('users')->where('id', $checker_id)->first();

                                              echo $checker_data->name;

                                            }

                                             ?></td>

                                            <td style="width: 250px;"> <a href="{{ url('dynamic_pdf/pdf') }}/{{$single_audit_data->id}}" class="btn btn-primary btn-sm" target="_blank">View</a>   <br> <br> 



                                            <?php if ((Auth::user()->role==11 || Auth::user()->role==6 ) && $status !=1) {
                                               
                                            ?>
                                             <a type="button" class="btn btn-success btn-sm" onclick="authorize_func({{$single_audit_data->id}});">Authorize</a>

                                            
                                           <br> <br> 

                                             <?php

                                             }elseif((Auth::user()->role==2 || Auth::user()->role==6) && ($status==1)){ ?>

                                             <button class="btn btn-success btn-sm" disabled>Authorized</button>

                                             <?php 

                                           }
                                             ?>

                                             <?php 
                                              if ($status==0) {
                                                
                                              

                                             ?>
                                              <a type="button" class="btn btn-danger btn-sm" style="color: #fff;" onclick="delete_func({{$single_audit_data->id}});">Delete</a>

                                            <?php 
                                            
                                            }

                                            ?>  

                                         </td>

                                        </tr>

                                        

                                        <?php 

                                        

                                    }

                                        ?>
                                   
                                        </thead>
                                </table>

                               </div> 

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
    
    function authorize_func(id){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

         cuteAlert({
          type: "question",
          title: "Do You Want To Authorize It ?",
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
                url: "{{ url('authorize_audit_sheet') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },


                success: function(data) {


                 cuteAlert({
                      type: "success",
                      title: "Successfully Authorized ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });

                },
                error: function(response) {
                    alert(response);
                    console.log(response);

                },

                 complete: function() {

                     jQuery(".loader").hide();
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

    } // end authorize func



    function delete_func(id){
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

           
            var formData = {

               id:id
               
            };

            $.ajax({
                type: 'POST',
                url: "{{ url('delete_audit_sheet') }}",
                data: formData,

                beforeSend: function() {
                   jQuery(".loader").show();
                },


                success: function(data) {


                 cuteAlert({
                      type: "success",
                      title: "Delete Successfully ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });

                },
                error: function(response) {
                    alert(response);
                    console.log(response);

                },

                 complete: function() {

                     jQuery(".loader").hide();
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