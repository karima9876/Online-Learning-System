
@extends('layouts.master') 
@section('custom_css')
<style>
    .page-body{
        background:#ffffff;
    }
</style>

<link href="{{asset('phq/style.css')}}" rel="stylesheet" />

@endsection
 <!-- @section('dashboard') active @endsection  -->


@section('content')
                <div class="page-body">
                @include('roles.partials.messages')

                    <div  class="row" >
                        <div class="portlet-body" style="margin-top:0px" >
                            <div class="report">All Question List</div>
                            <div  class="col-md-12">
                                <div style="float: right;" class="social clear">
                                    <div class="searchbtn clear">
                                        <form method="POST" action="{{url('welcomeSearch')}}">
                                        @csrf
                                            <input type="text" name="search" id="search"  value="@if(!empty($search)) {{$search->search}} @endif" placeholder="Search keyword..."/>
                                            <input type="submit" name="submit" value="Search"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            

                            <div style="background: #ffffff none repeat scroll 0 0;min-height:800px"  class="maincontent clear">
                            @if(isset($allquestion[0]))
                            @foreach($allquestion as $alllist)

                         
                                <div class="samepost">
                                    <h2><a href="{{url('/pCategory').'?cid='.$alllist->cmid}}">{{$alllist->categoryname}}</a></h2>
                                    <img width="100" src="{{asset($alllist->photo)}}"  alt="">

                                    <h6><a href="{{url('particularProfile').'?id='.$alllist->uid}}">{{$alllist->username}}   </a>  Asked: {{\Carbon\Carbon::parse($alllist->updated_at)->diffForhumans()}}</h6>
                                    
                                    <ul id="menu">
                                    @if (!is_null(Auth::user()) && (Auth::user()->can('editQuestion') || Auth::user()->can('deleteQuestion') || Auth::id()==$alllist->uid))
                                    
                                        <li><a> .....</a>
                                           
                                       
                                            <ul>
                                            @if (!is_null(Auth::user()) && (Auth::user()->can('editQuestion') || Auth::id()==$alllist->uid))
                                            <li><a href="{{url('questionsEdit').'?id='.$alllist->id}}">Edit </a></li>
                                            @endif
                                            @if (!is_null(Auth::user()) && (Auth::user()->can('deleteQuestion') || Auth::id()==$alllist->uid))
                                                <li><a href="{{url('questions/delete').'?id='.$alllist->id}}" onclick="return confirm('Do You want to confirm to be Deleted?')">Delete</a></li>
                                            @endif

                                            </ul>
                                            
                                        </li>
                                        @endif
                                    </ul>
                                     <h1>{{$alllist->qtitle}}  </h1>
                                    <div>
                                     
                                     <pre>{!! htmlspecialchars_decode($alllist->qcontent) !!} </pre>
                                  
                                    </div>
                                    @if (!is_null(Auth::user()) &&  (Auth::user()->can('downLoadFile')))
                                    @if($alllist->ufile!=null)
                                    <h5><a download="download" href="{{route('downLoadFile',encrypt($alllist->ufile))}}">---click Image/Pdf</a></h5>
                                    @endif
                                    @endif



                                <?php

                                $count= DB::table('answer_models')
                                    ->join('question_models','question_models.id','answer_models.qid')
                                    ->where('question_models.id',$alllist->id,'=')
                                    ->count('answer_models.id');
                                //dd($count);
                                //$count=0;
                                ?>
                                   
                                <div class="leftmore clear">
                                <a href="{{url('answers').'?id='.$alllist->id}}"><?php echo  $count?>  @if($count<2) Answer @else Answers @endif</a>
                                <!-- <a href="{{url('questionsReport')}}" style="margin-left:6px">Report</a> -->
                                
                              <!-- Button trigger modal -->
                              @php
                              $reported_by=Auth::id();
                              $question_id=$alllist->id;
                              $question_report_info=App\questionReport::where([['reported_qid',$question_id],['reported_by',$reported_by]])
                              ->first();
                              
                              @endphp
                              

                        @if (!is_null(Auth::user()) && Auth::user()->can('reportQuestion'))
                          @if ( empty($question_report_info))
                            <a href="#"  onclick="questionidpass({{$alllist->id}})" class="btn btn-sm" style="margin-left:6px" data-toggle="modal" >
                              Report
                          </a>
                          @else
                      
                            <a href="#" class="btn btn-sm btn-info" title="You have been already reported" style="margin-left:6px" data-toggle="modal" >
                              Reported
                          </a>
                                              
                        @endif
                    @endif
                    

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Questions Base Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form id="accountForm" action="{{url('reportQuestion')}}" method="POST" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="question_id_report" name="question_id_report">
                                                      
              
                  <div class="form-group has-feedback">
                      <label class="col-lg-2 control-label">Report<span class="red">*</span>:</label>
                      <div class="col-lg-9">
                      <textarea class = "form-control input-inline input-medium" name="report_cause"  style=" resize: vertical;" rows = "5" placeholder ="Cause of report"></textarea>
                          <strong class="red"></strong> 
                      </div>
                  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>


          </div>
          <div class="readmore clear">
          <a href="{{url('answersAdd').'?id='.$alllist->id}}">Answer</a>
          </div>
          </div>
                @endforeach
                <li style="float: right;"  class="page-item">{{$allquestion->links()}}</li>
               @endif
             </div>
            </div>
            </div>
           </div>
          </div>
        </div>

                        
 @endsection
 @section('custom_js')
 <script>
    function questionidpass(id){
       $('#question_id_report').val(id);
       $('#exampleModalCenter').modal('show');
    }
 </script>
@endsection