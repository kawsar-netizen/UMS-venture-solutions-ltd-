
@extends('master.master')



@section('css')


    <style type="text/css">

       span.select2.select2-container.select2-container--default.select2-container--above.select2-container--focus.select2-container--open {

        width: 192.484px !important;
}


.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid black 1px;
    outline: 0;
    width: 190px !important;
}


span.select2.select2-container.select2-container--default.select2-container--above {

     width: 190px !important;

}

.placeholder{
     width: 190px !important;
}


.footer {
    display: none !important;
}


    </style>

 @endsection

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User and Security</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Pending User List </b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection


  @section('content')
                
                   

                <div class="row">

                   

                 <div class="col-lg-12" >

                    <div class="ibox">

                        <div class="ibox-title">
                            <h5>Pending User List</h5>
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

                        <div class="double-scroll table-wrapper-scroll-y">
<table id="myTable"  class="table table-striped table-hover"  >
                                
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th> 
                                            <th>User id</th> 
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th> 
                                            <th>Status</th> 
                                            <th>Branch</th> 
                                            <th>Division</th> 
                                            <th>Contact</th> 
                                            <th>Designation</th> 
                                          
                                            
                                            <th>Action</th> 

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php 

    $sl = 0;
   
    $branch_code = Auth::user()->branch;
   $division_id = Auth::user()->division_id;

   if (Auth::user()->role==2 || Auth::user()->role==6) {

      $users = DB::select(DB::raw("select * from  users where status_id='0' and role in(2,6,8) order by id desc"));

   }elseif(Auth::user()->role==5){

        $users = DB::select(DB::raw("select * from  users where status_id='0' and role='5' and branch='$branch_code'  order by id desc"));

   }elseif(Auth::user()->role==10){

        $users = DB::select(DB::raw("select * from  users where status_id='0' and role='10' and branch='$branch_code' and division_id='$division_id' order by id desc"));

   }elseif(Auth::user()->role==11){

        $users = DB::select(DB::raw("select * from  users where status_id='0'  order by id desc"));

   }elseif(Auth::user()->role==12){

        $users = DB::select(DB::raw("select * from  users where status_id='0'  order by id desc"));

   }else{

        $users = DB::select(DB::raw("select * from  users where status_id='0' and branch='$branch_code' order by id desc"));

   }


   foreach ($users as $key => $value) {
       
   
        $sl++;


        
        
?>

                                        <tr>
                                            

                                            <td scope="row" style="color: black" class="slNo sl_no{{ $sl}}" data-row_id="{{ $sl }}" ><?php echo $sl;?></td>

                                            <td><?php 

                                           
                                            if ($value->updated_at) {
                                              

                                               echo date('d F, Y h:i:s a', strtotime($value->updated_at));
                                            }

                                            ?></td>

                                            <td>{{$value->user_id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td><?php 

                                            $role_id = $value->role;
                                        $role_data = DB::table('role_table')->where('sl', $role_id)->first();

                                        echo $role_data->role_name;

                                              ?></td>
                                            <td>{{$value->email}}</td>
                                            <td><?php 

                                                $status = $value->status_id;
                                                if ($status==1) {
                                                    echo "Active";

                                                }elseif($status==0){
                                                    echo "Inactive";
                                                }
                                        ?></td>

                                            <td><?php  

                                           $branch_code = $value->branch;

                                         $single_branch_info =  DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();

                                        echo  $single_branch_info->name;


                                        ?></td>

                                            <td>

                                            <?php

                                            if ($value->branch=='202') {
                                             
                                                echo $value->division_name;
                                            }

                                            ?>

                                            </td>
                                            <td>{{$value->contact}}</td>
                                            <td>{{$value->designation}}</td>
                                            
                                          

                                            <td>

                                            <button onclick="approve({{$value->id}})" class="btn btn-primary btn-sm">Approve</button>  <br>  <br> 

                                            <button 
                                            onclick="delete_func(<?php echo $value->id; ?>, <?php echo "'".$value->branch."'";  ?>, <?php echo "'".$value->division_name."'";  ?>)" class="btn btn-danger btn-sm">Decline</button>  </td>
                                          

                                        </tr>

                                    <?php } ?>

                                </tbody>


                                <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th> 
                                            <th>User id</th> 
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th> 
                                            <th>Status</th> 
                                            <th>Branch</th> 
                                            <th>Division</th> 
                                            <th>Contact</th> 
                                            <th>Designation</th> 
                                          
                                            
                                            <th>Action</th> 

                                        </tr>

                                    </tfoot>
                                 
                                 
                            </table>

                           </div> 
                        </div>
                    </div>

                 </div>   

            </div>





  @endsection  





  @push('scripts')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>


  <script type="text/javascript">
       $(document).ready(function() {

        

        $('#menu_name_all').select2();
       

    });


       function approve(id){

      

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Apporve ",
          message: "",
          confirmText: "Apporve",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                   
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('branch_checker_request_list_approved') }}",
                data: formData,
                success: function(data) {
                  
                    console.log(data);

                   if (data=='0') {

                       cuteAlert({
                      type: "warning",
                      title: "This User Already Approved ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });

                       return false;


                   }else{

                      //approved success

                      cuteAlert({
                      type: "success",
                      title: "Approved Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });

                   } //end else approved success
                      


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Authorized failed !",
                      message: "",
                      buttonText: "",
                      timer: 10000
                    })

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

        

    } //end approve func


    function delete_func(id, branch_code, division_name){


       // alert(branch_code);return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Decline ? ",
          message: "",
          confirmText: "Decline",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                    branch_code:branch_code,
                    division_name:division_name,
                   
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('branch_checker_request_list_decline') }}",
                data: formData,
                success: function(data) {
                  
                    console.log(data);

                    if (data=='0') {

                       cuteAlert({
                      type: "warning",
                      title: "This User Already Declined ! ",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });

                       return false;


                   }else{
                   
                        cuteAlert({
                        type: "success",
                        title: "Decline Successful !",
                        message: "",
                        buttonText: "Okay"
                      }).then((e)=>{

                           location.reload(true);

                      });

                  }

                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Decline failed !",
                      message: "",
                      buttonText: "",
                      timer: 10000
                    })

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

    } //end decline function


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