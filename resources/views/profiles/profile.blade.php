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
                            <a href="#">Profile</a>
                        </li>
                        
                    </ul>
                </div>
               
                <div class="page-body">
                            <div class="row">
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    
                                    
                                    <div class="row">
                                        
                                        <div style="margin-left: 170px;margin-top: 5px;" class="col-lg-6 col-sm-6 col-xs-12">
                                            
                                            <div  class="widget flat radius-bordered">
                                                
                                                
                                                
                                                <div  class="widget-header bg-blue">
                                                    
                                                   
                                                        <h4 style="text-align: center;padding: 6px;color: #fff;" class="card-title">{{Auth::user()->username}}'s Profile </h4>
                            
                                                    
                                                </div>
                                                
                                                <div class="widget-body">
                                                    <div class="card"> 
                                                        <div style="margin-top: 16px;" class="card-body">
                                                            <div style="margin-left: 9%;" class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="font-size: 14px;font-weight: 600; " class="bmd-label-floating">Id</label>
                                                                        <h2 style="margin-left: 5%;margin-top: 1px;    font-weight: 600; font-size: 140%;">{{Auth::user()->student_id}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Email</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->email}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                    
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Name</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->name}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                    
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Department</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->department}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Session</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->ses}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Institution Name</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->iname}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div style="display:none;" class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Father Name</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->fname}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                    
                                    
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div style="display:none;" class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Mother Name</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->mname}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Address</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->address}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Birth Date</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->birth_date}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Contact Number</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->cnumber}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Guardian Contact Number</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->guarcontact}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <div style="margin-left: 9%;" class="row">
                                    
                                    
                                    
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label style="    font-weight: 600;font-size: 14px; " class="bmd-label-floating">Blood Group</label>
                                                                        <h2 style="    font-weight: 600;margin-left: 5%;margin-top: 1px; font-size: 140%;">{{Auth::user()->blood_group}}</h2>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                    
                                                        </div>
                                                    </div>
  
                                                        
                                                </div>

                                    
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                        


                       
                            
                                

                    <div  class="row">
                                
                        <div  class="col-lg-12 col-sm-12 col-xs-12">
                            
                            
                            <div class="row">
                                
                                <div style="margin-top: -67%; margin-left:67%;  " class="col-lg-6 col-sm-6 col-xs-12">
                                    
                                    <div class="widget flat radius-bordered">
                                        
                                        
                                        
                                        
                                        
                                            <div  style="width: 56%;" class="card">
                                                <div style="border-radius: 8%;"  class="widget-body">

                                               
                                                <div  style="margin-top: 16px;" class="card-body">



                                                    <div   class="panel-body">
                
                                                        <div style="margin: 0;text-align: center;float: none; " class="pictureProfile">
                                                            <div  class="card card-profile">
                                                                <div style="margin-top: -26px;" class="card-avatar">
                                                                    <a href="#">
                                                                        <img class="img" style="width: 100px;border-radius:100%;" src="{{asset(Auth::user()->photo)}}">
                                                    
                                                                    </a>
                                                                </div>
                                                                <div class="card-body">
                                                                    <h6 class="card-category text-gray"></h6>
                                                                    
                                                                    <h4 style="background: #b24ac4; margin-bottom: 4px;border-radius: 8%;" class="btn btn-primary btn-round">Rating: @if(!empty($rating)) {{$rating}} @else 0 @endif</h4>
                                                                    <p class="card-description"></p>
                                                                    @php
                                                                    if(empty($qCount)){
                                                                        $qCount=0;
                                                                        
                                                                    }
                                                                    if(empty($aCount)){
                                                                        $aCount=0;
                                                                    }
                                                                    if(empty($rCount)){
                                                                        $rCount=0;
                                                                    }

                                                                    @endphp
                                                                    <a href="#" style="background: #b24ac4;border-radius: 8%;" class="btn btn-primary btn-round"> {{$qCount}} @if($qCount>1) Questions @else Question @endif   </a>
                                                                    <a href="#" style="background: #b24ac4;border-radius: 8%;" class="btn btn-primary btn-round"> {{$aCount}}  @if($aCount>1) Answers @else Answer @endif </a>
                                                                    <a href="#" style="background: #b24ac4;border-radius: 8%;" class="btn btn-primary btn-round"> {{$rCount}}  @if($rCount>1) Replies @else Reply  @endif</a>
                                                                </div>
                                                            </div>
                                                        </div>
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

                    

               
                    


























                  
                    
                   