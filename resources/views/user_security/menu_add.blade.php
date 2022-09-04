
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



    </style>

 @endsection

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User and Security</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">Menu Add </b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection


  @section('content')
                
                   

                <div class="row">

                    <div class="col-xs-5">
                     <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User Permission Entry Form</h5>
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

                            <form action="{{ url('menu_add_data_submit') }}" method="POST">
                               @csrf

                               <div class="form-group row">

                                    <label class="col-sm-4 control-label" required="required">Role Name</label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="rolename" />
                                    </div>

                                </div>
                                

                            <div class="form-group row">
                                <label class="col-sm-4 control-label" required="required">Menu Name</label>

                                <div class="col-sm-6">
                                    <select class="populate placeholder" multiple="multiple" name="bnk[]" id="menu_name_all" >

                                            <option value="">-- Select a Menu --</option>

                                            <?php 
                                
                                    
                                $db_select_menu = DB::select(DB::raw("SELECT * FROM  menu_table where sl in(1,2,3,4,5,6,7,8,9,10,11) "));


                                foreach ($db_select_menu as $key => $data_menu) {
                                   
                                    ?>

                                <option value="<?php echo $data_menu->sl; ?>" ><?php echo $data_menu->menu_name; ?></option>

                                <?php } ?>


                                    </select>
                                </div>

                        </div>  


                        <div class="form-group">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="submit" class="btn btn-primary" ></input>
                        </div>
                    </div>


                            </form>

                        </div>
                    </div>
                </div>

                 <div class="col-xs-7" style="margin-left: 100px;">

                    <div class="ibox">

                        <div class="ibox-title">
                            <h5>Existing Role</h5>
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

                        <div class="ibox-content" id="info">
                        
                            <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                                <tbody>

                                        <tr>
                                            <th>SL</th>
                                            <th>ROLE NAME</th>
                                            <th>MENU ACCORDING TO ROLE</th> 
                                            <th>Action</th> 

                                        </tr>

                                        <?php 

    $sl = 0;
   

   $role_data = DB::select(DB::raw("select * from  role_table"));

   foreach ($role_data as $key => $role) {
       
   
        $sl++;
        $role_id = $role->sl;
       

       $menu = DB::select(DB::raw(" select menu_name, status from menu_table where role like '%$role_id%' "));
        
?>

                                        <tr>
                                            

                                            <td scope="row" style="color: black" class="slNo sl_no{{ $role_id}}" data-row_id="{{ $role_id }}" ><?php echo $sl;?></td>

                                            <td><?php echo $role->role_name;?></td>

                                            <td>

                                                <?php
                                            foreach ($menu as $key => $menu_name) {
                                               
                                                $menu_status= $menu_name->status;

                                                if ($menu_status==1) {

                                                    echo  "<span  style='font-weight:bold;font-size:18px;'>{$menu_name->menu_name}</span>";
                                                    
                                                    echo "<br>";
                                                }elseif ($menu_status==2) {
                                                    
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span style='font-weight:bold;font-size:15px;'>{$menu_name->menu_name}</span>";
                                                    echo "<br>";
                                                }elseif ($menu_status==3) {
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<span style='font-size:13px;'>{$menu_name->menu_name}</span>";
                                                    
                                                    echo "<br>";
                                                }
                                                

                                            }?></td>


                                            <td><a type="button" class="btn btn-primary btn-sm btnEditRowWithModal" target="blank">Edit</a> | <button onclick="delete_role(<?php echo $role_id; ?>)" class="btn btn-danger btn-sm">Delete</button> </td>
                                          

                                        </tr>

                                    <?php } ?>

                                </tbody>
                                 
                                 
                            </table>

                            
                        </div>
                    </div>

                 </div>   

            </div>



          <div class="modal fade halimmodal" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Existing Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      




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
            url: "{{ url('existing_role_edit') }}",
            data: formData,
            success: function(data) {

                
                $('.halimmodal').modal('show');
                $('.modal-body').html(data.html);

                console.log(data);

            },
            error: function(response) {
                alert(response);
                console.log(response);
            }
        });
     
      

      }); // end -:- Edit Event Using Modal.   

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