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
                            <a href="#">Assignment Create List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">All Assignment List</span>
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
                                @if (!is_null(Auth::user()) &&  Auth::user()->can('add-assignment'))
                                    <div class="table-toolbar pull-right">
                                        <a  href="{{url('/add-assignment')}}" class="btn btn-default">
                                            Add New Assignment
                                        </a>
                                    </div>
                                @endif

                                    <table class="table table-striped table-hover table-bordered" id="sample_1">
                                        <thead>
                                            <tr role="row">
                                                <th>Topic</th>
                                                <th>Description</th>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Session</th>
                                                <th>End Time</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($assignment_create as $create)
                                            <tr>
                                                <td>{{$create->topic}}</td>
                                                <td>{{$create->description}}</td>
                                                <td>{{$create->course_code}}</td>
                                                <td>{{$create->course_title}}</td>
                                                <td>{{$create->year_session}}</td>
                                                <td>{{$create->end_time}}</td>
                                                <td>
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('upload-assignment'))
                                                    <a href="{{route('upload-assignment',$create->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-paper-plane"></i> Submit </a>
                                                    @endif
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('upload-assignment-list'))
                                                    <a href="{{route('upload-assignment-list',$create->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-eye"></i> List  </a>
                                                    @endif
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('edit-assignment'))
                                                    <a href="{{route('edit-assignment',$create->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    @endif
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('delete-assignment'))
                                                    <a href="{{route('delete-assignment',$create->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


     @endsection

@section('custom_js')




 @endsection
