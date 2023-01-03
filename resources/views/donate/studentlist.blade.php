@extends('layouts.master') 

@section('custom_css')
<!--New Styles-->
<link type="text/css" href="{{ asset('assets/new/style.css') }}" rel="stylesheet" media="screen">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<style>
		.widget-body{
			min-height:500px;
		}
        .student-col{
            padding: 0px !important;
        }
	</style>

@endsection

@section('content') 
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{ URL::to('/') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Student List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                     <div class="row">
                        <div class="col-xs-12 col-md-12">
                             @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">User List</span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <section class="pt-5" style="">
                                        <div class="container">
                                            <div class="row">
                                                @php
                                        $serial=1;
                                        @endphp
                                        @foreach($users as $user)
                                                <div class="col-md-4 student">
                                                    <div class="inner clearfux">
                                                        <img class="img-circle" src="{{asset($user->photo)}}" style="height:60px;width:80px;">
                                                        <h4 class="student-col">{{$user->username}}</h4>
                                                        <h5 class="student-col">{{$user->email}}</h5>
                                                        <h5 class="student-col">{{$user->department}}</h5>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width:" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <h5 class="student-col">{{$user->ses}}</h5> 
                                                        <p class="student-col">{{$user->cnumber}}</p>
                                                        <p class="student-col">{{$user->address}}</p>
                                                            <a href="{{url('donate', $user->id)}}" class="btn btn-success">Donate Now</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div> 
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>
                    </div> 
            </div>
           
     @endsection
@section('custom_js') 
<script src="{{ asset('assets/new/script.js') }}"></script>  
 @endsection 
