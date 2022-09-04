
<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management System|Login</title>

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/favicon-32x32.png') }}"/> -->
    <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/dbl_fa2.jpg') }}"/>

            <link rel="stylesheet" href="{{ asset('assets/cute_style.css') }}" />

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
                <h3 class="font-bold" >Welcome To User Management System</h3>
               
                <p>
                    <img style="height: 140px" src="{{ asset('assets/img/dbl2.png') }}" alt="">
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">



                    <form method="POST" action="{{ route('login') }}" class="m-t" role="form">
                        @csrf
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email" name="email" value="{{ old('email') }}" required autocomplete="user_id" autofocus>
                           
                               
                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


<!-- 
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span> -->
                            
                        </div>
                        <div class="form-group">
                            <input type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                            

                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!-- <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span> -->
                           
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="{{url('selfreg')}}" class="btn btn-success block full-width m-b">Create Account</a>
                        
                            
                      
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


<script src="{{ asset('assets/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('assets/cute-alert.js') }}"></script>



    @if(Session::get('status'))

    <script type="text/javascript">
      // toastr.warning("{!!Session::get('status')!!}");

      cuteAlert({
          type: "info",
          title: "Your Account Is Not Activated ",
          message: "",
          buttonText: "Okay"
        })
    </script>

  @endif



</body>
</html>





