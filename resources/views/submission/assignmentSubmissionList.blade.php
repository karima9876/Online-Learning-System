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
                            <a href="#">Assignment Submission List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Assignment Submission List</span>
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
                                    <table class="table table-striped table-hover table-bordered" id="sample_1">
                                        <thead>
                                            <tr role="row">
                                                <th>Username</th>
                                                <th>Student ID</th>
                                                <th>Topic Name</th>
                                                <th>Description</th>
                                                <th>File</th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($upload_assignment_list as $create)
                                            <tr>
                                                <td>{{$create->user->username}}</td>
                                                <td>{{$create->user->student_id}}</td>
                                                <td>{{$create->assignment->topic}}</td>
                                                <td>{{$create->description}}</td>
                                                <td>
                                                    <a download="true" href="{{Storage::url($create->upload_file)}}" class="btn btn-success btn-xs delete"><i class="fa fa fa-download"></i>File Download</a>
                                                </td>
                                                <td>
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('upload-assignment-delete'))
                                                    <a href="{{route('upload-assignment-delete',$create->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
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