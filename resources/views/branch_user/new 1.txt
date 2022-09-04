
@extends('master.master')



@section('css')

<style type="text/css">
    label{
            margin-left: 20px;
                font-size: 15px;
    }

    .form-group {
    margin-bottom: 0.5rem !important;
}

</style>
 @endsection

@section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                <h2><b align="center">User Request Form</b></h2>
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


  <!-- loader part -->
   <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div>
  <!-- loader part ends -->


<div class="container wrapper wrapper-content" style="max-height: 80%">
    
    <div class="p-2 mb-4" align="center" style="background-color: #a3b0c2; color: white"><b>User Information Details</b></div>

   <div class="wrapper  animated fadeInRight">

     
            <div class="row">
                
                


                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">

                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                  
                                <form>

                                <?php

                                    $user_id = Auth::user()->id;

                                   $user_form_data = DB::table('users')->where('id', $user_id)->first();

                                   // echo"<pre>";
                                   // print_r($user_form_data);

                                ?>

                                   <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b>Employee Id </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="{{$user_form_data->id}}" type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b>Branch </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="<?php 

                                           $branch_code = $user_form_data->branch;
                                          $branch_info = DB::table('branch_info')->where('br_code', $branch_code)->first();

                                         echo $branch_info->name;

                                            ?> " type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b> Email </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="{{$user_form_data->email}}" type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                </form>

                            </div> <!-- end col-md-6 -->



                            <div class="col-md-6">
                                
                                <form>

                                 

                                   <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b>Employee Name </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="{{$user_form_data->name}}" type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b>Designation  </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="{{$user_form_data->designation}}" type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                <div class="form-group row">

                                         <label class="col-sm-4 col-form-label"><b> Mobile  </b></label>

                                        <div class="col-sm-7">

                                        
                                           <input readonly name="" value="{{$user_form_data->contact}}" type="text" class="form-control">

                                        </div>
                                    
                                </div>

                                </form>
                                
                            </div> <!-- end col-md-6 -->


                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
     
<div class="container wrapper wrapper-content" style="max-height: 80%">




<form action="" method="post" enctype="multipart/form-data" id="sys_form">

@csrf




<!-- system -->
<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Systems</b></div>



<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">


                          
                        
                            <div class="row"> 
                             <?php
                             $checkListArray=array();

                             foreach ($systemList as $key => $value) {
                             
                                
                               array_push($checkListArray,"#check_".$value->id);
                              
                             }


                             $checkList=implode(",",$checkListArray);
                             
                             ?>
                       
                      @foreach($systemList->chunk(2) as $chunks)
                          <div class="col-lg-4">
                                   
                              @foreach($chunks as $sysL)
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                      <div class="i-checks"> 
                                        <input name="{{$sysL->system_name}}" value="{{$sysL->id}}" id="check_{{$sysL->id}}" class="{{$sysL->id}}_box" type="checkbox">
                                        <label class="form-check-label" for="check_{{$sysL->id}}">{{$sysL->system_name}}</label>
                                    </div>
                                    </div>
                                </div>

                                @endforeach
                              
                            </div> 
                      @endforeach
                            </div> 

                            

                        </div>
                    </div>
                </div>
            </div>
           
        </div>



<!-- system ends -->




<!-- request type -->



<div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>Request Type</b></div>
    


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
           
                <div class="col-lg-12">
                    <div class="ibox ">

                    <div class="ibox-content">
                            
                            <div class="row"> 

                            <div class="col-lg-4">
                                   
                              
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="newidcreate" name="radio" value="New ID Creation" type="radio"> <label>New ID Creation </label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input id="amendment" name="radio" value="Amendment" type="radio"> <label>Amendment </label></div>
                                    </div>
                                </div>
                              
                            </div>


                           



                              <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="radio" id="transfer" value="Transfer" type="radio"> <label>Transfer </label></div>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="radio" id="enable" value="Enable" type="radio"> <label>Enable </label></div>
                                    </div>
                                </div>
                              
                            </div>




                               <div class="col-lg-4">
                                   

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="radio" id="disable" value="Disable" type="radio"> <label>Disable</label></div>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"> <input name="radio"  value="Unlock User" id="check8" class="box" type="radio"> <label>Unlock User</label></div>
                                    </div>
                                </div>


                            <div class="form-group row" id="box8" style="display: none">
                                    <div class="col-lg-12">
                                        <label>User ID : </label>
                                        <input type="text" name="new_u_id" value="">
                                    </div>
                                </div>

                                
                              
                            </div>



                            </div>  
                                
                        </div>
                    </div>
                </div>
            </div>
           
        </div>





<!-- request types end -->


<!-- for request Type-->


<div id="request_type_list" style="display: block;">

@foreach($systemList as $sl2) 


 <div class="wrapper wrapper-content animated fadeInRight"  id="{{$sl2->id}}_request_box" style="display: none;">
           
    <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>system {{$sl2->system_name}} Request Type</b></div>
          
    
       
      </div>
@endforeach

</div>
<!-- request Type end -->




<!-- for parameters-->


<div id="para_list" style="display: block;">
@foreach($systemList as $sl) 
 <div class="wrapper wrapper-content animated fadeInRight"  id="{{$sl->id}}_box" style="display: none;">
           
    <div class="p-2 mb-2" align="center" style="background-color: #a3b0c2; color: white"><b>system {{$sl->system_name}}</b></div>
          

           
           

  <!-- for checkbox -->
                
                    <div class="ibox">

                    <div class="ibox-content">
                      
                            
                            <div class="row"> 
                                                        
                             @foreach($system_parameters as $sys_para)
                                  @if($sl->id == $sys_para->system_id)
                                   @if($sys_para->para_type == 2)
                                   <div class="col-lg-4">
                                     <div class="form-group row" style="">
                                    <div class="col-lg-offset-2 col-lg-10">
                                    <div class="i-checks">
                                <input name="{{$sys_para->para_id}}" value="{{$sys_para->para_id}}" id="parameter_id" type="checkbox"><label>{{$sys_para->para_name}}</label></div>
                                  </div>
                                </div> 
                                   </div>
                                   
                                 @endif
                                 @endif
 
                            @endforeach
                                                          
                     </div>

      <!-- checkbox ends -->






          <!-- for input -->


                    <div class="row"> 
                            
                             @foreach($system_parameters as $sys_para)
                                  @if($sl->id == $sys_para->system_id)
                                   @if($sys_para->para_type == 1)
                                   <div class="col-lg-4">
                                     <div class="form-group row" style="">
                                    <div class="col-lg-6">
                                        <label>{{$sys_para->para_name}}:</label>
                                        <input type="text" name="{{$sys_para->para_id}}" value="">
                                    </div>
                                </div> 
                                   </div>
                                   
                                 @endif
                                 @endif
 
                            @endforeach                               
                             
                     </div>
                
  <!-- input ends -->    
                        </div>
                    </div>
                

           
       
      </div>
@endforeach

</div>
<!-- parameter ends -->

<br>


<div class="form-group wrapper wrapper-content animated fadeInRight" align="center">
            <div class="col-lg-offset-2 col-lg-10">
                <button class="btn btn-lg btn-info bat" type="submit" style="padding: 10px 15px 10px 15px">Submit</button>
            </div>
</div>

<br>
<br>

    </form>

             <!-- form submission ends here -->
</div>


  

   @endsection('content')



   @push('scripts')


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
  $(function() {
    enable_cb();
    enable_cb2();
    $("#check8").click(enable_cb);
});

function enable_cb() {

    if (this.checked) {

        // $("div.check8").show(); 
        document.getElementById('box8').style.display = 'block';
        document.getElementById('para_list').style.display = 'none';
    } else

    {
        // $("div.check8").removeAttr("style").hide();
        document.getElementById('para_list').style.display = 'block';
        document.getElementById('box8').style.display = 'none';

    }
}

function enable_cb2() {
    if (this.checked) {

        // $("div.check8").show(); 

        document.getElementById('request_type_list').style.display = 'none';
    } else

    {
        // $("div.check8").removeAttr("style").hide();
        document.getElementById('request_type_list').style.display = 'block';


    }
}
</script>






<script>
   var checkbox = document.querySelectorAll("#check8");
    for (i = 0; i < checkbox.length; i++) {
      checkbox[i].onclick = function() {


        if (this.checked) {
            document.getElementById(this.getAttribute('class')).style['display'] = 'none';
          
        } else {
          document.getElementById(this.getAttribute('class')).style['display'] = 'block';
        }
      };
    }
</script>













<script>
  //console.log('document.querySelectorAll("<?php print $checkList;?>")');
   var checkbox = document.querySelectorAll("<?php print $checkList;?>");
for (i = 0; i < checkbox.length; i++) {
  checkbox[i].onclick = function() {
    if (this.checked) {
       var system_id =    this.getAttribute('value');
       document.getElementById(this.getAttribute('class')).style['display'] = 'block';
       var request_id = ("#"+system_id+"_request_box");
       $(request_id).attr('style','display: block');

    } else {
      document.getElementById(this.getAttribute('class')).style['display'] = 'none';
    }
  };
}

// function submitForm()
// {
//     // var formEl = document.forms.sys_form;
//     // var formData = new FormData(formEl);
//     // alert(formData)
//     //var queryString = $('#sys_form').formSerialize();



//     var queryString = $('#sys_form').serialize();
//     alert(queryString);
//     console.log(queryString);
// }
</script>










<!-- for ajax -->
<script type="text/javascript">
  $(".bat").click(function(e) {
           
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        e.preventDefault();

            cuteAlert({
          type: "question",
          title: "Do You Want To Process The Request",
          message: "",
          confirmText: "Submit",
          cancelText: "Cancel"
        }).then((e)=>{

            
          
          if ( e == ("confirm")){


           

          var queryString = $("#sys_form").serialize();


               var formData = {
                
                'form_serialize_data' : queryString,
               
            };

             $.ajax({
                type: 'POST',
                url: "{{ route('my-data') }}",
                data: formData,
                success: function(data) {

                    
                 // alert('Successfull');
                    console.log(data);
                   

                    cuteAlert({
                      type: "success",
                      title: "Successfully Inserted !",
                      message: "",
                      buttonText: "Okay"
                    }).then((e)=>{

                         location.reload();

                    });



                },
                error: function(response) {
                   
                    console.log(response);
                     
                        cuteAlert({
                      type: "warning",
                      title: "Insert failed !",
                      message: "",
                      buttonText: "",
                      timer: 10000
                    })


                      location.reload();


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


  
               
        
    }); 

</script>







@endpush