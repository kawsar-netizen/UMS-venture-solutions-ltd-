

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                    </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection






























<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agent Banking | Login </title>

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" sizes="16x16" type="image/jpg" href="{{ asset('assets/img/favicon-32x32.png') }}"/>

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
                    <form method="POST" action="" class="m-t" role="form">
                        @csrf
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control" placeholder="Enter Your Email" name="email" value="" required autocomplete="user_id" autofocus>
                           
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            
                        </div>
                        <div class="form-group">
                            <input type="password" autocomplete="off" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
                            
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                           
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                            
                            <a href="">
                                <small>Forgot password?</small>
                            </a>
                      
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
