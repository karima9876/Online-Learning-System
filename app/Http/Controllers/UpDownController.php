<?php

namespace App\Http\Controllers;

use App\AnswerUpDownModel;
use App\ReplyUpDownModel;
use App\UpVoteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpDownController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    

    public function saveAnsUpVote(Request $request,$id,$qid,$bool){
        if (is_null($this->user) ||  !$this->user->can('upAnsSave')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }

       // dd($bool);


//        if(isset($request->id) &&!empty($request->id))
//            $data = AnswerUpDownModel::find($request->id);



        $voteShow = DB::table('answer_up_down_models')->where([
            ['auserId', '=', Auth::id()],
            ['ques_id', '=', $id],
        ])->first();

        //dd($voteShow->id);
        if (empty($voteShow)){
            $data = new AnswerUpDownModel();
            $data->auserId = Auth::id();
            $data->ques_id = $id;
            if ($bool==1){
                $data->aup = 1;
                $data->adown = 0;
            }else{
                $data->aup = 0;
                $data->adown = 1;
            }
        }else{
            $data = AnswerUpDownModel::find($voteShow->id);
            if ($bool==1 &&$voteShow->aup==1||$bool==0 &&$voteShow->adown==1){
                $data->auserId = Auth::id();
                $data->ques_id = $id;
                $data->aup = 0;
                $data->adown = 0;

            }else if($bool==0 &&$voteShow->aup==1){
                $data->auserId = Auth::id();
                $data->ques_id = $id;
                $data->aup = 0;
                $data->adown = 1;

            }
            else if($bool==1 &&$voteShow->adown==1){
                $data->auserId = Auth::id();
                $data->ques_id = $id;
                $data->aup = 1;
                $data->adown = 0;

            }
            else if($bool==1 &&$voteShow->adown==0 &&$voteShow->aup==0){
                $data->auserId = Auth::id();
                $data->ques_id = $id;
                $data->aup = 1;
                $data->adown = 0;

            }
            else if($bool==0 &&$voteShow->adown==0&&$voteShow->aup==0){
                $data->auserId = Auth::id();
                $data->ques_id = $id;
                $data->aup = 0;
                $data->adown = 1;

            }
        }



//        dd($data);

        if($data->save())
            return redirect()->back();
//            return redirect()->route('answers',['id'=>$qid]);
    }
    public function saveRepUpVote(Request $request,$id,$bool){
        if (is_null($this->user) ||  !$this->user->can('upDownRepSave')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }

        // dd($bool);


//        if(isset($request->id) &&!empty($request->id))
//            $data = AnswerUpDownModel::find($request->id);



        $voteShow = DB::table('reply_up_down_models')->where([
            ['ruserId', '=', Auth::id()],
            ['ans_id', '=', $id],
        ])->first();

        //dd($voteShow->id);
        if (empty($voteShow)){
            $data = new ReplyUpDownModel();
            $data->ruserId = Auth::id();
            $data->ans_id = $id;
            if ($bool==1){
                $data->rup = 1;
                $data->rdown = 0;
            }else{
                $data->rup = 0;
                $data->rdown = 1;
            }
        }else{
            $data = ReplyUpDownModel::find($voteShow->id);
            if ($bool==1 &&$voteShow->rup==1||$bool==0 &&$voteShow->rdown==1){
                $data->ruserId = Auth::id();
                $data->ans_id = $id;
                $data->rup = 0;
                $data->rdown = 0;

            }else if($bool==0 &&$voteShow->rup==1){
                $data->ruserId = Auth::id();
                $data->ans_id = $id;
                $data->rup = 0;
                $data->rdown = 1;

            }
            else if($bool==1 &&$voteShow->rdown==1){
                $data->ruserId = Auth::id();
                $data->ans_id = $id;
                $data->rup = 1;
                $data->rdown = 0;

            }
            else if($bool==1 &&$voteShow->rdown==0 &&$voteShow->rup==0){
                $data->ruserId = Auth::id();
                $data->ans_id = $id;
                $data->rup = 1;
                $data->rdown = 0;

            }
            else if($bool==0 &&$voteShow->rdown==0&&$voteShow->rup==0){
                $data->ruserId = Auth::id();
                $data->ans_id = $id;
                $data->rup = 0;
                $data->rdown = 1;

            }
        }



//        dd($data);

        if($data->save())
            return redirect()->back();
//            return redirect()->route('answers',['id'=>$qid]);
    }
}
