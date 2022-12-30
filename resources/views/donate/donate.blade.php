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
                            <a href="#">Donate List</a>
                        </li>
                    </ul>
                </div>
                <div class="page-body">
                     <div class="row">
                        <div class="col-xs-12 col-md-12">
                             @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Donate List</span>
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
                                              <form role="form" action="" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                                @csrf
                                                @method('PUT')
                                                
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
                                                        <label for="student_id" class='control-label'>Student Id</label>
                                                        <input name="student_id" id="student_id" class='form-control' value="{{ old('student_id')  }}" type='text'>
                                                        @if($errors->has('student_id'))
                                                        <small class="form-text text-danger">{{ $errors->first('student_id') }}</small>
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label for="name" class='control-label'>Name</label>
                                                        <input name="name" id="name" class='form-control' value="{{ old('name')  }}" type='text'>
                                                        @if($errors->has('name'))
                                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label for="address" class='control-label'>Address</label>
                                                        <textarea name="address" class='form-control' id="address" cols="10" rows="3">{{ old('address')  }}</textarea>
                                                        @if($errors->has('address'))
                                                        <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group'>
                                                        <label for="email" class='control-label'>Email</label>
                                                        <input name="email" id="email" class='form-control' value="{{ old('email')  }}" type='email'>
                                                      </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group'>
                                                        <label for="phone" class='control-label'>Phone</label>
                                                        <input name="phone" id="phone" class='form-control' value="{{ old('phone')  }}" type='tel'>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="panel panel-default credit-card-box">
                                                  <div class="panel-heading">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <h3 class="panel-title">Payment Details</h3>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="panel-body">
                                                    <div class='form-row row'>
                                                      <div class='col-xs-12 form-group required'>
                                                        <label class='control-label'>Amount</label>
                                                        <input name="donate_amount" class='form-control' value="" size='4' type='number' placeholder="">
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12">
                                                      <div class="row">
                                                        <div class="col-md-1 text-right">
                                                          <input type="checkbox" id="isMemorial">
                                                        </div>
                                                        <div class="col-md-11">
                                                          <label for="isMemorial" class='control-label'>
                                                          SSL Command
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
                                                <h3>You are going to support for</h3>
                                                <img class="img-circle" src="https://images.pexels.com/photos/39853/woman-girl-freedom-happy-39853.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                                                <h4>Student Id:</h4>
                                                  <h5>Username</h5>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" style="width: " aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <table class="table text-left table-bordered" style="margin-top: 20px;">
                                                  <tr>
                                                    <th colspan="2">Student Details</th>
                                                  </tr>
                                                  <tr>
                                                    <td width="40%">Name:</td>
                                                    <td width="60%"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Email</td>
                                                    <td></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Address</td>
                                                    <td></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Department:</td>
                                                    <td> </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Institution Name:</td>
                                                    <td></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Session:</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Birth Date:</td>
                                                    <td></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Blood Group :</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Contact Number:</td>
                                                    <td>  
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Guardian Contact Number:</td>
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
                                      @endsection
                                      
                                      @section('script')
                                      <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                                      {{-- <script type="text/javascript">
                                        $(function () {
                                          var $form = $(".require-validation");
                                          $('form.require-validation').bind('submit', function (e) {
                                            var $form = $(".require-validation"),
                                              inputSelector = ['input[type=email]','input[type=text]','textarea'].join(', '),
                                              $inputs = $form.find('.required').find(inputSelector),
                                              $errorMessage = $form.find('div.error'),
                                              valid = true;
                                            $errorMessage.addClass('hide');
                                      
                                            $('.has-error').removeClass('has-error');
                                            $inputs.each(function (i, el) {
                                              var $input = $(el);
                                              if ($input.val() === '') {
                                                $input.parent().addClass('has-error');
                                                $errorMessage.removeClass('hide');
                                                e.preventDefault();
                                              }
                                            });
                                      
                                            if (!$form.data('cc-on-file')) {
                                              e.preventDefault();
                                              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                                              Stripe.createToken({
                                                number: $('.card-number').val(),
                                                cvc: $('.card-cvc').val(),
                                                exp_month: $('.card-expiry-month').val(),
                                                exp_year: $('.card-expiry-year').val()
                                              }, stripeResponseHandler);
                                            }
                                      
                                          });
                                      
                                          function stripeResponseHandler(status, response) {
                                            if (response.error) {
                                              $('.error')
                                                .removeClass('hide')
                                                .find('.alert')
                                                .text(response.error.message);
                                            } else {
                                              // token contains id, last4, and card type
                                              var token = response['id'];
                                              // insert the token into the form so it gets submitted to the server
                                              $form.find('input[type=text]').empty();
                                              $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                                              $form.get(0).submit();
                                            }
                                          }
                                      
                                          $('.show_memorial_textbox').hide();
                                          var isMemorial = $('#isMemorial:checked').val();
                                          if (isMemorial) {
                                            $('.show_memorial_textbox').show();
                                          }
                                          $('#isMemorial').on('click', function (e) {
                                            var isMemorial = document.getElementById("isMemorial").checked;
                                            if (isMemorial == true) {
                                              $('.show_memorial_textbox').show();
                                            } else {
                                              $('.show_memorial_textbox').hide();
                                            }
                                          });
                                      
                                        });
                                      </script>
                                      
                                      <script type="text/javascript">
                                          $(".btn-refresh").click(function(){
                                              $.ajax({
                                                  type: "get",
                                                  url: "{{\Illuminate\Support\Facades\URL::to('refresh_captcha')}}",
                                      
                                                  success: function(data) {
                                                      console.log(data.captcha);
                                                      $(".captcha span").html(data.captcha);
                                                      return false;
                                                  },
                                                  error: function (data) {
                                                      // console.log("error", data);
                                                  }
                                              });
                                      
                                          });
                                      </script> --}}
                                    

                                </div>
                            </div>
                        </div>
                    </div> 
            </div>
           
     @endsection
@section('custom_js') 
<script src="{{ asset('assets/new/script.js') }}"></script>  
 @endsection 
