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
                            <a href="#">Rating List</a>
                        </li>

                    </ul>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                        @include('roles.partials.messages')
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Rating List</span>
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
                                                <th> Student Id  </th>
                                                <th> Username </th>
                                                <th> Rating </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;?>
                        @if(isset($rProfiles[0]))
                            @foreach($rProfiles as $rProfile)

                                <tr>
                                    <td>{{$i}}</td>
                                    <td> <a style="text-decoration: none; color: black;" href="{{url('particularProfile').'?id='.$rProfile->id}}">{{$rProfile->student_id}}</a></td>
                                    <td>{{$rProfile->username}}</td>

                                    <?php


                                    $countAns=DB::table('answer_models')
                                        ->join('users','users.id','answer_models.auserId')
                                        ->select('answer_models.id as ansId')
                                        ->where('users.id',$rProfile->id,'=')
                                        ->get();
                                    //dd($countAns);
                                    $rating=0;
                                    foreach ($countAns as $countA)
                                    {
                                        //dd($countA);

                                        $countA= json_decode( json_encode($countA), true);
                                        //print_r($countA) ;
                                        $ratingUp = DB::table('answer_models')
                                            ->join('users','users.id','answer_models.auserId')
                                            ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
                                            ->where([
                                                ['users.id', '=', $rProfile->id],
                                                ['answer_models.id', '=', $countA],
                                            ])->sum('aup');
                                        //dd($ratingUp);

                                        $ratingDown = DB::table('answer_models')
                                            ->join('users','users.id','answer_models.auserId')
                                            ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
                                            ->where([
                                                ['users.id', '=', $rProfile->id],
                                                ['answer_models.id', '=', $countA],
                                            ])->sum('adown');

                                        if ($ratingUp==0&&$ratingDown==0)
                                            $partRating=0;
                                        else{
                                            //according to the Wilson scores
                                            // Laplace smoothing score also score determining method but it does not apply here.


                                            $partRating=(($ratingUp + 1.9208) / ($ratingUp + $ratingDown) -
                                                    1.96 * SQRT(($ratingUp * $ratingDown) / ($ratingUp + $ratingDown) + 0.9604) /
                                                    ($ratingUp + $ratingDown)) / (1 + 3.8416 / ($ratingUp + $ratingDown));
                                        }

//
//            echo $partRating."<br>";
//            echo $ratingUp."<br>";
//            echo $ratingDown."<br>";
                                        $rating=$rating+$partRating;


                                    }

                                    //dd($rating);
                                    $rates=round($rating,2);


                                    ?>




                                    <td>{{$rates}}</td>
                                </tr>
                                <?php $i=$i+1;?>
                            @endforeach
                        @endif

                                           
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
