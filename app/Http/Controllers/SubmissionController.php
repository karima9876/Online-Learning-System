<?php

namespace App\Http\Controllers;
use App\category;
use Carbon\Carbon;
use App\AssignmentSubmission;
use App\AssignmentCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function uploadAssignment($assignment_id){
      
        if (is_null($this->user) ||  !$this->user->can('upload-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $data['categories'] = DB::table('categories')
            ->select('id','categoryname')
            ->get();
        $data['category']=AssignmentCreate::findOrFail($assignment_id);
        return view('submission.assignmentSubmission', $data);
        
    }
    //----store data----
    public function saveUploadAssignment(Request $request,$assignment_id){
        if (is_null($this->user) ||  !$this->user->can('save-upload-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            // 'description'=>'required',
            'upload_file'=>'required',

        ],[
            // 'description.required'=>'please input your Description',
            'upload_file.required'=>'please input File',
        ]);
        $description = $request->description;
        $data = new AssignmentSubmission();
        $data->user_id = Auth::id();
        $data->assignment_id = $assignment_id;
        $data->description = $description;
        if(!empty($request->file('upload_file'))){
            $data->upload_file= Storage::disk('public')->put('AssignmentUpload/', $request->file('upload_file'));
        }
       
        $data->save();
        return redirect()->to('list-assignment')->with('success_message','Successfully Assignment Submitted');

    }
    public function uploadAssignmentList($assignment_id){
        if (is_null($this->user) ||  !$this->user->can('upload-assignment-list')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $upload_assignment_list=AssignmentSubmission::orderBy('id','DESC')->with('user','assignment')->where('assignment_id', '=',$assignment_id)->get();
        // dd($upload_assignment_list);

        return view('submission.assignmentSubmissionList',compact('upload_assignment_list'));
    }
    //----online class destroy-----
    public function deleteuploadAssignmentList($id){
        if (is_null($this->user) ||  !$this->user->can('upload-assignment-delete')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        AssignmentSubmission::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }

}




