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
                            <a href="#">User List</a>
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
                                @if (!is_null(Auth::user()) &&  Auth::user()->can('adduser'))
                                    <div class="table-toolbar pull-right">
                                        <a  href="{{url('/adduser')}}" class="btn btn-default">
                                            Add New User
                                        </a>
                                    </div>
                                    @endif
                                    <table class="table table-striped table-hover table-bordered" id="sample_1">
                                        <thead>
                                            <tr role="row">
                                                <th> No. </th>
                                                <th> ID </th>
                                                <th> Username </th>
                                                <th> Email </th>
                                                <th> Roles </th>
                                                <!-- <th> UserType </th> -->
                                                <th> Name </th>
                                                <th> Department </th>
                                                <th> Ses </th>
                                                <th> Institution Name </th>
                                                <!-- <th> Father Name </th>
                                                <th> Mother Name </th> -->
                                                <th> Address </th>
                                                <th> Birth Date </th>
                                                <th> Contact Number </th>
                                                <th> Guardian Contact Number </th>
                                                <th> Blood Group </th>
                                                <th> Photo </th>
                                                @if (!is_null(Auth::user()) &&  (Auth::user()->can('user.edit') || Auth::user()->can('user.delete')))
                                                <th> Action </th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($users as $user)
                                            <tr>
                                               <td>{{$serial++}}</td>
                                                <td>{{$user->student_id}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{$user->email}}</td>
                                                @php
                                                    $html = '';
                                                    $roles = App\User::find($user->id)->getRoleNames();
                        
                                                    foreach ($roles as $role) {
                                                        $html .=  $role;
                                                    }
                                                @endphp
                                                <td> <span class="badge badge-info">{{$html}}</span></td>
                                                <!-- @if($user->userType==1)
                                                <td>Admin</td>
                                                @else
                                               <td>User</td>
                                               @endif -->
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->department}}</td>
                                                <td>{{$user->ses}}</td>
                                                <td>{{$user->iname}}</td>
                                                <!-- <td>{{$user->fname}}</td>
                                                <td>{{$user->mname}}</td> -->
                                                <td>{{$user->address}}</td>
                                                <td>{{$user->birth_date}}</td>
                                                <td>{{$user->cnumber}}</td>
                                                <td>{{$user->guarcontact}}</td>
                                                <td>{{$user->blood_group}}</td>
                                                
                                                <td><img src="{{asset($user->photo)}}" style="height:60px;width:80px;" alt=""></td>
                                                @if (!is_null(Auth::user()) && (Auth::user()->can('user.edit') || Auth::user()->can('user.delete')))
                                                <td>
                                                @if (!is_null(Auth::user()) &&  Auth::user()->can('user.edit'))
                                                <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                @endif
                                                @if (!is_null(Auth::user()) &&  Auth::user()->can('user.delete'))
                                                <a href="{{url('user/delete/'.$user->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
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
            </div>
           
     @endsection

@section('custom_js') 
  
 @endsection 
