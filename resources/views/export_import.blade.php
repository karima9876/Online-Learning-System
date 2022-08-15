@extends('layouts.master') 

@section('custom_css')

<style>
		.widget-body{
			min-height:200px;
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
                            <a href="#">Export</a>
                        </li>
                        
                    </ul>
                </div>
                <div style="margin-left: 40px;" class="portlet-title">
                    <div class="caption">
                        <h2 class="bold">Database Export </h2>
                    </div>
                    <hr>
                </div>
                <div style="margin-left: 20px;margin-top: 20px;" class="page-body">
                   
                     
                            <div class="row">
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                            
                                            <div class="widget flat radius-bordered">
                                                <div class="row">
                                                   
                                                    <div class="widget-header bordered-bottom bordered-palegreen">
                                                        <span class="widget-caption">Database Export</span>
                                                    </div>

                                                
                                                <div class="widget-body">
                                                    
                                                    <div class="card">

                                                       
                                                        <div style="margin-top: 16px;" class="card-body">
                                                                
                                                                <div class="portlet-body form">
                                                                    <a href="{{ URL::to('ex-import/export') }}" class="btn btn-md btn-primary">
                                                                        Database Export
                                                                    </a> 
                                                                </div>
                                                                <br><br>
                                                                
                                                
                                    
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