
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
                        <a href=""><b style="color: white">RTGS Special Role</b></a>
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
                            <h5> Operation Division  Special Role For RTGS Enhancement</h5>
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



     $users = DB::select(DB::raw("select * from  users where division_name like '%Operations Division%' and status_id='1' and branch='202' order by id desc"));

   


   foreach ($users as $key => $value) {
       
   
        $sl++;


        
        
?>

                                        <tr>
                                            

                                            <td scope="row" style="color: black" class="slNo sl_no{{ $sl}}" data-row_id="{{ $sl }}" ><?php echo $sl;?></td>

                                            <td><?php


                                             if ($value->created_at) {
                                              

                                               echo date('d F, Y h:i:s a', strtotime($value->created_at));
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


                                              <?php 

                                                if($value->role==8){
                                                  ?>

                                                   <button disabled class="btn btn-primary btn-sm">Confirmed</button> 

                                                   <?php 

                                                }else{

                                                  ?>

                                                   <button onclick="confirm({{$value->id}})" class="btn btn-primary btn-sm">Confirm</button>

                                                  

                                                <?php 

                                                }
                                              ?>

                                              <br> <br>

                                               <button onclick="decline({{$value->id}})" class="btn btn-danger btn-sm">Decline</button>

                                             </td>
                                          

                                        </tr>

                                    <?php } ?>

                                </tbody>
                                 
                                 
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


       function confirm(id){

      

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Give Special Role ",
          message: "",
          confirmText: "Yes",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                   
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('rtgs_special_role_approved') }}",
                data: formData,
                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Special Role Granted Successfully !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Special Role Granted failed !",
                      message: "",
                      buttonText: "Okay",
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


     function decline(id){



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });


            cuteAlert({
          type: "question",
          title: "Do You Want To Decline Special Role? ",
          message: "",
          confirmText: "Decline",
          cancelText: "Cancel"
        }).then((e)=>{

        
          if ( e == ("confirm")){

            var formData = {
                    id:id,
                   
                };

                      $.ajax({
                type: 'POST',
                url: "{{ url('special_role_decline') }}",
                data: formData,
                success: function(data) {
                  
                    console.log(data);

                   
                      cuteAlert({
                      type: "success",
                      title: "Decline Successful !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload(true);

                    });


                },
                error: function(response) {

                        
                         cuteAlert({
                      type: "warning",
                      title: "Decline failed !",
                      message: "",
                      buttonText: "Okay",
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

    }

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