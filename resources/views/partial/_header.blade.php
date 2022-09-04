<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Sep 2020 06:06:13 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Management System</title>

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

  

    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom-style.css')}}" rel="stylesheet">
     <link href="{{ asset('assets/css/select2.min.css')}}" rel="stylesheet">
    


    <link rel="stylesheet" href="{{ asset('assets/cute_style.css') }}" />

    <!-- <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/favicon-32x32.png') }}"/> -->
    <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/dbl_fa2.jpg') }}"/>

   <link href="{{ asset('assets/css/select2.min.css')}}" rel="stylesheet" />


  <!-- for datatable -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css')}}">
    <link href="{{ asset('assets/css/date_picker.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/time_picker.css')}}" rel="stylesheet">

 <style>
        .help-block {
            color      : red;
            font-weight: bold;
            font-size  : 10px;
        }
        button.swal2-cancel.btn.btn-danger {
            border: none;
            margin: 0px 5px;
        }
        button.swal2-confirm.btn.btn-success {
            background: #1ab394;
            border: none;
        }



        .table-wrapper-scroll-y {
               
                max-height: 70%;
               
                }
                
            .double-scroll{
                width: 100%;
            }
            
           .suwala-doubleScroll-scroll {
                height: 20px;
                width: 1461px !important;
                
            }



    </style>





    <!-- for dashboard card -->
    <style type="text/css">
        body{
background:#eee;


}
.card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
}
.card-box:hover {
    text-decoration: none;
    color: #F1F1F1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 15px;
}
.card-box .icon {
    position: absolute;
    top: 0px;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
    background-color: #00C0EF !important;
}
.bg-green {
    background-color: #00A500 !important;
}
.bg-waterblue {
    background-color: #60A8C4 !important;
}
.bg-lightred {
    background-color: #E1786C !important;
}
.bg-darkblue {
    background-color: #0097BC !important;
}
.bg-red{
    background-color: #D3544A !important;
}
.bg-lightblue{
    background-color: #87CEEB !important;
}
    </style>
<!-- for dashboard card ends -->


<!-- for loader -->
<style type="text/css">
    /* .loader {
          width: 100%;
          height: 82%;
          position: fixed;
          padding-top: 19px;
          background-color: white;
          margin: 0 auto;
          z-index: 99999;
          text-align: center;
          display: flex;
          justify-content: center;
          align-items: center;
    } */
    /*CUSTOM PRELOADER*/
.loader-bg{
    position: fixed;
    z-index: 999999;
    background: #ffffffd4;
    width: 100%;
    height: 100%;
  }
  .loader-p{
    border: 0 solid transparent;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    position: absolute;
    top: calc(50vh - 75px);
    left: calc(50vw - 75px);
  }
  
  .loader-p:before, .loader-p:after{
    content: '';
    border: 1em solid #584475;
    border-radius: 50%;
    width: inherit;
    height: inherit;
    position: absolute;
    top: 0;
    left: 0;
    animation: loader 2s linear infinite;
    opacity: 0;
  }
  
  .loader-p:before{
    animation-delay: 0.5s;
  }
  
  @keyframes loader{
    0%{
      transform: scale(0);
      opacity: 0;
    }
    50%{
      opacity: 1;
    }
    100%{
      transform: scale(1);
      opacity: 0;
    }
  }
  /*end of custom preloader*/
</style>
<!-- for loader ends -->

@stack('css')


</head>

<body>
    <div class="loader loader-bg">
      <div class="loader-p">                
      </div>
   </div>
    <div id="wrapper">
      


        