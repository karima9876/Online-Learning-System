<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function listRate(Request $request){



        $data['rProfiles']= DB::table('users')
            ->where('users.id','!=',1)
            ->get();

        $data['Profiles']= DB::table('answer_models')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->leftjoin('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
            ->where('users.id','!=',1)
            ->get();
        //dd($data1);
//        $countAns=DB::table('answer_models')
//            ->join('users','users.id','answer_models.auserId')
//            ->select('answer_models.id as ansId')
//            ->where('users.id',Auth::user()->id,'=')
//            ->get();
//        //dd($countAns);
//        $rating=0;
//        $lt=0;
//        foreach ($countAns as $countA)
//        {
//            //dd($countA);
//
//            $countA= json_decode( json_encode($countA), true);
//            //print_r($countA) ;
//            $ratingUp = DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where([
//                    ['users.id', '=', Auth::user()->id],
//                    ['answer_models.id', '=', $countA],
//                ])->sum('aup');
//            //dd($ratingUp);
//
//            $ratingDown = DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where([
//                    ['users.id', '=', Auth::user()->id],
//                    ['answer_models.id', '=', $countA],
//                ])->sum('adown');
//
//            if ($ratingUp==0&&$ratingDown==0)
//                $partRating=0;
//            else{
//                //according to the Wilson scores
//                // Laplace smoothing score also score determining method but it does not apply here.
//
//
//                $partRating=(($ratingUp + 1.9208) / ($ratingUp + $ratingDown) -
//                        1.96 * SQRT(($ratingUp * $ratingDown) / ($ratingUp + $ratingDown) + 0.9604) /
//                        ($ratingUp + $ratingDown)) / (1 + 3.8416 / ($ratingUp + $ratingDown));
//            }
//
////
////            echo $partRating."<br>";
////            echo $ratingUp."<br>";
////            echo $ratingDown."<br>";
//            $rating=$rating+$partRating;
//
//
//
//        }
//
//        //dd($rating);
//        $data1['rates']=round($rating,2);
//        //$data1['rates']=3;




        //dd($data1);

        return view('Rating.rating',$data);
    }
}
