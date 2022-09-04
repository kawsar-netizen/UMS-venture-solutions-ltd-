
@extends('master.master')

@section('css')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

@endsection

      @section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User Request List</b></h2>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item">
                        <a href=""><b>User Request Form</b></a>
                    </li> -->
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection

       
         @section('content')

@if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 1rem; padding-top: 1rem; margin-top: 1rem">
            <i class=""></i>&nbsp;&nbsp;&nbsp;
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 0.8rem">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<br>

    <table id="myTable"  class="table" >
            <thead>
            <tr>
                <th scope="col" style="color: black">Serial</th>
                
                  <th scope="col" style="color: black">User</th>
                <th scope="col" style="color: black">Branch</th>

                <th scope="col" style="color: black">System</th>
                <th scope="col" style="color: black">Operations</th>
                <th scope="col" style="color: black">Department</th>
                <th scope="col" style="color: black">Request Type</th> 
                <th scope="col" style="color: black">Status</th>
                <th scope="col" style="color: black">Assign Person</th>
                 <th scope="col" style="color: black">Action</th>

            </thead>
            <tbody>
            @php($i=1)
           @foreach($requests as $r)
                <tr>
                    <th scope="row" style="color: black" class="slNo sl_no{{ $r->id }}" data-row_id="{{ $r->id }}">{{$i++}}</th>

                    <td style="color: black">{{$r->user_name}}</td>
                    <td style="color: black">{{$r->user_branch}}</td>

                    <td style="color: black">
                        {{$r->ubs}}
                        {{$r->pbm}}
                        {{$r->cps}}
                        {{$r->beftn}}
                        {{$r->rtgs}}
                        {{$r->docudex}}
                        {{$r->newdbcube}}
                        {{$r->rbs}}
                        {{$r->gefu}}
                        {{$r->directbank}}
                        {{$r->bkash}}
                        {{$r->portal}}
                        {{$r->rit}}
                        {{$r->forex}}
                        {{$r->csms}}
                        {{$r->passport}}
                        {{$r->nscreen}}
                        {{$r->swift}}
                    </td>
                    <td style="color: black">
                        {{$r->lc_hd}}
                        {{$r->corp_loan}}
                        {{$r->genralbank_ubs}}
                        {{$r->data_entry}}
                        {{$r->fund_transfer}}
                        {{$r->dbl_clear}}
                        {{$r->recon}}
                        {{$r->money_market}}
                        {{$r->cpccreortrade}}
                        {{$r->dbl_fad}}
                        {{$r->dbl_swift_msg}}
                        {{$r->dbl_obu}}
                        {{$r->dbl_asu}}
                        {{$r->bank_gurantee}}
                        {{$r->card_ops}}
                        {{$r->adc_ops}}
                        {{$r->call_center}}
                        {{$r->foreign_ex}}
                        {{$r->treasure}}
                        {{$r->securities}}
                        {{$r->ccy_rate}}
                        {{$r->settle}}
                        {{$r->business_ops}}
                        {{$r->dbl_edo_ops}}
                        {{$r->dbl_sms_admin}}
                        {{$r->dbl_prod}}
                    </td>
                    <td style="color: black">
                        {{$r->depart_ubs}}
                        {{$r->depart_rtgs}}
                        {{$r->depart_cps}}
                        {{$r->depart_beftn}}
                        {{$r->depart_bkash}}
                        {{$r->depart_directbank}}
                    </td>
                    <td style="color: black">
                       {{$r->newidcreate}}
                        {{$r->amendment}}
                        {{$r->transfer}}
                        {{$r->enable}}
                        {{$r->disable}}
                        {{$r->passreset}}
                    </td>




                    <td><?php if($r->change_status==0 && $r->assign_person==Auth::user()->id){

                        echo "<span class='badge badge-danger'>  Initiate </span>";

                    }elseif ($r->change_status==0) {

                       echo "<span class='badge badge-warning'>  Initiate </span>";
                       
                    }elseif ($r->change_status==1) {

                       echo "<span class='badge badge-info'>  Processing </span>";
                       
                    }elseif ($r->change_status==2) {

                       echo "<span class='badge badge-success'>  Waiting For <br> Authorization </span>";
                       
                    }elseif ($r->change_status==3) {

                       echo "<span class='badge badge-primary'>  On Hold </span>";
                       
                    }elseif ($r->change_status==4) {

                       echo "<span class='badge badge-secondary'>  Cancel </span>";
                       
                    }elseif ($r->change_status==5) {

                       echo "<span class='badge badge-primary'>  Completed </span>";
                       
                    }elseif ($r->change_status==6) {

                       echo "<span class='badge badge-danger'>  Declined </span>";
                       
                    } ?> </td>

                    <td>{{$r->usr_name }}</td>

                    <td>

                        <?php

                            if ($r->action_status!=3 && $r->assign_person=='') {
                                ?>


                          

                        <a type="button" class="btn btn-info btn-sm" onclick="request_accept({{$r->br_user_id}})" >Request Accept</a>

                        <?php


                          }

                        ?>

                     

                         <?php

              

                    if($r->assign_person !='' ) {
                       
                    
                    ?>

                    <button type="button" class="btn  btn-primary btn-sm  btnEditRowWithModal" <?php if ($r->change_status==5) {
                       echo "disabled";
                       
                    } ?> > change Status </button>

                    <?php

                        }
                    
                   ?>


                    </td>

                </tr>
            @endforeach
          
            </tbody>
        </table>


        <div class="modal fade halimmodal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update">Save changes</button>
      </div>
    </div>
  </div>
</div>


        

   @endsection('content')


   @section('js')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>



  <script type="text/javascript">
    
     function request_accept(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        

        if(confirm("Want to accept it?")) {

             

            var formData = {
                id:id
            };

             $.ajax({
            type: 'POST',
            url: "{{ url('ho_maker_accept') }}",
            data: formData,
            success: function(data) {
              
             
               // alert('Request Accept Successfully');

                toastr.success("Request Accept Successfully");

                location.reload();
            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });

            
        }
    }

   </script> 


    <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
    $(".btnEditRowWithModal").click(function(e) {
               


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        e.preventDefault();
        var row_id = $(this).closest('tr').find('.slNo').data('row_id');

         

        var formData = {
            row_id: row_id
        };
        $.ajax({
            type: 'POST',
            url: "{{ url('ho_maker_change_status') }}",
            data: formData,
            success: function(data) {

                
                $('.halimmodal').modal('show');
                $('.modal-body').html(data.html);

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });
    }); // end -:- Edit Event Using Modal.


   </script> 


   <script type="text/javascript">
    
    // start -:- Edit Event Using Modal. 
    $(".update").click(function(e) {
               


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();
       
     
        var hidden_id = $("#hidden_id").val();

        var change_status = $("#change_status").val();

      
        var formData = {
          
            hidden_id: hidden_id,
            change_status: change_status,

        };


        $.ajax({
            type: 'POST',
            url: "{{ route('ho_maker_change_status_submit') }}",
            data: formData,
            success: function(data) {

                
             // alert('Successfully Assigned');

             toastr.success("Successfully Assigned");

            },
            error: function(response) {
                alert(response);
                console.log(response);

            }
        });

       

        location.reload();

        
    }); 


   </script> 

 @endsection