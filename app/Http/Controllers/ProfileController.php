<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class ProfileController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function showProfile(){
        $data['qCount']= DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->where('users.id',Auth::user()->id,'=')
            ->count();

        $data['aCount']= DB::table('answer_models')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->where('users.id',Auth::user()->id,'=')
            ->count();

        $data['rCount']= DB::table('reply_models')
            ->leftjoin('users','users.id','reply_models.ruserId')
            ->where('users.id',Auth::user()->id,'=')
            ->count();

        $data['particularPro']= DB::table('users')
            ->where('users.id',Auth::user()->id,'=')
            ->first();

        $countAns=DB::table('answer_models')
            ->join('users','users.id','answer_models.auserId')
            ->select('answer_models.id as ansId')
            ->where('users.id',Auth::user()->id,'=')
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
                    ['users.id', '=', Auth::user()->id],
                    ['answer_models.id', '=', $countA],
                ])->sum('aup');
            //dd($ratingUp);
//            $ratingUp=DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where('users.id',$request->id,'=')
//                //->where('answer_models.id',$countA,'=')
//                ->sum('aup');

            $ratingDown = DB::table('answer_models')
                ->join('users','users.id','answer_models.auserId')
                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
                ->where([
                    ['users.id', '=', Auth::user()->id],
                    ['answer_models.id', '=', $countA],
                ])->sum('adown');
            //dd($ratingDown);
//            $ratingDown=DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where('users.id',$request->id,'=')
//                ->sum('adown');
            //$ratingUp=6;
            //$ratingDown=0;

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
            //echo $partRating."<br>";
//            echo $ratingUp."<br>";
//            echo $ratingDown."<br>";
            $rating=$rating+$partRating;
           
            

        }

        //dd($rating);
        $data['rating']=round($rating,2);
        //dd($data);



        return view('profiles.profile',$data);
    }
    public function displayParticularProfile(Request $request){

        // $data['particularPro']= DB::table('users')
        //     ->where('users.id',$request->id,'=')
        //     ->first();




        $data['qCount']= DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->where('users.id',$request->id,'=')
            ->count();

        $data['aCount']= DB::table('answer_models')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->where('users.id',$request->id,'=')
            ->count();

        $data['rCount']= DB::table('reply_models')
            ->leftjoin('users','users.id','reply_models.ruserId')
            ->where('users.id',$request->id,'=')
            ->count();

        $data['particularPro']= DB::table('users')
            ->where('users.id',$request->id,'=')
            ->first();

        $countAns=DB::table('answer_models')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->select('answer_models.id as ansId')
            ->where('users.id',$request->id,'=')
            ->get();
        //dd($countAns);
        $rating=0;
        foreach ($countAns as $countA)
        {
            //dd($countA);

            $countA= json_decode( json_encode($countA), true);
            //print_r($countA) ;
            $ratingUp = DB::table('answer_models')
                ->leftjoin('users','users.id','answer_models.auserId')
                ->leftjoin('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
                ->where([
                ['users.id', '=', $request->id],
                ['answer_models.id', '=', $countA],
            ])->sum('aup');
            //dd($ratingUp);
//            $ratingUp=DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where('users.id',$request->id,'=')
//                //->where('answer_models.id',$countA,'=')
//                ->sum('aup');

            $ratingDown = DB::table('answer_models')
                ->leftjoin('users','users.id','answer_models.auserId')
                ->leftjoin('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
                ->where([
                    ['users.id', '=', $request->id],
                    ['answer_models.id', '=', $countA],
                ])->sum('adown');
            //dd($ratingDown);
//            $ratingDown=DB::table('answer_models')
//                ->join('users','users.id','answer_models.auserId')
//                ->join('answer_up_down_models','answer_up_down_models.ques_id','answer_models.id')
//                ->where('users.id',$request->id,'=')
//                ->sum('adown');
            //$ratingUp=0;
            //$ratingDown=0;

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
        $data['rating']=round($rating,2);



        //dd($rating);
        //dd($data);
            

       
        return view('profiles.particularProfile',$data);
    }















    //password
    public function changePassword(){
        if (is_null($this->user) ||  !$this->user->can('changepassword')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        return view('profiles.changepassword');
    }
    //updatePassword
    public function updatePassword(Request $request){
        if (is_null($this->user) ||  !$this->user->can('update.password')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $id=Auth::user()->id;
        $db_pass=Auth::user()->password;
        $old_pass=$request->old_password;
        $new_pass=$request->new_password;
        $confirm_pass=$request->confirm_password;
        
        if(Hash::check($old_pass,$db_pass)==true){
            
            if($new_pass === $confirm_pass){
                User::find($id)->update([
                    'password'=>Hash::make($request->new_password)

                ]);
                Auth::logout();
                return Redirect()->route('login');
                

            }else{
           
            return Redirect()->back()->with('danger','New Password and Confirm password Not same');

        }

        }else{
           
            return Redirect()->back()->with('error','Old Password Not match');

        }

    }
}
