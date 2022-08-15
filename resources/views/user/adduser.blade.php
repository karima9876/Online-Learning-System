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
                            <a href="#">Add User</a>
                        </li>
                    </ul>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">User Form</span>
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

                                        <form id="accountForm" action="{{url('user/store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                            <div class="tab-content tabs-flat">
                                                <div class="tab-pane active" id="address-tab">
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Id<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="student_id" value="{{old('student_id')}}" class="form-control input-inline input-medium" placeholder="Please, Enter Unique Student Id">
                                                            <strong class="red">{{ $errors->first('student_id') }}</strong> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Username<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="username" value="{{old('username')}}" placeholder="Please,Enter Unique Username" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('username') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Email<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="email" name="email" value="{{old('email')}}" placeholder="Please, Enter Unique email" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('email') }}</strong>
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
                                                        <label class="col-lg-4 control-label">Roles<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <select class="roles_select form-control custom-select " id="roles" multiple  name="roles[]" style="width: 100%;">
                                                                @if(!empty($roles))
                                                                    @foreach($roles as $role)
                                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                                
                                                            </select>
                                                            <strong class="red">{{ $errors->first('roles') }}</strong>

                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">User Type<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <select class="form-control input-inline input-medium" type="text" name="userType">
                                                                <option value="0">User</option>
                                                                <option value="1">Admin</option>
                                                            </select>
                                                            <strong class="red">{{ $errors->first('userType') }}</strong>

                                                        </div>
                                                    </div> -->

                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="name" value="{{old('name')}}" placeholder="Enter name" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('name') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Department<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="department" value="{{old('department')}}" placeholder="Enter department" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('department') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Institution Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="iname" value="{{old('iname')}}" placeholder="Enter institution name " class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('iname') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Session<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="ses" value="{{old('ses')}}" placeholder="Enter session" class="form-control input-inline input-medium">
                                                            <!-- <strong class="red">{{ $errors->first('ses') }}</strong> -->
                                                        </div>
                                                    </div>
                                                    <div style="display:none;" class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Father Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="fname" value="{{old('fname')}}" placeholder="Enter father name" class="form-control input-inline input-medium">
                                                            <!-- <strong class="red">{{ $errors->first('fname') }}</strong> -->
                                                        </div>
                                                    </div>
                                                    <div style="display:none;" class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Mother Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="mname" value="{{old('mname')}}" placeholder="Enter mother name" class="form-control input-inline input-medium">
                                                            <!-- <strong class="red">{{ $errors->first('mname') }}</strong> -->
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Address<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="address" value="{{old('address')}}" placeholder="Enter address" class="form-control input-inline input-medium">
                                                            <!-- <strong class="red">{{ $errors->first('address') }}</strong> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Birth Date<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" data-date-format="dd-mm-yyyy" name="birth_date" value="{{old('birth_date')}}" placeholder="Enter birth date" class="form-control date-picker input-medium">
                                                            <strong class="red">{{ $errors->first('birth_date') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="cnumber" value="{{old('cnumber')}}" placeholder="Enter contact number" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('cnumber') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Guardian Contact Number<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="guarcontact" value="{{old('guarcontact')}}" placeholder="Enter guardian contact" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('guarcontact') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Blood Group<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="blood_group" value="{{old('blood_group')}}" placeholder="Enter blood group" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('blood_group') }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label"> Photo<span class="red">*</span>:</label>
                                                        <div class="col-lg-8">
                                                            <input type="file" name="photo" placeholder="Enter photo" class="form-control input-inline input-medium">
                                                            <strong class="red">{{ $errors->first('photo') }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-md-offset-5 col-md-6">
                                                    <button type="submit" class="btn btn-primary">Save</button>
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