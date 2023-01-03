@extends('layouts.master') 
@section('custom_css')
<!--New Styles-->
<link type="text/css" href="{{ asset('assets/new/style.css') }}" rel="stylesheet" media="screen">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
                            <a href="#">Payment Details</a>
                        </li>
                    </ul>
                </div>
                <div class="page-body">
                     <div class="row">
                        <div class="col-xs-12 col-md-12">
                             @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Payment Details</span>
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
                                      <section>
                                        <div class="container">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <form role="form" action="{{url('donate/payment', $user->id )}}" method="post" class="require-validation" data-cc-on-file="false" id="payment-form">
                                                @csrf
                                                <div class="panel panel-default payer-info">
                                                  <div class="panel-heading">
                                                    <div class="row">
                                                      <div class="col-sm-12">
                                                        <h3 class="panel-title">Your Info</h3>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="panel-body">
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label for="sender_name" class='control-label'>Name</label>
                                                        <input name="sender_name" id="sender_name" class='form-control' value="{{ old('sender_name')  }}" type='text'>
                                                        @if($errors->has('sender_name'))
                                                        <small class="form-text text-danger">{{ $errors->first('sender_name') }}</small>
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label for="sender_address" class='control-label'>Address</label>
                                                        <textarea name="sender_address" class='form-control' id="sender_address" cols="10" rows="3">{{ old('sender_address')  }}</textarea>
                                                        @if($errors->has('sender_address'))
                                                        <small class="form-text text-danger">{{ $errors->first('sender_address') }}</small>
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group'>
                                                        <label for="sender_email" class='control-label'>Email</label>
                                                        <input name="sender_email" id="sender_email" class='form-control' value="{{ old('sender_email')  }}" type='email'>
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group'>
                                                        <label for="sender_cnumber" class='control-label'>Phone</label>
                                                        <input name="sender_cnumber" id="sender_cnumber" class='form-control' value="{{ old('sender_cnumber')  }}" type='tel'>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default credit-card-box">
                                                  <div class="panel-heading">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <h3 class="panel-title">Payment Info</h3>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="panel-body">
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label class='control-label'>Amount</label>
                                                        <input name="amount" class='form-control' value="{{ old('amount')  }}" size='4' type='number' placeholder="">
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group'>
                                                        <label class='control-label'>Payment Method</label> <br>
                                                        <div class="checkbox">
                                                          <label>
                                                              <input type="checkbox" checked="checked" name="payment_type">
                                                              <span class="text">SSL Command</span>
                                                          </label>
                                                      </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-xs-12">
                                                        <button class="btn-btn-success donate-btn btn-lg btn-block" type="submit">Donate Now</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                            <div class="col-md-6 student">
                                              <div class="inner mb-5">
                                                <h3>{{strtoupper("You are going to support for")}}</h3>
                                                <img class="img-circle" src="{{asset($user->photo)}}" alt="">
                                                <h4>{{strtoupper($user->name)}}({{$user->student_id}})</h4>
                                                  <h5>{{$user->email}}</h5>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" style="width: " aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <table class="table text-left table-bordered" style="margin-top: 20px;">
                                                  <tr>
                                                    <th colspan="2">Student Details</th>
                                                  </tr>
                                                  <tr>
                                                    <td width="40%">Name:</td>
                                                    <td width="60%">{{$user->name}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Email</td>
                                                    <td>{{$user->email}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Address</td>
                                                    <td>{{$user->address}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Department:</td>
                                                    <td>{{$user->department}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Institution Name:</td>
                                                    <td>{{$user->iname}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Session:</td>
                                                    <td>{{$user->ses}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Birth Date:</td>
                                                    <td>{{$user->birth_date}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Blood Group :</td>
                                                    <td>{{$user->blood_group}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Contact Number:</td>
                                                    <td>{{$user->cnumber}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Guardian Contact Number:</td>
                                                    <td>{{$user->guarcontact}}</td>
                                                  </tr>
                                                </table>
                                              </div>
                                              <div class="inner">
                                                <h4 class="text-center">Donators for <strong></strong></h4>
                                                <table class="table table-bordered">
                                                  <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Amount (USD)</th>
                                                  </tr>
                                                  <tr>
                                                    <td>card_name</td>
                                                    <td>donate_amount</td>
                                                  </tr>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </section>
                                </div>
                            </div>
                        </div>
                    </div> 
            </div>
           
     @endsection
@section('custom_js') 
<script src="{{ asset('assets/new/script.js') }}"></script>  
 @endsection 
