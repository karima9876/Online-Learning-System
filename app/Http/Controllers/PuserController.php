<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Primaryuser;
use Illuminate\Support\Facades\Auth;

class PuserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    //puser
public function addPuser(){
    if (is_null($this->user) ||  !$this->user->can('addpuser')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    return view('user.addpuser');
}
//----store data----
public function storePuser(Request $request){
    if (is_null($this->user) ||  !$this->user->can('puser.store')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    $request->validate([
        'login_id'=>'required',
        'gmail'=>'required',
        'ctactnumber'=>'required',
        'guarnumber'=>'required',

    ],[
        'login_id.required'=>'please input your Id',
        'gmail.required'=>'please input your gmail',
        'ctactnumber.required'=>'please input your contactnumber',
        'guarnumber.required'=>'please input your guarnumber ',
        
    ]);
    Primaryuser::insert([
        'login_id'=>$request->login_id,
        'gmail'=>$request->gmail,
        'ctactnumber'=>$request->ctactnumber,
        'guarnumber'=>$request->guarnumber,
    ]);
    //  return redirect()->back()->with('success_message','Successfully Data Added');
    
     return redirect()->to('puserlist')->with('success_message','Successfully Data Added');
}
public function puserList(){
    if (is_null($this->user) ||  !$this->user->can('puserlist')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    $pusers = Primaryuser::orderBy('id','DESC')->get();  
    return view('user.puserlist',compact('pusers'));
}
//-----------puser edit------
public function puserEdit($id){
    if (is_null($this->user) ||  !$this->user->can('puser.edit')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    $pusers=Primaryuser::findOrFail($id);
    return view('user.puseredit',compact('pusers'));
}
//-----update puser-----
public function updatePuser(Request $request,$id){
    if (is_null($this->user) ||  !$this->user->can('puser.update')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    Primaryuser::findOrFail($id)->update([
        'login_id'=>$request->login_id,
        'gmail'=>$request->login_id,
        'ctactnumber'=>$request->ctactnumber,
        'guarnumber'=>$request->guarnumber,

    ]);

    return redirect()->to('puserlist')->with('success_message','Successfully Data Update');
}
 //----puser destroy-----
 public function deletePuser($id){
    if (is_null($this->user) ||  !$this->user->can('puser.delete')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    Primaryuser::findOrFail($id)->delete();
    return redirect()->back()->with('delete','Successfully Data Deleted');

}
}
