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
                            <a href="#">Payment List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                             @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Payment List</span>
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
                                                <th> No. </th>
                                                <th> Receiver Name </th>
                                                <th> Student ID </th>
                                                <th> Amount </th>
                                                <th> Txn ID </th>
                                                <th> Status </th>
                                                <th> Sender Name </th>
                                                <th> Sender Email </th>
                                                <th> Sender Cnumber </th>
                                                <th> Sender Address </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($paymentlist as $list)
                                            <tr>
                                               <td>{{$serial++}}</td>
                                                <td>{{$list->user->name}}</td>
                                                <td>{{$list->student_id}}</td>
                                                <td>{{$list->amount}}</td>
                                                <td>{{$list->txn_id}}</td>
                                                <td>@if($list->status == "Processing" || $list->status == "Complete") <span class="badge badge-success">Complete</span> @elseif($list->status == "Pending") <span class="badge badge-primary">{{$list->status}}</span> @else <span class="badge badge-danger">{{$list->status}}</span> @endif</td>
                                                <td>{{$list->sender_name}}</td>
                                                <td>{{$list->sender_email}}</td>
                                                <td>{{$list->sender_cnumber}}</td>
                                                <td>{{$list->sender_address}}</td>
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
