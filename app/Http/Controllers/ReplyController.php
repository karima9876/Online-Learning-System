<?php

namespace App\Http\Controllers;

use App\AnswerModel;
use App\CategoryModel;
use App\QuestionModel;
use App\ReplyModel;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReplyController extends Controller
{


    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function addReply(Request $request){
        if (is_null($this->user) ||  !$this->user->can('addReply')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        
        $userId=Auth::user()->id;
        $data['userTable']= DB::table('users')
            ->where('users.id','=',$userId)
            ->first();

        $data['answer']= DB::table('answer_models')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->select('users.username','users.photo','answer_models.id','answer_models.qid','answer_models.updated_at','answer_models.acontent','answer_models.afile')
            ->where('answer_models.id',$request->id,'=')
            ->first();


        //dd($data);

        return view('reply.replyAddForm',$data);
    }





    public function saveReply(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $r_info = ReplyModel::where('ruserId',Auth::user()->id)->first();
            //dd( $q_info);
              if(empty($r_info)){
                  if (is_null($this->user) ||  !$this->user->can('saveReply')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('saveReply')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }
		///dd($request->all());
		
        $data = new ReplyModel();
//dd(bcrypt($request->aaid));


        $validator = \Validator::make($request->all(), [
            'rcontent' => ['required'],
             'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please right captcha')
                ->withInput();
        }

        if(isset($request->id) &&!empty($request->id))
            $data = ReplyModel::find($request->id);


        if(isset($request->id)&& !empty($request->id))
            $request->aaid=$data->aid;

       // dd($request->aaid);

        $qid  = DB::table('answer_models')
            ->select('answer_models.qid')
            ->where('answer_models.id',$request->aaid,'=')
            ->first();
//dd($data);

//dd($qid);

        if($data->ruserId==null)
            $data->ruserId=Auth::id();


        if($data->aid==null)
            $data->aid=$request->aaid;

        $data->rcontent=$request->rcontent;


        if(!empty($request->file('rfile')))
            $data->rfile= Storage::disk('public')->put('Reply/', $request->file('rfile'));

        //dd($data);
        $data->save();

       // dd($data);
        return redirect()->route('answers',['id'=>$qid->qid]);

    }

    public function deleteReply(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $r_info = ReplyModel::where('ruserId',Auth::user()->id)->first();
            //dd( $q_info);
              if(empty($r_info)){
                  if (is_null($this->user) ||  !$this->user->can('deleteReply')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('deleteReply')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }

        ReplyModel::find($request->id)->delete();
        return redirect()->back();
    }

    public function editReply(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $r_info = ReplyModel::where('ruserId',Auth::user()->id)->first();
            //dd( $q_info);
              if(empty($r_info)){
                  if (is_null($this->user) ||  !$this->user->can('editReply')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('editReply')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }

        $userId=Auth::user()->id;
        $data['userTable']= DB::table('users')
            ->where('users.id','=',$userId)
            ->first();

        $data['replies'] = ReplyModel::find($request->id);
//dd($data);

        return view('reply.replyEditForm',$data);
    }

    
}
