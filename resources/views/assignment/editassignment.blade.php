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
                            <a href="#">Update Assignment</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Update Assignment Form</span>

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
                                            <a href="{{url('/list-assignment')}}" class="btn btn-default">
                                                Assignment List
                                            </a>
                                        </div>

                                        <form action="{{url('update-assignment', $category->id)}}" method="POST" class="form-horizontal bv-form" enctype="multipart/form-data"  novalidate="novalidate">
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

                                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} has-feedback">
                                                <label class="col-lg-4 control-label">Description<span class="red">*</span>:</label>
                                                <div class="col-lg-8">
                                                    <textarea type="text" name="description" autocomplete="off" value="" placeholder="Enter Description" class="form-control input-inline input-medium">@if(!empty($category->description)) {{$category->description}} @else {{old('description')}} @endif </textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('course_code') ? ' has-error' : '' }} has-feedback">
                                                <label class="col-lg-4 control-label">Course Code<span class="red">*</span>:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="course_code" value="{{$category->course_code}}" placeholder="Enter Course Code" class="form-control input-inline input-medium">
                                                    @if ($errors->has('course_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('course_code') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-group {{ $errors->has('course_title') ? ' has-error' : '' }} has-feedback">
                                                <label class="col-lg-4 control-label">Course Title<span class="red">*</span>:</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control input-inline input-medium" type="text" name="course_title">
                                                        @foreach($categories as $category_single)
                                                            <option @if($category->category_id == $category_single->id) selected  @endif value="{{$category_single->id}}">{{$category_single->categoryname}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('course_title'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('course_title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('year_session') ? ' has-error' : '' }} has-feedback">
                                                <label class="col-lg-4 control-label">Session<span class="red">*</span>:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="year_session" value="{{$category->year_session}}" placeholder="Enter Session" class="form-control input-inline input-medium">
                                                    @if ($errors->has('year_session'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('year_session') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label class="col-lg-4 control-label">End Time<span class="red">*</span>:</label>
                                                <div class="col-lg-4">
                                                    <div class ='input-group date' id='datetimepicker'>
                                                        <input autocomplete="off" type="text" value="{{\Carbon\Carbon::parse($category->end_time)->format("d/m/Y H:i:s")}}"  class="form-control" name="end_time" id="end_time">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                        @if($errors->has('end_time'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('end_time') }}</strong>
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