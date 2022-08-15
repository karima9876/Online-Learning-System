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
                            <a href="#">Question_Report List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Question_Report List</span>
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
                                                <th>No.</th>
                                                <th>Reported_By</th>
                                                <th>Reported_To</th>
                                                <th>Reported_Cause</th>
                                                <th>Question</th>
                                       
                                                <th>Created_At</th>
                                                @if (!is_null(Auth::user()) &&  (Auth::user()->can('blockUser') || Auth::user()->can('unblockUser') || Auth::user()->can('delete_question_reportList')))
                                                <th> Action </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=0; ?>
                                        @if(!empty($question_report_lists))
                                        
                                            @foreach($question_report_lists as $question_report_list)
                                       
                                            <tr>
                                                <td>
                                                <a style="color: #004982;text-decoration: none" href="#"> {{++$i}} </a>
                                              </td>
                                                <td>{{$question_report_list->reported_by_username}}</td>
                                                
                                                <td>{{$question_report_list->reported_to_username}}</td>
                                                <td>{{$question_report_list->reported_cause}}</td>
                                                <td>{!! $question_report_list->content !!}</td>
                                           
                                                <td>{{Carbon\Carbon::parse($question_report_list->created_at)->diffForhumans()}}</td>
                                                @php
                                                    $is_block = 0;
                                                    $is_user=App\User::find($question_report_list->reported_to_id);
                                                    if(!empty($is_user)){
                                                        $roles = $is_user->getRoleNames();
                                                        foreach ($roles as $role) {
                                                            if($role == 'block_user'){
                                                                $is_block =1;
                                                            }                  
                                                        }
                                                    }
                                                   
                                                @endphp
                                                @if (!is_null(Auth::user()) && (Auth::user()->can('blockUser') || Auth::user()->can('unblockUser') || Auth::user()->can('delete_question_reportList')))
                                                <td>
                                                @if($is_block == 0)
                                                @if (!is_null(Auth::user()) &&  Auth::user()->can('blockUser'))
                                                    <a href="{{route('blockUser', $question_report_list->reported_to_id)}}" onclick="return confirm('Are you sure to block?')" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i>Block</a>
                                                    @endif  
                                                    @else
                                                    <a href="{{route('unblockUser', $question_report_list->reported_to_id)}}" onclick="return confirm('Are you sure to unblock?')" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i>Unblock</a> 
                                                @endif
                                                @if (!is_null(Auth::user()) &&  Auth::user()->can('delete_question_reportList'))                                
                                                    <a href="{{route('delete_question_reportList',$question_report_list->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i>Delete</a>  
                                                    @endif 
                                                </td>
                                                @endif  
                                            </tr>
                                            @endforeach
                                            @endif
                                         
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
           
                    
     @endsection

@section('custom_js') 


   

 @endsection 
