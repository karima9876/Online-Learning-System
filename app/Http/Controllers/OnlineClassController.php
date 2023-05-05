<?php

namespace App\Http\Controllers;

use App\category;
use App\ZoomCredential;
use App\ZoomOnlineClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;

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
        $topic = $request->topic;

        $data = new ZoomOnlineClass();
        $data->host_user_id = Auth::id();
        $data->topic = $topic;
        $data->start_time = $start_time;
        $data->duration = $duration;
        $data->category_id = $category_id;
        $data->course_code = $request->course_code;
        $data->course_title = $course_title;
        $data->year_session = $request->year_session;

        $zoom_credential = ZoomCredential::where('host_user_id', Auth::id())->first();
        if(!empty($zoom_credential)){
            //$_ENV['ZOOM_CLIENT_KEY'] = $zoom_credential->zoom_api_key;
            //$_ENV['ZOOM_CLIENT_SECRET'] = $zoom_credential->zoom_api_secret;
            config([
                'zoom.api_key' => $zoom_credential->zoom_api_key,
                'zoom.api_secret' => $zoom_credential->zoom_api_secret,
            ]);

            $user = Zoom::user()->first();

            $meeting = Zoom::meeting()->make([
                'topic' => $topic,
                'type' => 8,
                'start_time' => $start_time,
                'duration' => $duration,
            ]);

            $meeting->recurrence()->make([
                'type' => 2,
                'repeat_interval' => 1,
                'weekly_days' => "2",
                'end_times' => 1
            ]);

            $meeting->settings()->make([
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'approval_type' => 1,
                'registration_type' => 2,
                'enforce_login' => false,
                'waiting_room' => true,
            ]);

            $response = $user->meetings()->save($meeting);
            //$response = $user->meetings()->first();
            if(!empty($response)){
                 $data->join_url = $response->join_url;
                 $data->meeting_id = $response->id;
                 $data->meeting_password = $response->password;
            }
        }

        $data->save();

        return redirect()->to('list-online-class')->with('success_message','Successfully Online Zoom Class Added');

    }
    //-----------online class edit------
    public function editOnlineClass($id){
        if (is_null($this->user) ||  !$this->user->can('edit-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $categories= DB::table('categories')
            ->select('id','categoryname')
            ->get();
        $category=ZoomOnlineClass::findOrFail($id);
        return view('zoom_online_class.editonline',compact('category','categories'));
    }
    //-----update online class-----
    public function updateOnlineClass(Request $request, $id){
        if (is_null($this->user) ||  !$this->user->can('update-online-class')) {
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
        $category_id = $request->course_title;
        $course_title  = Category::where('id', $category_id)->first()->categoryname;
        $topic = $request->topic;
        $data = ZoomOnlineClass::find($id);
        $data->topic = $topic;
        $data->start_time = $start_time;
        $data->duration = $duration;
        $data->category_id = $category_id;
        $data->course_code = $request->course_code;
        $data->course_title = $course_title;
        $data->year_session = $request->year_session;
        if(!empty($data)){
            $zoom_credential = ZoomCredential::where('host_user_id', Auth::id())->first();
            if(!empty($zoom_credential)){
                config([
                    'zoom.api_key' => $zoom_credential->zoom_api_key,
                    'zoom.api_secret' => $zoom_credential->zoom_api_secret,
                ]);
                $user = Zoom::user()->first();
                if(!empty($user->meetings()->find($data->meeting_id))){
                    $user->meetings()->find($data->meeting_id)->update([
                        'topic' => $topic,
                        'type' => 2,
                        'start_time' => $start_time,
                        'duration' => $duration,
                    ]);
                }
            }
        }
        $data->save();
        return redirect('list-online-class')->with('update','Successfully Data Update');
    }

    public function listOnlineClass(){

        $zoom_online_class =ZoomOnlineClass::orderBy('id','DESC')->with('user')->get();
        return view('zoom_online_class.list-online-class',compact('zoom_online_class'));
    }
    //----online class destroy-----
    public function deleteOnlineClass($id){
        if (is_null($this->user) ||  !$this->user->can('delete-online-class')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $meeting_info = ZoomOnlineClass::find($id);
        if(!empty($meeting_info)){
            $zoom_credential = ZoomCredential::where('host_user_id', Auth::id())->first();
            if(!empty($zoom_credential)){
                config([
                    'zoom.api_key' => $zoom_credential->zoom_api_key,
                    'zoom.api_secret' => $zoom_credential->zoom_api_secret,
                ]);
                $user = Zoom::user()->first();
                if(!empty($user->meetings()->find($meeting_info->meeting_id))){
                    $user->meetings()->find($meeting_info->meeting_id)->delete();
                }
            }
        }
        ZoomOnlineClass::findOrFail($id)->delete();
        return redirect()->back()->with('delete','Successfully Data Deleted');

    }

}
