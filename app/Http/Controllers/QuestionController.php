<?php
namespace App\Http\Controllers;
use App\Category;
use App\QuestionModel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function addQuestion(){
        if (is_null($this->user) ||  !$this->user->can('addQuestion')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
       $data['categories']= DB::table('categories')
            ->select('id','categoryname')
            ->get();
            //dd($data);

        return view('question.questionAddEdit',$data);
    }

    public function refreshCaptcha()
    {
        $captcha="";
        $captcha=$captcha.''.captcha_img().'';
       return response()->json(['captcha'=>$captcha]);
//        return response()->json(['captcha'=> captcha_img()]);
    }

    public function saveQuestion(Request $request){
        if(isset($request->id) &&!empty($request->id)){
              $q_info = QuestionModel::where('quserId',Auth::user()->id)->first();
              //dd( $q_info);
                if(empty($q_info)){
                    if (is_null($this->user) ||  !$this->user->can('saveQuestion')) {
                        $message = 'You are not allowed to access this page !';
                        return view('errors.403', compact('message'));
                    }
                }
        }else{
            if (is_null($this->user) ||  !$this->user->can('saveQuestion')) {
                $message = 'You are not allowed to access this page !';
                return view('errors.403', compact('message'));
            }

        }
        //dd($request->all());
        $data = new QuestionModel();
        $validator = \Validator::make($request->all(), [
            'qtitle' => 'required',
            'qcontent' => 'required',
            'qcategoryname' => 'required',
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please Fill All Field')
                ->withInput();
        }
        if(isset($request->id) &&!empty($request->id))
            $data = QuestionModel::find($request->id);
        if($data->quserId==null)
            $data->quserId=Auth::id();
        $data->qtitle=$request->qtitle;
        $data->qcategoryname=$request->qcategoryname;
        $data->qcontent=$request->qcontent;
        if(!empty($request->file('ufile'))){
            $data->ufile= Storage::disk('public')->put('Question/', $request->file('ufile'));
        }
            
        $data->save();
        
        // return redirect('/');
        if(isset($request->id) &&!empty($request->id)){
            return redirect('/')->with('success_message','Successfully Data Updated');

        }else{
            return redirect('/')->with('success_message','Successfully Data Added');

        }
       
        
    }
    public function deleteQuestion(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $q_info = QuestionModel::where('quserId',Auth::user()->id)->first();
            //dd( $q_info);
              if(empty($q_info)){
                  if (is_null($this->user) ||  !$this->user->can('deleteQuestion')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('deleteQuestion')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }
        QuestionModel::find($request->id)->delete();
        return redirect('/');
    }

    public function editQuestion(Request $request){
        if(isset($request->id) &&!empty($request->id)){
            $q_info = QuestionModel::where('quserId',Auth::user()->id)->first();
            //dd( $q_info);
              if(empty($q_info)){
                  if (is_null($this->user) ||  !$this->user->can('editQuestion')) {
                      $message = 'You are not allowed to access this page !';
                      return view('errors.403', compact('message'));
                  }
              }
      }else{
          if (is_null($this->user) ||  !$this->user->can('editQuestion')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

      }


        $data['categories']=Category::all();

        $data['questions'] = QuestionModel::find($request->id);

        return view('question.questionAddEdit',$data);
    }





}
