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
                            <a href="#">Update Category</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-lg-10 col-sm-10 col-xs-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">update Category Form</span>
                                    
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
                                            <a href="{{url('/categoryList')}}" class="btn btn-default">
                                                Category List
                                            </a>
                                        </div>

                                        <form action="{{url('category/update/'.$category->id)}}" method="POST">
                                            @csrf

                                            <div class="tab-content tabs-flat">
                                                <div class="tab-pane active" id="address-tab">
                                                    <div class="form-group has-feedback">
                                                        <label class="col-lg-4 control-label">Category Name<span class="red">*</span>:</label>
                                                        <div class="col-lg-8 ">
                                                            <input type="text" name="categoryname" value="{{$category->categoryname}}" placeholder="Enter Category Name" class="form-control input-inline input-medium">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group has-feedback">
                                                <div class="col-md-offset-5 col-md-6" style="margin-top:10px">
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
            
    @endsection

    @section('custom_js')

    
    @endsection
   
    
