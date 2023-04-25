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
                            <a href="#">Online Class List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Online Class List</span>
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
                                @if (!is_null(Auth::user()) &&  Auth::user()->can('add-online-class'))
                                    <div class="table-toolbar pull-right">
                                        <a  href="{{url('/add-online-class')}}" class="btn btn-default">
                                            Add New Zoom Class
                                        </a>
                                    </div>
                                @endif
                                   
                                    <table class="table table-striped table-hover table-bordered" id="sample_1">
                                        <thead>
                                            <tr role="row">
                                                <th>Topic</th>
                                                <th>Start Time</th>
                                                <th>Duration(Minute)</th>
                                                <th>Course Title</th>
                                                <th>Course Code</th>
                                                <th>Session</th>
                                                 @if (!is_null(Auth::user()) &&  (Auth::user()->can('edit-online-class') || Auth::user()->can('delete-online-class')))
                                                <th> Action </th>
                                                 @endif 
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($zoom_online_class as $category)
                                            <tr>
                                                <td>{{$category->topic}}</td>
                                                <td>{{$category->start_time}}</td>
                                                <td>{{$category->duration}}</td>
                                                <td>{{$category->course_code}}</td>
                                                <td>{{$category->course_title}}</td>
                                                <td>{{$category->year_session}}</td>

                                                @if (!is_null(Auth::user()) && (Auth::user()->can('edit-online-class') || Auth::user()->can('delete-online-class')))
                                                <td>
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('edit-online-class'))
                                                    <a href="{{route('edit-online-class',$category->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    @endif
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('delete-online-class'))
                                                    <a href="{{route('delete-online-class',$category->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
                                                    @endif
                                                </td>
                                                @endif

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
