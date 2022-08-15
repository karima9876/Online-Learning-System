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
                            <a href="#">Update Primary Student</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Update Primary Student Form</span>
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
                                            <a   href="{{url('/puserlist')}}" class="btn btn-default">
                                                Primary Student List
                                            </a>
                                        </div>
                                        
                                        <form id="accountForm" action="{{url('puser/update/'.$pusers->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        
                                            <div class="tab-content tabs-flat">
                                                <div class="tab-pane active" id="address-tab">

                                                <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Student Id<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                        <input type="text" name="login_id" value="{{$pusers->login_id}}" class="form-control input-inline input-medium" placeholder="Please, Enter Unique Student Id">
                                                            <div class="red">{{ $errors->first('login_id') }}</div> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Gmail<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="email" name="gmail" value="{{$pusers->gmail}}" placeholder="Please, Enter Unique gmail" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('gmail') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                        <input type="text" name="ctactnumber" value="{{$pusers->ctactnumber}}" placeholder="Enter contact number" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('ctactnumber') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Guardian Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                        <input type="text" name="guarnumber" value="{{$pusers->guarnumber}}" placeholder="Enter guardian contact" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('guarnumber') }}</div>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-md-offset-5 col-md-6" style="margin-top:10px">
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
        @endsection

 @section('custom_js')
 
@endsection
   