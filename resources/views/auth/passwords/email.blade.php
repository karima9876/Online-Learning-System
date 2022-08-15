@extends('layouts.master') 

@section('custom_css')
<style>
		.widget-body{
			min-height:300px;
		}
	</style>




@endsection

@section('content') 
<div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Reset Link</a>
                        </li>

                    </ul>
                </div>
<div class="page-body">

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
        
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-8">
        <div class="widget-body">
            <div class="card mt-8"> 
            

                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body mt-20">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="red">*</span>:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div> 
</div> 
</div> 
</div> 
</div> 
@endsection

@section('custom_js') 


   

 @endsection

   




