
@extends('master.master')

@section('css')

 <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" />

@endsection

      @section('breadcrumb')
        <div class="row wrapper border-bottom white-bg page-heading" style="background-color: #a3b0c2; color: white; font-family: serif;">
            <div class="col-lg-10">
                
                <h2><b align="center">Dashboard</b></h2>
              
                <ol class="breadcrumb">
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
       



<!-- loader part -->
   <!-- <div class="loader" style="margin-left: -14px; padding-top: 10px">
    <img src="{{asset('assets/img/loader2.gif')}}" style="margin-left: -150px">
  </div> -->

  <!-- loader part ends -->



<div class="container-fluid">


    <div class="row" style="padding-left: 20px">







 <!-- when role 1 (branch maker) -->
    @if(Auth::user()->role == 1)

<!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$dailyTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$dailyTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$dailyTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$monthlyTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$monthlyTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$monthlyTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$overallTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$overallTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$overallTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->

<!-- role 1 ends -->









 <!-- when role 2 (head maker) -->
    @elseif(Auth::user()->role == 2)

<!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6" style="max-height: 150px">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$dailyHdMakerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for approval)</b></h4>
                    <h3> {{$dailyHdMakerPendingForApprove->sl}} </h3>
                </div>
                
                
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6" style="max-height: 150px">
            <div class="card-box bg-lightred">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$MonthlyHdMakerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for approval)</b></h4>
                    <h3> {{$MonthlyHdMakerPendingForApprove->sl}} </h3>
                </div>
                
                
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$OverallHdMakerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for approval)</b></h4>
                    <h3> {{$OverallHdMakerPendingForApprove->sl}} </h3>
                </div>
                
                
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->

<!-- role 2 ends -->








 <!-- when role 5 (branch checker) -->
    @elseif(Auth::user()->role == 5)

<!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$dailyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$dailyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$dailyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$monthlyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$monthlyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$monthlyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$overallBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$overallBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$overallBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->

<!-- role 5 ends -->








<!-- when role 6 (head checker) -->
    @elseif(Auth::user()->role == 6)

<!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$dailyHdCheckerWaitingForAuth->sl}}  </h3>
                </div>                             
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$dailyHdCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue " style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$dailyHdCheckerRechecked}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$monthlyHdCheckerWaitingForAuth->sl}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$monthlyHdCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred " style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$monthlyHdCheckerRechecked}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$overallHdCheckerWaitingForAuth->sl}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$overallHdCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$overallHdCheckerRechecked}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->

<!-- role 6 ends -->



<!-- role 8 start -->

@elseif(Auth::user()->role == 8)

   <!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$dailyHdAuthWaitingForAuth->sl_count}}  </h3>
                </div>                             
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$dailyHdAuthAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue " style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$dailyHdAuthDecline}} </h3>

                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$monthlyHdAuthWaitingForAuth->sl_count}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$monthlyHdAuthAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred " style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$monthlyHdAuthDecline}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Waiting for authorization)</b></h4>
                    <h3> {{$overallHdAuthWaitingForAuth->sl_count}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$overallHdAuthAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Rechecked Requests</b></h4>
                    <h3> {{$overallHdAuthDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->

<!-- role 8 end -->



<!-- role 9 (HO Div Maker) start -->

    @elseif(Auth::user()->role == 9)


    <!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$hodm_dailyTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$hodm_dailyTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$hodm_dailyTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$hodm_monthlyTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$hodm_monthlyTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$hodm_monthlyTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests</b></h4>
                    <h3> {{$hodm_overallTotal}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Pending Requests</b></h4>
                    <h3> {{$hodm_overallTotalPending}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Cancel Requests</b></h4>
                    <h3> {{$hodm_overallTotalCancel}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->
<!-- role 9 (HO Div Maker) end -->




<!-- role 10 (HO Div Checker) start -->

    @elseif(Auth::user()->role == 10)


   <!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$hodc_dailyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$hodc_dailyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$hodc_dailyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$hodc_monthlyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$hodc_monthlyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$hodc_monthlyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$hodc_overallBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$hodc_overallBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$hodc_overallBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->


<!-- role 10 (HO Div Checker) end -->


<!-- role 11 (Super Admin) start -->

    @elseif(Auth::user()->role == 11)


   <!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$superadmin_dailyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$superadmin_dailyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$superadmin_dailyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$superadmin_monthlyBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$superadmin_monthlyBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$superadmin_monthlyBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3> {{$superadmin_overallBrCheckerPendingForAuth}} </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> {{$superadmin_overallBrCheckerAuthorized}} </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3> {{$superadmin_overallBrCheckerDeclined}} </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->


<!-- role 11 (Super Admin) end -->





<!-- role 12 (Admin) start -->

    @elseif(Auth::user()->role == 12)


   <!-- for daily basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-darkblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Daily Requests ({{date('d-F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3>  </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3> </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-blue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3>  </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for daily basis ends -->


<!-- for monthly basis -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-red" style="height: 290px">
                <div class="inner">
                    <h3><b>Monthly Requests ({{date('F-Y')}})</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3>  </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3>  </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightred" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3>  </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for monthly basis ends -->


<!-- for Overall -->
        <div class="col-lg-6 col-sm-6">
            <div class="card-box bg-waterblue" style="height: 290px">
                <div class="inner">
                    <h3><b>Overall Requests</b></h3>
                </div>

                <div class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
               <br>
                 

      <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Requests (Pending for authorization)</b></h4>
                    <h3>  </h3>
                </div>
                
               
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Authorized Requests</b></h4>
                    <h3>  </h3>
                </div>
                
                
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card-box bg-lightblue" style="max-height: 150px">
                <div class="inner">
                    <h4><b>Total Declined Requests</b></h4>
                    <h3>  </h3>
                </div>
                              
            </div>
        </div>
      </div>
     </div>          
        </div>

<!-- for overall ends -->


<!-- role 12 (Admin) end -->

@else

    <h1>blank dashboard</h1>


@endif    

<!-- static pie chart -->
     <!--  <div class="col-lg-4 col-sm-6" style="height: 290px; margin-top: 18px">
                       <div class="ibox-title">
                        <h5>Pie Chart</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas style="width: 336px; height: 200px" id="doughnutChart"></canvas>
                        </div>
                    </div>
        </div> -->
 <!-- static pie chart ends  -->
    
  </div>

<br><br>

      
   @endsection('content')


   @section('js')

   <!-- loader script -->
    <script type="text/javascript">
        $(function(){
            setTimeout(()=>{
                $(".loader").fadeOut(500);
            },1000)
        });
    </script>
    <!-- loader script ends -->
   @endsection
