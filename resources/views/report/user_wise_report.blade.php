@extends('master.master')


@section('css')

  
 <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">

<style type="text/css">
    label{
            margin-left: 20px;
                font-size: 15px;
    }

    .form-group {
    margin-bottom: 0.5rem !important;
}


.select2{
    width: 100% !important;
}


.sub_branch{
    width: 64%;
    margin-left: 112px;
}


</style>
 @endsection




@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">Report</b></h2>
                <ol class="breadcrumb" style="background-color: #a3b0c2">
                    <li class="breadcrumb-item">
                        <a href=""><b style="color: white">User Wise Report</b></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    @endsection




@section('content')


  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User Wise Report</h5>
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

                            <form action="{{ url('user_wise_report_data_table') }}" method="POST" name="info">
                               @csrf


                                <div class="row">
                                    <div class="col-md-6">
                                        
                                
                                 <div class="form-group row">

                                    <label class="col-lg-2 col-form-label"><b>Your Branch Name</b></label>

                                    <div class="col-lg-8">
                                        <?php 

                                            $branch_code = Auth::user()->branch;
                                          

                                         $get_branch_data =   DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();

                                         $show_branch_name = $get_branch_data->name." ($branch_code)";
                                        ?>
                                       <input type="text" name="" class="form-control" value="<?php echo $show_branch_name;  ?>" readonly>
                                    </div>

                                </div>


                                <div class="form-group row"   
                                <?php 
                                    if ((Auth::user()->role==1 || Auth::user()->role==5 || Auth::user()->role==9 ||  Auth::user()->role==10 ||   Auth::user()->role==8) && (Auth::user()->division_name!='Internal Control Compliance Division') ) {
                                       
                                        ?>

                                        style="display: none;"
                                        <?php
                                    }
                                ?> >

                                    <label class="col-lg-2 col-form-label"><b>Select Branch</b></label>

                                    <div class="col-lg-8">

                                        <select class="form-control select2" name="branch" onchange="check_head_office(this.value);">
                                            <option value="">--Select--</option>

                                        
                                          <?php

                                       $branch =  Auth::user()->branch;
                                       $divName=Auth::user()->division_name;
                                              
                                        if( $branch=='202'){


                                              if( $divName=='IT Division'  || $divName=='Internal Control Compliance Division' ||  Auth::user()->role=='11' || Auth::user()->role=='12')
                                                     $br_info =  DB::select(DB::raw("SELECT * FROM branch_info where brinfo_flag='1'"));
                                             else
                                                 $br_info =  DB::select(DB::raw("SELECT * FROM branch_info where bnk_br_id='202'"));
                                    }
                                    else
                                    {
                                        $br_id =  Auth::user()->br_pk_id;
                                       

                                        if(empty($br_id))
                                        $br_info =  DB::select(DB::raw("SELECT * FROM branch_info where bnk_br_id='$branch'"));
                                    else
                                        $br_info =  DB::select(DB::raw("SELECT * FROM branch_info where agent_br_key='$br_id'"));
                                    }

                                        foreach($br_info as  $br_value){
                                           
                                        ?>

                                           <option value="<?php echo $br_value->bnk_br_id; ?>"   > <?php 

                                           echo $br_value->name."(  $br_value->bnk_br_id )";

                                       ?></option>
                                         
                                         <?php

                                         }
                                            ?>

                                        </select>
                                    </div>

                                </div>


                                <!-- <div class="form-group row sub_branch">

                                    <select class="form-control" name="sub_branch_id" id="sub_branch_id">
                                                  
                                    </select>

                                </div> -->

                                


                                 <div class="form-group row" 
                                  <?php 
                                    if ( Auth::user()->role==8) {
                                       
                                        ?>

                                        style="display: none;"
                                        <?php
                                    }
                                ?> 
                                 >

                                    <label class="col-lg-2 col-form-label"><b>Module</b></label>

                                    <div class="col-lg-8">

                                        <select class="form-control select2" name="module" id="module" onchange="hide_request_type(this.value, <?php echo Auth::user()->role;  ?>)">

                                            <option value="">--Select--</option>

                                            <?php

                                        $module_data =  DB::select(DB::raw("SELECT * FROM systems"));

                                        foreach($module_data as  $module_value){
                                           
                                        ?>

                                           <option value="<?php echo $module_value->id; ?>"> <?php 

                                           echo $module_value->system_name;

                                       ?></option>
                                         
                                         <?php

                                         }
                                            ?>
                                           
                                        </select>
                                    </div>

                                </div>


                                <div class="form-group row request_type_div" 



                                >

                                    <label class="col-lg-2 col-form-label"><b>Request Type</b></label>

                                    <div class="col-lg-8">

                                        <select class="form-control select2" name="request_type" 
                                        id="request_type"  <?php 
                                    if (Auth::user()->branch!='202') {
                                       
                                        ?>

                                        style="display: none;"
                                        <?php
                                    }
                                ?> >>

                                            <option value="">--Select--</option>

                                        

                                           <option value="33"> Enhancement</option>
                                         
                                        
                                           
                                        </select>
                                    </div>

                                </div>

                               
                                 <div class="form-group row division_div"   <?php 
                                    if (Auth::user()->branch!='202') {
                                       
                                        ?>

                                        style="display: none;"
                                        <?php
                                    }
                                ?> >

                                    <label class="col-lg-2 col-form-label"><b>Division</b></label>

                                    <div class="col-lg-8">

                                        <select class="form-control select2" name="division" id="division"  >

                                            <option value="">--Select--</option>

                                            <?php

                                                $divName=Auth::user()->division_name;
                                                if( $divName=='IT Division' || $divName=='Internal Control Compliance Division' || Auth::user()->role=='11' || Auth::user()->role=='12')
                                                $divsion_data =  DB::select(DB::raw("SELECT * FROM division"));
                                            else
                                            {
                                                $divsion_data =  DB::select(DB::raw("SELECT * FROM division where division='$divName'")); 
                                            }

                                                foreach($divsion_data as  $single_division_data){
                                                   
                                                ?>

                                                   <option value="<?php echo $single_division_data->division; ?>"> <?php 

                                                   echo $single_division_data->division;

                                               ?></option>
                                                 
                                                 <?php

                                                 }
                                                    ?>
                                           
                                        </select>

                                    </div>

                                </div>

                                


                               <div class="form-group row"

                               <?php 
                                    if ( Auth::user()->role==8) {
                                       
                                        ?>

                                        style="display: none;"
                                        <?php
                                    }
                                ?> 

                               >
                                            
                                        <label class="col-lg-2 col-form-label"><b>Request Status</b></label>

                                            <div class="col-lg-8"> 

                                                <select class="form-control select2" name="status">
                                                    <option value="">--select--</option>
                                                    <option value="10">Initiate</option>
                                                    <option value="1">Processing</option>
                                                    <option value="5">Waiting For authorization</option>
                                                
                                                    <option value="2">Complete</option>
                                                    <option value="3">On Hold</option>
                                                    <option value="4">Cancel</option>
                                                    <option value="6">Decline</option>
                                                    
                                                </select>

                                            </div>

                                        </div>
                               


                                    </div>


                                    <div class="col-md-6">

                                        
                                         <div class="form-group row" style="<?php if ((Auth::user()->role=='1' || Auth::user()->role=='5' || Auth::user()->role=='9' || Auth::user()->role=='10' || Auth::user()->role=='8') && (Auth::user()->division_name !='Internal Control Compliance Division') ) {
                                             
                                             echo "display: none;";
                                         } ?>">
                                            <label class="col-lg-2 col-form-label"><b>User Id</b></label>

                                            <div class="col-lg-8">

                                                <input type="text"  class="form-control" name="user_id" id="user_id"> 



                                            </div>

                                        </div>

                                        
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"><b>From Date</b></label>

                                            <div class="col-lg-8">

                                                <input type="text"  class="form-control" name="from_date" id="datepicker" placeholder="dd-mm-yyyy"> 

                                            </div>

                                        </div>


                                        <div class="form-group row">

                                            <label class="col-lg-2 col-form-label"><b>To Date</b></label>

                                                <div class="col-lg-8">
                                                    <input type="text"  class="form-control" name="to_date" id="datepicker1" placeholder="dd-mm-yyyy"> 

                                            </div>

                                        </div>


                                        

                                         <div class="form-group row">
                                            <div class="offset-lg-8 col-lg-8">
                                                <input type="button"  name="search" class="btn btn-sm btn-success" value="Search" onclick="generateReport()">
                                               
                                            </div>
                                        </div>


                                    </div>


                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
           


        </div>

         
@endsection


@push('scripts')




<script>


$(document).ready(function(){

    $("#datepicker").datepicker({
        dateFormat:'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
    });


    $("#datepicker1").datepicker({
        dateFormat:'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
    });

});




function generateReport(){

    var ref=new Date().getTime();

     var div_name = document.info.division.value;

    var div_full_name = div_name.replace("&", "url_and");

    popupWindow =window.open( location.pathname.substring(0, location.pathname.length - 22) + "{{ url ('user_report_data')}}?select_branch="+document.info.branch.value+"&module="+document.info.module.value+"&request_type="+document.info.request_type.value+"&division="+div_full_name+"&status="+document.info.status.value+"&user_id="+document.info.user_id.value+"&frm_date="+document.info.from_date.value+"&to_date="+document.info.to_date.value,'newWindow',' top=200, width=800, height=500, left=50, scrollbars=1, toolbar=no,resizable=false' );


    return false;

}


 $('.division_div').hide();

function check_head_office(branch_code){
    // alert(branch_code);

    if (branch_code=='202') {

        $('.division_div').show();

    }else{

          $('.division_div').hide();
          document.info.division.value='';
          
    }
    
}


$('.request_type_div').hide();


function hide_request_type(system_id, user_role){

   

   if (user_role=='2' || user_role=='6' || user_role=='8' || user_role=='11' || user_role=='12') {

         if (system_id=='6') {

            

            $('#request_type').html("<select class='form-control select2' name='request_type' id='request_type' ><option value=''>--Select--</option><option value='33'> Enhancement</option></select>");
            $('.request_type_div').show();

        }else{

            $('#request_type').html('');
            $('.request_type_div').hide();

        }

   }

   

} // hide_request type function


  $(".sub_branch").hide();

function check_sub_br(has_br_code){

    $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
            });   

   if (has_br_code!='202') {
       
        var formData={
                
                 "branch_id" : has_br_code
            };

         $.ajax({

                type: 'POST',
                url: "{{ url('find-sub-branch') }}",
                data: formData,
                success: function(data) {

                    
                 // alert('Successfull');
                    // if (data!=0) {
                    //     console.log(data);
                    //      $('.sub_branch').css('display','');
                    //     $('.sub_branch').html(data.html);
                      
                    // }else{
                    //         console.log(data);
                    //      $('.sub_branch').css('display','none');
                        
                    // }


                    if (data!='0') {

                             $(".sub_branch").show();
                            $("#sub_branch_id").empty().append(data);

                        }else{

                             $(".sub_branch").hide();
                           
                        }
                    


                },
                error: function(response) {
                   
                    console.log(response);
                       
                }
            });


   }else if (has_br_code=='202') {
        $(".sub_branch").hide();
        $("#sub_branch_id").empty();

   }
}
</script>




@endpush
