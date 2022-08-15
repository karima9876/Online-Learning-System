@extends('layouts.master') 

@section('custom_css')

<style>
		.widget-body{
			min-height:500px;
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
                            <a href="#">Change Password</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Password Change Form</span>
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
                                        <div style="text-align: right" class="table-toolbar">
                                            <a   href="{{url('/userlist')}}" class="btn btn-default">
                                                 Student List
                                            </a>
                                        </div>

                                        <form id="accountForm" action="{{url('update/password')}}" method="post" class="form-horizontal">
                                        

    @csrf
                                                <div class="tab-content tabs-flat">
                                                <div class="tab-pane active" id="address-tab">
                                                   
                                                    
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Current Password<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="password" name="old_password" value="" placeholder="Enter Current password" class="form-control input-inline input-medium @error('old_password') is-invalid @enderror">
                                                            
                                                             @if(session('error'))
                                                        <!-- <div class="red">{{session('error')}}</div> -->
                                                        
                                                        <strong class="red">{{session('error')}}</strong>

                                                        @endif
                                                            @error('old_password')
                                                           
                                                            <!-- <div class="red">{{$message}}</div> -->
                                                            <strong class="red">{{ $message }}</strong>
                                                            @enderror 
                                                            

                                                     </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">New Password<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="password" name="new_password" placeholder="Enter new minimun 8 password" class="form-control input-inline input-medium @error('new_password') is-invalid @enderror">

                                                             @error('new_password')
                                                            
                                                            <!-- <div class="red">{{$message}}</div> -->
                                                            <strong class="red">{{ $message }}</strong>
                                                            @enderror 
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">New Confirm Password<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="password" name="confirm_password" placeholder="Confirm new minimun 8 password" class="form-control input-inline input-medium @error('confirm_password') is-invalid @enderror">

                                                         @if(session('danger'))
                                                       
                                                        <!-- <div class="red">{{session('danger')}}</div> -->
                                                        <strong class="red">{{session('danger')}}</strong>
                                                    @endif
                                                        @error('confirm_password')
                                                        <!-- <div class="red">{{$message}}</div> -->
                                                        <strong class="red">{{ $message }}</strong>
                                                       
                                                        @enderror 
                                                        
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-md-offset-5 col-md-6">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="reset" class="btn btn-danger reset">Cancel</button>
                                                </div>
                                            </div>
                                       </form>

                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
@endsection

@section('custom_js') 

 @endsection 

                    
