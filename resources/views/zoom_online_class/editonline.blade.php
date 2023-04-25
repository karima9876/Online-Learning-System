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
                            <a href="#">Update Online Class</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Update Online Class Form</span>
                                    
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
                                            <a href="{{url('/list-online-class')}}" class="btn btn-default">
                                                Online Class List
                                            </a>
                                        </div>

                                        <form action="{{url('update-online-class', $category->id)}}" method="POST" class="form-horizontal bv-form" enctype="multipart/form-data"  novalidate="novalidate">
                                            @csrf
                                            <div class="form-group {{ $errors->has('topic') ? ' has-error' : '' }} has-feedback">
                                                <label class="col-lg-4 control-label">Topic<span class="red">*</span>:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="topic" autocomplete="off" value="{{$category->topic}}" placeholder="Enter Topic Name" class="form-control input-inline input-medium">
                                                    @if ($errors->has('topic'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('topic') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <label class="col-lg-4 control-label">Start Time<span class="red">*</span>:</label>
                                                <div class="col-lg-4">
                                                    <div class ='input-group date' id='datetimepicker'>
                                                        <input autocomplete="off" type="text" value="{{\Carbon\Carbon::parse($category->start_time)->format("m/d/Y H:i:s")}}"  class="form-control" name="start_time" id="start_time">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                        @if($errors->has('start_time'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('start_time') }}</strong>
                                                            </span>
                                                        @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker();
        });
    </script>

@endsection