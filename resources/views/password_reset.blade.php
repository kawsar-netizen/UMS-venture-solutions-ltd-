
<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management System|Reset Password</title>

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/favicon-32x32.png') }}"/> -->
    <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/dbl_fa2.jpg') }}"/>

    <style>
       body{
           display: flex;
           align-items: center;
       }

       .btn-primary {

            color: #fff !important;
            background-color: rgb(54,88,137) !important;
            border-color: rgb(54,88,137) !important;
        }

    </style>

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6" style="text-align: center;">
                <h3 class="font-bold"><b>User Management System</b></h3>
               <br>
                <p>
                    <img style="height: 140px" src="{{ asset('assets/img/dbl2.png') }}" alt="">
                </p>
                 <br>
                 <button type="button" class="btn" style="background-color: #28a745"><i class="fa fa-arrow-left" style="color: white"></i>&nbsp;<a href="{{ URL::previous() }}" style="color: white">Previous</a></button>
                 
            </div>
            <br>
            <div class="col-md-6">
                <div class="ibox-content">



                    <form method="POST" action="{{ route('save-reset-password') }}" class="m-t" role="form">
                        @csrf
                        <!-- current password div -->
                         <div class="form-group">
                             <input type="password" autocomplete="off" class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password" name="current_password" required >
                            

                            @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                         </div>
                           <!-- current password div ends-->

                         
                         <!-- new password div -->
                       <div class="form-group">                         
                          <input type="password" autocomplete="off" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password" name="new_password" required >
                            

                            @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                       </div>
                         <!-- new password div ends-->


                        <!-- confirm new password div -->
                         <div class="form-group">
                             <input type="password" autocomplete="off" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm New Password" name="confirm_password" required >
                            

                            @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                         </div>
                         <!-- confirm new password div ends-->
                         
                        <button type="submit" class="btn btn-primary block full-width m-b">Update</button>
                                                     
                      
                    </form>


                    <p class="m-t">
                        <small>&copy; Venture Solution Limited  2020 - {{  date('Y')  }}</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Venture Solution Limited
            </div>
            <div class="col-md-6 text-right">
               <small>© 2020- {{ date('Y') }} </small>
            </div>
        </div>
    </div>

</body>
</html>





