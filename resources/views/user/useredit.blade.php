@extends('layouts.master') 

@section('custom_css')

@endsection

@section('content')
          
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="{{ URL::to('/') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Update User</a>
                        </li>
                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption"> Update User Form</span>
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
                                                 User List
                                            </a>
                                        </div> 

                                        <form id="accountForm" action="{{url('user/update/'.$users->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        <input type="hidden" name="old_image" value="{{$users->photo}}">
                                            <div class="tab-content tabs-flat">
                                                <div class="tab-pane active" id="address-tab">
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Id<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="student_id" value="{{$users->student_id}}" class="form-control input-inline input-medium" placeholder="Please, Enter Unique Student Id">
                                                            <div class="red">{{ $errors->first('student_id') }}</div> 
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Username<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="username" value="{{$users->username}}" placeholder="Please,Enter Unique Username" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('username') }}</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Email<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="email" name="email" value="{{$users->email}}" placeholder="Please, Enter Unique email" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('email') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Password<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="password" name="password" placeholder="Enter password" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('password') }}</div>
                                                        </div>
                                                    </div> 

                                                  
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label" for="roles">Assign Roles <span
                                                                 class="red">(optional)*</span></label>
                                                                 <div class="col-lg-8">
                                                        <select class="roles_select form-control custom-select " id="roles" multiple
                                                            name="roles[]" style="width: 100%;">
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}"
                                                                    {{ $users->hasrole($role->name) ? 'selected' : null }}>
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    </div> 
                                                   <!-- 
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">User Type<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <select class="form-control input-inline input-medium" type="text" name="userType">
                                                        @if(!empty($users))

                                                        <option @if($users->userType==1) selected @endif value=1>Admin</option>
                                                        <option @if($users->userType==0) selected @endif value=0>User</option>
                                                        @else
                                                        <option value="0">User</option>
                                                        <option value="1">Admin</option>

                                                        @endif
                                                            </select>
                                                            <div class="red">{{ $errors->first('userType') }}</div>

                                                        </div>
                                                    </div> -->

                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="name" value="{{$users->name}}" placeholder="Enter name" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('name') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Department<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="department" value="{{$users->department}}" placeholder="Enter department" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('department') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Institution Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="iname" value="{{$users->iname}}" placeholder="Enter institution name " class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('iname') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Session<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="ses" value="{{$users->ses}}" placeholder="Enter session" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('ses') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Father Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="fname" value="{{$users->fname}}" placeholder="Enter father name" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('fname') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Mother Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="mname" value="{{$users->mname}}" placeholder="Enter mother name" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('mname') }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Address<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="address" value="{{$users->address}}" placeholder="Enter address" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('address') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Birth Date<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" data-date-format="dd-mm-yyyy" name="birth_date" value="{{$users->birth_date}}" placeholder="Enter birth date" class="form-control date-picker input-medium">
                                                            <div class="red">{{ $errors->first('birth_date') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="cnumber" value="{{$users->cnumber}}" placeholder="Enter contact number" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('cnumber') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Guardian Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="guarcontact" value="{{$users->guarcontact}}" placeholder="Enter guardian contact" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('guarcontact') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Blood Group<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="blood_group" value="{{$users->blood_group}}" placeholder="Enter blood group" class="form-control input-inline input-medium">
                                                            <div class="red">{{ $errors->first('blood_group') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Photo<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="file" name="photo" value="{{$users->photo}}" placeholder="Enter photo" class="form-control input-inline input-medium">
                                                            
                                                                <img width="80" src="{{asset($users->photo)}}"  alt="">
                                                                <div class="red">{{ $errors->first('photo') }}</div>
                                                             
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
        </div>
@endsection

 @section('custom_js')
 
@endsection