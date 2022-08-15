@extends('layouts.master') 

@section('custom_css')


@endsection

@section('content') 


<div class="page-body">
    

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            

                       
    <div class="login-container animated fadeInDown">
    @include('roles.partials.messages')
        <div class="loginbox bg-white">
            <div class="loginbox-title">SIGN IN</div>
           
           
            
            <form method="POST" action="{{ route('login') }}">
                        @csrf
            <div class="loginbox-textbox">
            
            

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
            </div>
            <div class="loginbox-textbox">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
            </div>
            <div class="loginbox-forgot">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
            <!-- <div class="loginbox-submit">
                <a href="{{ url('auth/facebook') }}" target="_blank" class="btn btn-block" style="background-color:#3b5998;color:#ffffff">
                <i class="social-icon fa fa-facebook"></i>LOGINWITHFACEBOOK
                </a>
                
            </div> -->
            <div class="loginbox-submit">
                <a href="{{ url('auth/google') }}" target="_blank" class="btn btn-danger btn-block">
                <i class="social-icon fa fa-google"></i>LOGINWITHGOOGLE
                </a>
                
            </div>
            
            <div class="loginbox-signup">
                <a href="{{ route('register')}}">Sign Up With Register</a>
            </div>
        </div>
        <div class="logobox" style="width:  !important;450px">
        </div>
        </form>
    </div>

    </div>
    </div>
    </div>
    
    @endsection

@section('custom_js') 


   

 @endsection 
