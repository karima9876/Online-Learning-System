<?php

namespace App\Http\Controllers;
use App\category;
use App\AssignmentCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function addAssignment(){
        if (is_null($this->user) ||  !$this->user->can('add-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $data['categories'] = DB::table('categories')
            ->select('id','categoryname')
            ->get();
        return view('assignment.addassignment', $data);
    }
    //----store data----
    public function saveAssignment(Request $request){
        if (is_null($this->user) ||  !$this->user->can('save-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'topic'=>'required',
            'description'=>'required',
            'course_code'=>'required',
            'course_title'=>'required',
            'year_session'=>'required',
            'end_time'=>'required',

        ],[
            'topic.required'=>'please input your topic',
            'description.required'=>'please input your Description',
            'course_code.required'=>'please input Course Code',
            'course_title.required'=>'please input your Course Title',
            'year_session.required'=>'please input your Session',
            'end_time.required'=>'please input your End Time',
        ]);

        $end_time = date("Y-m-d H:i:s", strtotime($request->end_time));
        $category_id = $request->course_title;
        $course_title  = Category::where('id', $category_id)->first()->categoryname;
        $topic = $request->topic;
        $description = $request->description;
        

        $data = new AssignmentCreate();
        $data->user_id = Auth::id();
        $data->topic = $topic;
        $data->description = $description;
        $data->category_id = $category_id;
        $data->course_code = $request->course_code;
        $data->course_title = $course_title;
        $data->year_session = $request->year_session;
        $data->end_time = $end_time;

        $data->save();

        return redirect()->to('list-assignment')->with('success_message','Successfully New Assignment Created');

    }
    public function listAssignment(){
        if (is_null($this->user) ||  !$this->user->can('list-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $assignment_create =AssignmentCreate::orderBy('id','DESC')->get();
        return view('assignment.list-assignment',compact('assignment_create'));
    }
    //-----------online class edit------
    public function editAssignment($id){
        if (is_null($this->user) ||  !$this->user->can('edit-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $categories= DB::table('categories')
            ->select('id','categoryname')
            ->get();
        $category=AssignmentCreate::findOrFail($id);
        return view('assignment.editassignment',compact('category','categories'));
    }
    //-----update online class-----
    public function updateAssignment(Request $request, $id){
        if (is_null($this->user) ||  !$this->user->can('update-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'topic'=>'required',
            // 'description'=>'required',
            'course_code'=>'required',
            'course_title'=>'required',
            'year_session'=>'required',
            'end_time'=>'required',

        ],[
            'topic.required'=>'please input your topic',
            // 'description.required'=>'please input your Description',
            'course_code.required'=>'please input Course Code',
            'course_title.required'=>'please input your Course Title',
            'year_session.required'=>'please input your Session',
            'end_time.required'=>'please input your End Time',
        ]);
        $end_time = date("Y-m-d H:i:s", strtotime($request->end_time));
        $category_id = $request->course_title;
        $course_title  = Category::where('id', $category_id)->first()->categoryname;
        $topic = $request->topic;
        $description = $request->description;
        $data = AssignmentCreate::find($id);
        $data->topic = $topic;
        $data->description = $description;
        $data->category_id = $category_id;
        $data->course_code = $request->course_code;
        $data->course_title = $course_title;
        $data->year_session = $request->year_session;
        $data->end_time = $end_time;

        $data->save();
        return redirect('list-assignment')->with('update','Successfully Data Update');
    }

    //----online class destroy-----
    public function deleteAssignment($id){
        if (is_null($this->user) ||  !$this->user->can('delete-assignment')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        AssignmentCreate::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }

}
