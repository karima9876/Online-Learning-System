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
                            <a href="#">Category List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Category List</span>
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
                                @if (!is_null(Auth::user()) &&  Auth::user()->can('addcategory'))
                              
                                    <div class="table-toolbar pull-right">
                                    
                                        
                                        <a  href="{{url('/addcategory')}}" class="btn btn-default">
                                            Add New Category
                                        </a> 

                                    </div>
                                    @endif
                                   
                                    <table class="table table-striped table-hover table-bordered" id="sample_1">
                                        <thead>
                                            <tr role="row">
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                @if (!is_null(Auth::user()) &&  (Auth::user()->can('category.edit') || Auth::user()->can('category.delete')))
                              
                                                
                                                <th> Action </th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                        $serial=1;
                                        @endphp
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>
                                                <a style="color: #004982;text-decoration: none" href="{{url('/pCategory').'?cid='.$category->id}}">{{$serial++}} </a>
                                                </td>
                                                
                                                <td>{{$category->categoryname}}</td>

                                                 @if (!is_null(Auth::user()) && (Auth::user()->can('category.edit') || Auth::user()->can('category.delete')))
                                                <td>
                                                @if (!is_null(Auth::user()) &&  Auth::user()->can('category.edit'))
                                                    <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    @endif
                                                    @if (!is_null(Auth::user()) &&  Auth::user()->can('category.delete'))
                                                    <a href="{{url('category/delete/'.$category->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
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
           
                    
     @endsection

@section('custom_js') 


   

 @endsection 
