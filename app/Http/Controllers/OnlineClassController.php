<?php

namespace App\Http\Controllers;

use App\category;
use App\ZoomOnlineClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnlineClassController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function addOnlineClass(){
        if (is_null($this->user) ||  !$this->user->can('add-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $data['categories'] = DB::table('categories')
            ->select('id','categoryname')
            ->get();
        return view('zoom_online_class.addzoomclass', $data);
    }
    //----store data----
    public function saveOnlineClass(Request $request){
        if (is_null($this->user) ||  !$this->user->can('save-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'topic'=>'required',
            'start_time'=>'required',
            'duration'=>'required',
            'course_code'=>'required',
            'course_title'=>'required',
            'year_session'=>'required',

        ],[
            'topic.required'=>'please input your topic',
            'start_time.required'=>'please input your Start Time',
            'duration.required'=>'please input your Duration',
            'course_code.required'=>'please input Course Code',
            'course_title.required'=>'please input your Course Title',
            'year_session.required'=>'please input your Session',
        ]);
        
        $duration = $request->duration;
        $start_time = date("Y-m-d H:i:s", strtotime($request->start_time));
        $time = Carbon::parse($request->start_time);
        $end_time = $time->addMinutes($duration);
        $end_time = date("Y-m-d H:i:s", strtotime($end_time));
     
        $category_id = $request->course_title;
        $course_title  = Category::where('id', $category_id)->first()->categoryname;
        
        $data = new ZoomOnlineClass();
        $data->host_user_id = Auth::id();
        $data->topic = $request->topic;
        $data->start_time = $start_time;
        $data->duration = $duration;
        $data->category_id = $category_id;
        $data->course_code = $request->course_code;
        $data->course_title = $course_title;
        $data->year_session = $request->year_session;
        $data->save();

        return redirect()->to('list-online-class')->with('success_message','Successfully Online Zoom Class Added');
 
    }
    //-----------online class edit------
    public function editOnlineClass($id){
        if (is_null($this->user) ||  !$this->user->can('edit-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $category=ZoomOnlineClass::findOrFail($id);
        return view('zoom_online_class.editonline',compact('category'));
    }
    //-----update online class-----
    public function updateOnlineClass(Request $request,$id){
        if (is_null($this->user) ||  !$this->user->can('update-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        ZoomOnlineClass::findOrFail($id)->update([
            'categoryname'=>$request->categoryname,

        ]);

        return redirect()->route('categoryList')->with('update','Successfully Data Update');
        
        // return redirect()->to('categoryList')->with('update','Successfully Data Update');
        return redirect()->back()->with('update','Successfully Data Updated');
        

    }

    public function listOnlineClass(){

        $zoom_online_class =ZoomOnlineClass::orderBy('id','DESC')->get();  
        return view('zoom_online_class.list-online-class',compact('zoom_online_class'));
    }
    //----online class destroy-----
    public function deleteOnlineClass($id){
        if (is_null($this->user) ||  !$this->user->can('delete-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        ZoomOnlineClass::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }

}
