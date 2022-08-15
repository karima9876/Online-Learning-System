
@extends('layouts.master') 

@section('custom_css')

<style>
        .has-feedback .form-control{
            border-radius: 3px !important;
                     }
    </style>

@endsection

@section('content') 
                
                <div class="page-body">
                   
                            <div  class="row">
                                
                                <div style="margin-left: 300px;" class="col-lg-12 col-sm-12 col-xs-12">
                                    
                                    
                                    <div class="row">
                                        
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            
                                            <div class="widget flat radius-bordered">
                                                
                                                
                                                
                                                <div style="color: #fff;"  class="widget-header bg-blue">
                                                    
                                                    <span class="widget-caption">Registration Form</span>
                                                    <br><br>
                                                    <div class="registerbox-caption">Please fill in your information</div>
                                                    
                                                   
                                                    
                                                </div>
                                                
                                                <div  class="widget-body">
                                                    
                                                    <div id="registration-form">
                                                        <form id="accountForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"  class="form-horizontal bv-form" novalidate="novalidate">
                                                        
                                                           @csrf
                
                                                            <div class="tab-pane active" id="address-tab">
                                                                <div class="form-group has-feedback">
                                                                    <label class="col-lg-4 control-label">Student Id</label>
                                                                    <div class="col-lg-8 registerbox-textbox">
                                                
                                                                        <input id="student_id" type="text" class="form-control input-inline input-medium @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                                                                        @error('student_id')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong class="red">{{ $message }}</strong>
                                                                                <!-- <div class="red">{{ $errors->first('categoryname') }}</div>
                                                                            </span> -->
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Username</label>
                                                                <div class="col-lg-8">

                                                                    <input  type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="" class="form-control input-inline input-medium">
                                                                    

                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong  class="red">{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Email</label>
                                                                <div class="col-lg-8">
                                                    
                                                                    <input id="email" type="email" class="form-control input-inline input-medium @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong  class="red">{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Password</label>
                                                                <div class="col-lg-8">
                                                                    
                                                                    <input id="password" type="password" class="form-control input-inline input-medium @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong class="red">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Confirm Password</label>
                                                                <div class="col-lg-8">
                                                                    
                                                                    <input id="password-confirm" type="password" class="form-control input-inline input-medium" name="password_confirmation" required autocomplete="new-password">
                                                                </div>
                                                            </div>

                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Name</label>
                                                                <div class="col-lg-8">
                                                                    
                                                                    <input id="name" type="text" class="form-control input-inline input-medium @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                                            @error('name')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Department</label>
                                                                <div class="col-lg-8">
                                                                <input id="department" type="text" class="form-control input-inline input-medium @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autofocus>
                                                                @error('department')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Session</label>
                                                                <div class="col-lg-8">
                                                                <input id="ses" type="text" class="form-control input-inline input-medium @error('ses') is-invalid @enderror" name="ses" value="{{ old('ses') }}" required autofocus>
                                                                @error('ses')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Institution Name</label>
                                                                <div class="col-lg-8">
                                                                <input id="yearSem" type="text" class="form-control input-inline input-medium @error('iname') is-invalid @enderror" name="iname" value="{{ old('iname') }}" required autofocus>
                                                                @error('iname')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                            <div style="display:none;" class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Father Name</label>
                                                                <div class="col-lg-8">
                                                                <input id="fname" type="text" class="form-control input-inline input-medium @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autofocus>
                                                                @error('fname')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div style="display:none;" class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Mother Name</label>
                                                                <div class="col-lg-8">
                                                                <input id="mname" type="text" class="form-control input-inline input-medium @error('mname') is-invalid @enderror" name="mname" value="{{ old('mname') }}" required autofocus>
                                                                @error('mname')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                    
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Address</label>
                                                                <div class="col-lg-8">
                                                                <input id="address" type="text" class="form-control input-inline input-medium @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autofocus>
                                                                @error('address')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Birth Date</label>
                                                                <div class="col-lg-8">
                                                                <input id="birth_date" data-date-format="dd-mm-yyyy" type="text" class="form-control date-picker input-inline input-medium @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autofocus>
                                                                @error('birth_date')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label">Contact Number</label>
                                                                <div class="col-lg-8">
                                                                <input id="cnumber" type="text" class="form-control input-inline input-medium @error('cnumber') is-invalid @enderror" name="cnumber" value="{{ old('cnumber') }}" required autofocus>
                                                                @error('cnumber')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label"> Guardian Contact Number</label>
                                                                <div class="col-lg-8">
                                                                <input id="guarcontact" type="text" class="form-control input-inline input-medium @error('guarcontact') is-invalid @enderror" name="guarcontact" value="{{ old('guarcontact') }}" required autofocus>
                                                                @error('guarcontact')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label"> Blood Group</label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" name="blood_group" placeholder="" class="form-control input-inline input-medium  @error('blood_group') is-invalid @enderror" value="{{ old('blood_group') }}" required autofocus>
                                                   
                                                                    @error('blood_group')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label class="col-lg-4 control-label"> Photo</label>
                                                                <div class="col-lg-8">
                                                                <input id="photo" type="file"  class="form-control input-inline input-medium @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required autofocus>
                                                                @error('photo')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong class="red">{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                    
                                                                </div>
                                                            </div>
                                                             <div class="form-group has-feedback">
                                                                <div class="col-lg-12">
                                                            
                                                                <button type="submit" class="btn btn-blue pull-right">Register</button>
                                                            </div>
                                                            </div> 
                                                          
                                                            
                                                            
                                                            <!-- <button type="submit" class="btn btn-blue">Register</button> -->
                                    
                                    
                                        
                                                        </div>
                                                        
                                                            
                                                                
                            
                                                            
                                                        </form>
                                                        
                                                    </div>
                                                    
                                                        
                                                </div>
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

      

   