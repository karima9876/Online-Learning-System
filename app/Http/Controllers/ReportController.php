<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\questionReport;
use App\answerReport;
use Illuminate\Support\Facades\Auth;
use App\QuestionModel;
use App\AnswerModel;
use App\User;
use Spatie\Permission\Models\Role;

class ReportController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function saveReport_Question(Request $request){
         if (is_null($this->user) ||  !$this->user->can('reportQuestion')) {
             $message = 'You are not allowed to access this page !';
             return view('errors.403', compact('message'));
        }
        //dd($request->all());
        $data = new questionReport();
        $validator = \Validator::make($request->all(), [
            'question_id_report' => 'required',
            'report_cause' => 'required',
            
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please Fill All Field')
                ->withInput();
        }
       
        $reported_by=Auth::id();
        $question_id=$request->question_id_report;
        $question_info = QuestionModel::find($question_id);
        $reported_to = $question_info->quserId;
        //dd( $reported_by);
        

        questionReport::insert([
            'reported_by'=>$reported_by,
            'reported_to'=>$reported_to,
            'reported_qid'=>$question_id,
            'reported_cause'=>$request->report_cause,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
           
        ]);
        return redirect()->back()->with('success_message','Successfully Reported');
        
       
            
         
       
    }
    //answer report
    public function saveReport_Answer(Request $request){
         if (is_null($this->user) ||  !$this->user->can('reportAnswer')) {
             $message = 'You are not allowed to access this page !';
             return view('errors.403', compact('message'));
         }
        //dd($request->all());
        $data = new answerReport();
        $validator = \Validator::make($request->all(), [
            'answer_id_report' => 'required',
            'report_cause' => 'required',
            
           
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please Fill All Field')
                ->withInput();
        }
       
        $reported_by=Auth::id();
        $answer_id=$request->answer_id_report;
        $answer_info = AnswerModel::find($answer_id);
        $reported_to = $answer_info->auserId;
        //dd( $reported_by);
        

        answerReport::insert([
            'reported_by'=>$reported_by,
            'reported_to'=>$reported_to,
            'reported_aid'=>$answer_id,
            'reported_cause'=>$request->report_cause,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
           
        ]);
        return redirect()->back()->with('success_message','Successfully Reported');
        
        // return redirect()->to('categoryList')->with('success_message','Successfully Data Added');  
    }
    //reportList
    
    public function question_reportList(){
        if (is_null($this->user) ||  !$this->user->can('question_reportList')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $question_report_lists =questionReport::orderBy('question_reports.id','DESC')
        ->leftjoin('users as reports_by_user','reports_by_user.id', 'question_reports.reported_by')
        ->leftjoin('users as reports_to_user','reports_to_user.id', 'question_reports.reported_to')
        ->leftjoin('question_models','question_models.id', 'question_reports.reported_qid')
        ->select('*','question_reports.id', 'reports_by_user.username as reported_by_username', 'reports_to_user.id as reported_to_id','reports_to_user.username as reported_to_username', 'question_reports.created_at as created_at', 'question_models.qcontent as content')
        ->get();  
        return view('report.question_report_list',compact('question_report_lists'));
    }
    //question_reportList delete
    public function delete_question_reportList(Request $request,$id){
        if (is_null($this->user) ||  !$this->user->can('delete_question_reportList')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        questionReport::find($request->id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');
    }
    //answer_reportList
    public function answer_reportList(){
        if (is_null($this->user) ||  !$this->user->can('answer_reportList')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $answer_report_lists =answerReport::orderBy('answer_reports.id','DESC')
        ->leftjoin('users as reports_by_user','reports_by_user.id', 'answer_reports.reported_by')
        ->leftjoin('users as reports_to_user','reports_to_user.id', 'answer_reports.reported_to')
        ->leftjoin('answer_models','answer_models.id', 'answer_reports.reported_aid')
        ->select('*','answer_reports.id', 'reports_by_user.username as reported_by_username', 'reports_to_user.id as reported_to_id','reports_to_user.username as reported_to_username', 'answer_reports.created_at as created_at', 'answer_models.acontent as content')
        ->get();  
        
        
        return view('report.answer_report_list',compact('answer_report_lists'));
        
    }
    //answer_reportList delete
    public function delete_answer_reportList($id){
        if (is_null($this->user) ||  !$this->user->can('delete_answer_reportList')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        answerReport::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }
    public function blockUser($id){
        if (is_null($this->user) ||  !$this->user->can('blockUser')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $data = User::find($id);
        $data->roles()->detach();
        $roles = ['5'];
        if (!empty($roles)) {
            foreach ($roles as $role) {
                $data->assignRole($role);
            }
        }
        return redirect()->back()->with('success_message','Successfully User Blocked.');
    }
    public function unblockUser($id){
        if (is_null($this->user) ||  !$this->user->can('unblockUser')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }


        $data = User::find($id);
        $data->roles()->detach();
        $roles = ['4'];
        if (!empty($roles)) {
            foreach ($roles as $role) {
                $data->assignRole($role);
            }
        }
        return redirect()->back()->with('success_message','Successfully User Unblocked.');
    }

}