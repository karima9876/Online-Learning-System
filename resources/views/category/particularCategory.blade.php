@extends('layouts.master') 

@section('custom_css')
<link href="{{asset('phq/style.css')}}" rel="stylesheet" />


@endsection

@section('content')



                
                <div class="page-body">
                @include('roles.partials.messages')

                    <div  class="row" >
                        <div class="portlet-body" >
                        <div class="report"> @if(!empty($cat)) {{$cat->categoryname}} @endif 's  Question List</div>
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
                @if(isset($allquestion[0]))
                        @foreach($allquestion as $alllist)

                            <div class="samepost clear">
                                <h2><a href="{{url('/pCategory').'?cid='.$alllist->cmid}}">{{$alllist->categoryname}}</a></h2>

                                <img width="100" src="{{asset($alllist->photo)}}"  alt="">

                                    <h6><a href="{{url('particularProfile').'?id='.$alllist->uid}}">{{$alllist->username}}   </a>  Asked: {{\Carbon\Carbon::parse($alllist->updated_at)->diffForhumans()}}</h6>

                                <ul id="menu">
                                @if(Auth::id()==$alllist->uid)
                                    
                                    

                                        <li><a> .....</a>
                                            <ul>
                                            <li><a href="{{url('questionsEdit').'?id='.$alllist->id}}">Edit </a></li>
                                                <li><a href="{{url('questions/delete').'?id='.$alllist->id}}" onclick="return confirm('Do You want to confirm to be Deleted?')">Delete</a></li>

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
                                    <h5><a href="{{route('downLoadFile',encrypt($alllist->ufile))}}">---click Image/Pdf</a></h5>
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
                                    </div>
                                    <div class="readmore clear">
                                    <a href="{{url('answersAdd').'?id='.$alllist->id}}">Answer</a>
                                    </div>
                                </div>
                        @endforeach
                    @endif





                </div>



                
        </div>
    </div>
    </div>
    </div>
   

    
@endsection

@section('custom_js') 


 @endsection 

