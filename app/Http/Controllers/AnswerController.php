<?php

namespace App\Http\Controllers;

use App\AnswerModel;
use App\CategoryModel;
use App\User;

use App\QuestionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function listAnswer(Request $request){
        $data['allquestion']= DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->leftjoin('categories','categories.id','question_models.qcategoryname')
            ->select('users.id as uid','categories.id as cmid','categories.categoryname','users.username','question_models.quserId','users.photo','question_models.id','question_models.updated_at','question_models.qtitle','question_models.qcategoryname','question_models.qcontent','question_models.ufile')
            ->where('question_models.id',$request->id,'=')
            ->first();


        $data['answers']= DB::table('answer_models')
            ->leftjoin('question_models','question_models.id','answer_models.qid')
            ->leftjoin('users','users.id','answer_models.auserId')
            ->select('users.id as uid','users.username','users.photo','answer_models.auserId','answer_models.id','answer_models.updated_at','answer_models.acontent','answer_models.afile')
            ->orderBy('answer_models.id','ASC')
            ->where('question_models.id',$request->id,'=')
//            ->paginate(2);
            ->get();

//dd($data1);


        $data['replies']= DB::table('reply_models')
           ->leftjoin('answer_models','answer_models.id','reply_models.aid')
         
            ->leftjoin('users','users.id','reply_models.ruserId')
            ->select('users.id as uid','users.username','users.photo','reply_models.ruserId','reply_models.aid','reply_models.id','reply_models.updated_at','reply_models.rcontent','reply_models.rfile')
            ->orderBy('reply_models.id','ASC')
            ->where('answer_models.qid',$request->id,'=')
            ->get();

//dd($data);
        $data['ans_count']=DB::table('answer_models')
            ->leftjoin('question_models','question_models.id','answer_models.qid')
            ->where('question_models.id',$request->id,'=')
            ->count('answer_models.id');





        //dd($data1);

         return view('answer.answerList',$data);
    }

   


    public function addAnswer(Request $request){
        if (is_null($this->user) ||  !$this->user->can('addAnswer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
       
        $data['allquestion']= DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->select('users.username','users.photo','question_models.id','question_models.updated_at','question_models.qtitle','question_models.qcategoryname','question_models.qcontent','question_models.ufile')
            ->where('question_models.id',$request->id,'=')
            ->first();


//dd($data1);

        return view('answer.answerAddForm',$data);
    }

    public function saveAnswer(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $a_info = AnswerModel::where('auserId',Auth::user()->id)->first();
            //dd( $a_info);
              if(empty($a_info)){
                  if (is_null($this->user) ||  !$this->user->can('saveAnswer')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('saveAnswer')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }
        $data = new AnswerModel();
//dd($request->qid);
        //dd($data);

        $validator = \Validator::make($request->all(), [
            'acontent' => ['required'],
             'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please right captcha')
                ->withInput();
        }

        if(isset($request->id) &&!empty($request->id))
           $data = AnswerModel::find($request->id);
       // dd($data);
       // if($data==null)
         //   $data = new AnswerModel();

//dd($data);

        if($data->auserId==null)
        $data->auserId=Auth::id();


        if($data->qid==null)
        $data->qid=$request->qqid;

        $data->acontent=$request->acontent;


        if(!empty($request->file('afile')))
            $data->afile= Storage::disk('public')->put('Answer/', $request->file('afile'));

        //dd($data);
        $data->save();

       //dd($data);
        return redirect()->route('answers',['id'=>$data->qid]);
    }

    public function deleteAnswer(Request $request){
            if(isset($request->id) &&!empty($request->id)){
                $a_info = AnswerModel::where('auserId',Auth::user()->id)->first();
                //dd( $a_info);
                  if(empty($a_info)){
                      if (is_null($this->user) ||  !$this->user->can('deleteAnswer')) {
                          $message = 'You are not allowed to access this page !';
                          return view('errors.403', compact('message'));
                      }
                  }
          }else{
              if (is_null($this->user) ||  !$this->user->can('deleteAnswer')) {
                  $message = 'You are not allowed to access this page !';
                  return view('errors.403', compact('message'));
              }
    
          }
        
        AnswerModel::find($request->id)->delete();
        return redirect()->back();
    }

    public function editAnswer(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $a_info = AnswerModel::where('auserId',Auth::user()->id)->first();
            //dd( $a_info);
              if(empty($a_info)){
                  if (is_null($this->user) ||  !$this->user->can('editAnswer')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('editAnswer')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }
        $userId=Auth::user()->id;
        $data['userTable']= DB::table('users')
            ->where('users.id','=',$userId)
            ->first();

        $data['allquestion'] = AnswerModel::find($request->id);
//dd($data);

        return view('answer.answerEditForm',$data);
    }
    

}
