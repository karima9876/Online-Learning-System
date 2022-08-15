<?php

namespace App\Http\Controllers;
use App\MessageModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class MessageController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    
    public function listMessage(Request $request){
          if (is_null($this->user) ||  !$this->user->can('messages')) {
              $message = 'You are not allowed to access this page !';
              return view('errors.403', compact('message'));
          }

        $data['messageId']=$request->id;
        

        $user_id = Session::remember('user', function() {
            return Auth::user();
        });
        
        $data['online'] = User::WhereIn('id',$user_id)->get();
//dd($data);
        $online_users = [];
        foreach ($data['online'] as $key => $online){
            $online_users[] = $data['online'][$key]->id;
        }
        //dd($data);
        if(isset($online_users[0])){
            $data['users'] = User::WhereNotIn('id',$online_users)
                ->orderBy('users.updated_at','DESC')
                ->get();
        }else{
            $data['users'] = DB::table('users')
                
                ->orderBy('users.updated_at','DESC')
                ->get();

        }


        $id = auth()->id();
        $data['usersnot'] = DB::select('
        SELECT t1.*
        FROM message_models AS t1
        INNER JOIN
        (
            SELECT
                LEAST(fuser_id, tuser_id) AS fuser_id,
                GREATEST(fuser_id, tuser_id) AS tuser_id,
                MAX(id) AS max_id
            FROM message_models
            GROUP BY
                LEAST(fuser_id, tuser_id),
                GREATEST(fuser_id, tuser_id)
        ) AS t2
            ON LEAST(t1.fuser_id, t1.tuser_id) = t2.fuser_id AND
               GREATEST(t1.fuser_id, t1.tuser_id) = t2.tuser_id AND
               t1.id = t2.max_id
            WHERE t1.fuser_id = 3 AND t1.tuser_id = 6
            OR t1.fuser_id = 6 AND t1.tuser_id = 3
        ', [$id, $id]);
        //dd($data);
        $messages= DB::table('message_models')
            ->leftjoin('users','users.id','message_models.fuser_id')
            ->orderBy('message_models.updated_at', 'desc')
            ->get(['message_models.fuser_id', 'message_models.chat', 'message_models.updated_at'])
            ->groupBy('message_models.fuser_id'); //this is collections method



      

        $data['messageShow'] = DB::table('message_models')->where([
            ['message_models.fuser_id', '=', Auth::id()],
            ['message_models.tuser_id', '=', $request->id],
        ])
            ->orWhere([
                ['message_models.fuser_id', '=', $request->id],
                ['message_models.tuser_id', '=', Auth::id()],
            ])
            ->orderBy('message_models.id','ASC')
            ->get();
      



        return view('message.messageAddSave',$data);
    }


    public function messageSaved(Request $request, $messageId)
    {
        if (is_null($this->user) ||  !$this->user->can('mSave')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        //dd($request->all());
        $data = new MessageModel();


        $data->fuser_id = Auth::id();
        $data->tuser_id = $messageId;
        $data->chat = $request->chat;

        $data->save();

        //dd($data);
        return redirect()->back();

    }



    public function messSelectListSearch(Request $request)
    {
        if (is_null($this->user) ||  !$this->user->can('messSL')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }


        $data['messageId']=$request->id;
        //dd($data);

        $user_id = '';
        if(Auth::user()) {
            $user_id = Cache::get('users');
        }
        //dd($request->all());
        $search = $request->searchMP;
       
        if (empty($search))
            $data['users']=null;

        $user_id = explode(',',$user_id);
        //dd($user_id);
        $data['online'] = User::WhereIn('id',$user_id)->get();

        $online_users = [];
        foreach ($data['online'] as $key => $online){
            $online_users[] = $data['online'][$key]->id;
        }
        //dd($data);
        if(isset($online_users[0])){
            $data['users'] = User::WhereNotIn('id',$online_users)->get();
        }else{
            $data['users'] = DB::table('users')
                ->orderBy('users.id','DESC')
                ->orwhere('users.username', 'like binary', '%' . $search . '%')
                ->orwhere('users.updated_at', 'like binary', '%' . $search . '%')
                ->get();
            //User::get();
        }



        if (isset($search) && !empty($search)) {
            $data['users'] = DB::table('users')
                ->orderBy('users.id','DESC')
                ->orwhere('users.username', 'like binary', '%' . $search . '%')
                ->orwhere('users.updated_at', 'like binary', '%' . $search . '%')
                ->get();
        }
        $data['messageShow'] = DB::table('message_models')->where([
            ['message_models.fuser_id', '=', Auth::id()],
            ['message_models.tuser_id', '=', $request->id],
        ])
            ->orWhere([
                ['message_models.fuser_id', '=', $request->id],
                ['message_models.tuser_id', '=', Auth::id()],
            ])
            ->get();

        //dd($data);

        return view('message.messageAddSave',$data);
    }
}
