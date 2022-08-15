@extends('layouts.master') 
@section('custom_css')
<link href="{{asset('phq/style.css')}}" rel="stylesheet"/>
@endsection

@section('content')
<div class="page-body">
                @include('roles.partials.messages')
                  <div class="row" >
                        <div class="portlet-body" style="margin-top:0px" >
                            <div class="report">Answer Details List</div>
                            <div  class="col-md-12">
                                <div style="float: right;" class="social clear">
                                    <div style="display:none;" class="searchbtn clear">
                                    <form method="POST" action="">
                                            <input type="text" name="search" id="search"  value="" placeholder="Search keyword..."/>
                                            <input type="submit" name="submit" value="Search"/>
                                        </form>
                
                                    </div>
                                </div>
                            </div>

                <div style="background: #ffffff none repeat scroll 0 0;"  class="maincontent clear">
                        @if(!empty($allquestion))
                            <div class="samepost clear">
                                <h2><a href="{{url('/pCategory').'?cid='.$allquestion->cmid}}">{{$allquestion->categoryname}}</a></h2>

                                <img width="100" src="{{asset($allquestion->photo)}}"  alt="">

                                <h6><a href="{{url('particularProfile').'?id='.$allquestion->uid}}">{{$allquestion->username}}   </a>  Asked: {{\Carbon\Carbon::parse($allquestion->updated_at)->diffForhumans()}} </h6>

                                <ul id="menu">
                                @if (!is_null(Auth::user()) && (Auth::user()->can('editQuestion') || Auth::user()->can('deleteQuestion') || Auth::id()==$allquestion->uid))
                                

                                        <li><a> .....</a>
                                            <ul>
                                            @if (!is_null(Auth::user()) && (Auth::user()->can('editQuestion') || Auth::id()==$allquestion->uid))
                                                <li><a href="{{url('questionsEdit').'?id='.$allquestion->id}}">Edit </a></li>
                                                @endif
                                                @if (!is_null(Auth::user()) && (Auth::user()->can('editQuestion') || Auth::id()==$allquestion->uid))
                                                <li><a href="{{url('questions/delete').'?id='.$allquestion->id}}" onclick="return confirm('Do You want to confirm to be Deleted?')">Delete</a></li>
                                                @endif

                                            </ul>
                                        </li>
                                    @endif      
                                </ul>
                                <h1>{{$allquestion->qtitle}}  </h1>
                                <div>
                                <pre>{!! htmlspecialchars_decode($allquestion->qcontent) !!} </pre>
                                </div>
                                @if (!is_null(Auth::user()) &&  (Auth::user()->can('downLoadFile')))
                                @if($allquestion->ufile!=null)
                                    <h5><a download="true" href="{{route('downLoadFile',encrypt($allquestion->ufile))}}">---click Image/Pdf</a></h5>
                                @endif
                                @endif
                                <?php
                                $count= DB::table('answer_models')
                                    ->join('question_models','question_models.id','answer_models.qid')
                                    ->where('question_models.id',$allquestion->id,'=')
                                    ->count('answer_models.id');
                                //dd($count);
                                //$count=0;
                                 ?>

                                <div class="readmore clear">
                                    <a href="{{url('answersAdd').'?id='.$allquestion->id}}">Answer</a>
                                </div>
                            </div>
                    @endif

                     <div class="answerfull">
                        @if($ans_count<=1)
                            <h2>{{$ans_count}} Answer</h2>
                        @else
                            <h2>{{$ans_count}} Answers</h2>
                        @endif
                    </div>
                            @if(isset($answers[0]))
                                @foreach($answers as $answer)
                                    <div class="samepost clear">

                                        <img width="100" src="{{asset($answer->photo)}}"  alt="">

                                        <h6><a href="{{url('particularProfile').'?id='.$answer->uid}}">{{$answer->username}}   </a>  Asked:{{\Carbon\Carbon::parse($answer->updated_at)->diffForhumans()}}   </h6>

                                        <ul id="menu">
                                        @if (!is_null(Auth::user()) && (Auth::user()->can('editAnswer') || Auth::user()->can('deleteAnswer') || Auth::id()==$answer->auserId))
                                                <li><a> .....</a>
                                                    <ul>
                                                    @if (!is_null(Auth::user()) && (Auth::user()->can('editAnswer') || Auth::id()==$answer->auserId))
                                                        <li><a href="{{url('answersEdit').'?id='.$answer->id}}">Edit </a></li>
                                                        @endif
                                                        @if (!is_null(Auth::user()) && (Auth::user()->can('deleteAnswer') || Auth::id()==$answer->auserId))
                                                        <li><a href="{{url('answers/delete').'?id='.$answer->id}}" onclick="return confirm('Do You want to confirm to be Deleted?')">Delete</a></li>
                                                        @endif

                                                    </ul>
                                                </li>
                                            @endif
                                        </ul>

                                        <h1><br></h1>
                                        <div>
                                        <pre>{!! htmlspecialchars_decode($answer->acontent) !!} </pre>
                                        </div>
                                        @if (!is_null(Auth::user()) &&  (Auth::user()->can('downLoadFile')))
                                        @if($answer->afile!=null)
                                            <h5><a download="true" href="{{route('downLoadFile',encrypt($answer->afile))}}">---click Image/Pdf</a></h5>

                                        @endif
                                        @endif
                                        <div class="leftmore clear">
                                            <a href="{{url('repliesAdd').'?id='.$answer->id}}">Reply</a>
                                        </div>
                                        
                                         
                                          <!-- Button trigger modal -->
                              @php
                              $reported_by=Auth::id();
                              $answer_id=$answer->id;
                              $answer_report_info=App\answerReport::where([['reported_aid',$answer_id],['reported_by',$reported_by]])
                              ->first();
                              
                              @endphp
                              

                        @if (!is_null(Auth::user()) && Auth::user()->can('reportAnswer'))
                          @if ( empty($answer_report_info))
                          <div class="leftmore clear">
                                            <a href="#" onclick="answeridpass({{$answer->id}})" style="margin-left:6px" data-toggle="modal"> Report</a>
                                            
                                        </div> 
                            <!-- <a href="#" onclick="answeridpass({{$answer->id}})" class="btn btn-info btn-sm" style="margin-left:6px" data-toggle="modal">
                             
                          </a> -->
                          @else
                          <div class="leftmore clear">
                                            <a href="#" class="btn btn-sm btn-info" style="margin-left:6px" title="You have been already reported" data-toggle="modal"> Reported</a>
                                            
                                        </div> 
                      
                            <!-- <a href="#" class="btn btn-sm btn-danger" title="You have been already reported" style="margin-left:6px" data-toggle="modal" >
                              
                          </a> -->
                                              
                        @endif
                    @endif
                     <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Answers Base Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form id="accountForm" action="{{url('reportAnswer')}}" method="POST" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="answer_id_report" name="answer_id_report">
                                                      
              
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













                                        <?php
                                        $countDownAns= \Illuminate\Support\Facades\DB::table('answer_up_down_models')
                                            ->where('answer_up_down_models.ques_id','=',$answer->id)
                                            ->sum('adown');
                                        ?>
                                        <?php

                                        $count= \Illuminate\Support\Facades\DB::table('answer_up_down_models')
                                            ->where('answer_up_down_models.ques_id','=',$answer->id)
                                            ->where('answer_up_down_models.auserId','=',\Illuminate\Support\Facades\Auth::id())
                                            ->select('aup','adown')
                                            ->first();
                                        //print_r($count) ;
                                        $count=json_decode(json_encode($count), true);

                                        //if ($count['aup']==1)


                                        ?>
                                        <div class="down clear">
                                            <?php  echo $countDownAns;?><a href="{{route('upAnsSave',['id'=> $answer->id,'qid'=>$allquestion->id,'bool'=>0])}}">
                                                    @if(!empty($count['adown']) && $count['adown']==1))<img src="{{asset('/phq/uploads/logo/Cdownvote.PNG')}}" /> @else <img src="{{asset('/phq/uploads/logo/downvote.PNG')}}" /> @endif  
                                                </a>
                                        </div>
                                        <?php
                                            $countUpAns= \Illuminate\Support\Facades\DB::table('answer_up_down_models')
                                            ->where('answer_up_down_models.ques_id','=',$answer->id)
                                            ->sum('aup');


                                        ?>
                                        <div class="up clear">
                                        
                                            <?php  echo $countUpAns;?><a href="{{route('upAnsSave',['id'=> $answer->id,'qid'=>$allquestion->id,'bool'=>1])}}">
                                            @if(!empty($count['aup']) && $count['aup']==1)<img src="{{asset('/phq/uploads/logo/Cupvote.PNG')}}" /> @else <img src="{{asset('/phq/uploads/logo/upvote.PNG')}}" /> @endif
                                            </a>
                                        </div>
                                        </div>
                                    
                                    
                                    @foreach($replies as $reply)
                                        @if($reply->aid==$answer->id)

                                        <div class="samepost clear">
                                    <div class="replypost clear">
                                                <img width="100" src="{{asset($reply->photo)}}"  alt="">
                                                <h6><a href="{{url('particularProfile').'?id='.$reply->uid}}">{{$reply->username}}</a> Asked: {{\Carbon\Carbon::parse($reply->updated_at)->diffForhumans()}}   </h6>
                                                <ul id="menu">
                                                @if (!is_null(Auth::user()) && (Auth::user()->can('editReply') || Auth::user()->can('deleteReply') || Auth::id()==$reply->ruserId))
                                               
                                                        <li><a> .....</a>
                                                            <ul>
                                                            @if (!is_null(Auth::user()) && (Auth::user()->can('editReply') || Auth::id()==$reply->ruserId))
                                                            <li><a href="{{url('repliesEdit').'?id='.$reply->id}}">Edit </a></li>
                                                            @endif
                                                            @if (!is_null(Auth::user()) && (Auth::user()->can('deleteReply') || Auth::id()==$reply->ruserId))
                                                                <li><a href="{{url('replies/delete').'?id='.$reply->id}}" onclick="return confirm('Do You want to confirm to be Deleted?')">Delete</a></li>
                                                                @endif
                                                            </ul>
                                                        </li>
                                                        @endif
                                                    
                                                </ul>
                                                <h1><br></h1>
                                                <div>

                                        <pre>{!! htmlspecialchars_decode($reply->rcontent) !!} </pre>
                                       
                                        </div>
                                        @if($reply->rfile!=null)
                                                
                                        <h5><a download="true" href="{{route('downLoadFile',encrypt($reply->rfile))}}">---click Image/Pdf</a></h5>
                                                @endif


                                                <?php
                                                $countDownRep= \Illuminate\Support\Facades\DB::table('reply_up_down_models')
                                                    ->where('reply_up_down_models.ans_id','=',$reply->id)
                                                    ->sum('rdown');
                                                ?>

                                                <?php

                                                $count= \Illuminate\Support\Facades\DB::table('reply_up_down_models')
                                                    ->where('reply_up_down_models.ans_id','=',$reply->id)
                                                    ->where('reply_up_down_models.ruserId','=',\Illuminate\Support\Facades\Auth::id())
                                                    ->select('rup','rdown')
                                                    ->first();
                                                //print_r($count) ;
                                                $count=json_decode(json_encode($count), true);

                                                //if ($count['aup']==1)


                                                ?>
                                                <div class="down clear">
                                                    <?php  echo $countDownRep;?><a href="{{route('upDownRepSave',['id'=> $reply->id,'bool'=>0])}}">
                                                            @if(!empty($count['rdown']) && $count['rdown']==1)<img src="{{asset('/phq/uploads/logo/Cdownvote.PNG')}}" /> @else <img src="{{asset('/phq/uploads/logo/downvote.PNG')}}" /> @endif

                                                        </a>

                                                </div>
                                                <?php
                                                $countUpRep= \Illuminate\Support\Facades\DB::table('reply_up_down_models')
                                                    ->where('reply_up_down_models.ans_id','=',$reply->id)
                                                    ->sum('rup');
                                                ?>
                                                <div class="up clear">
                                                    <?php  echo $countUpRep;?><a href="{{route('upDownRepSave',['id'=> $reply->id,'bool'=>1])}}">
                                                            @if(!empty($count['rup']) && $count['rup']==1)<img src="{{asset('/phq/uploads/logo/Cupvote.PNG')}}" /> @else <img src="{{asset('/phq/uploads/logo/upvote.PNG')}}" /> @endif

                                                        </a>
                                                </div>
                                                </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                
                                                @endforeach
                                               @endif
                                    
                              </div>
                            </div>
                         </div>
                        </div>
                    </div>
@endsection
@section('custom_js')
<script>
    function answeridpass(id){
       $('#answer_id_report').val(id);
       $('#exampleModalCenter').modal('show');
    }
 </script>
@endsection