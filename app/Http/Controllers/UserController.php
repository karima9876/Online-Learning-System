<?php

namespace App\Http\Controllers;
use Image;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function addUser(){
        if (is_null($this->user) ||  !$this->user->can('adduser')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $roles = DB::table('roles')->get();
        return view('user.adduser', compact('roles'));
    }
    //----store data----
    public function storeUser(Request $request){
        if (is_null($this->user) ||  !$this->user->can('user.store')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $request->validate([
            'student_id'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
            // 'userType'=>'required',
            'name'=>'required',
            'department'=>'required',
            // 'ses'=>'required',
             'iname'=>'required',
            // 'fname'=>'required',
            // 'mname'=>'required',
             'address'=>'required',
             'birth_date'=>'required',
             'cnumber'=>'required',
            // 'guarcontact'=>'required',
             'blood_group'=>'required',
            'photo'=>'required',
            


        ],[
            'student_id.required'=>'please input your student_id',
            'username.required'=>'please input your username',
            'email.required'=>'please input your email',
            'password.required'=>'please input your password',
            // 'userType.required'=>'please input your userType',
            'name.required'=>'please input your name',
            'department.required'=>'please input your department',
            // 'ses.required'=>'please input your ses',
            'iname.required'=>'please input your iname',
            // 'fname.required'=>'please input your fname',
            // 'mname.required'=>'please input your mname',
            'address.required'=>'please input your address',
            'birth_date.required'=>'please input your birth_date',
            'cnumber.required'=>'please input your cnumber',
            // 'guarcontact.required'=>'please input your guarcontact',
            'blood_group.required'=>'please input your blood_group',
            'photo.required'=>'please input your photo',
            

            
        ]);
        $photo=$request->file('photo');
        //   $name_gen=hexdec(uniqid());
        //   $img_ext=strtolower($photo->getClientOriginalExtension());
        //   $img_name=$name_gen.'.'.$img_ext;
        //   $up_location='img/brand/';
        //   $last_img=$up_location.$img_name;
        //  $photo->move($up_location,$img_name);
        $name_gen=hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(300,400)->save('img/brand/'.$name_gen);
        $last_img='img/brand/'.$name_gen;

        // Detach roles and Assign Roles
        //$data->roles()->detach();

       

       User::insert([
            'student_id'=>$request->student_id,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            // 'userType'=>$request->userType,
            'name'=>$request->name,
            'department'=>$request->department,
            'ses'=>$request->ses,
            'iname'=>$request->iname,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'address'=>$request->address,
            'birth_date'=>$request->birth_date,
            'cnumber'=>$request->cnumber,
            'guarcontact'=>$request->guarcontact,
            'blood_group'=>$request->blood_group,
            'photo'=>$last_img,
        ]);
        $data = User::orderBy('id','desc')->first();
    
        if ($request->roles != null) {
           
            foreach ($request->roles as $role) {
                $data->assignRole($role);
            }
        }
      
        
      return redirect()->to('userlist')->with('success_message','Successfully Data Added');
 
    }
    public function userList(){
        if (is_null($this->user) ||  !$this->user->can('userlist')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $users =User::orderBy('id','DESC')->get();  
        return view('user.userlist',compact('users'));
    }
    //edit
    public function userEdit($id){
        if (is_null($this->user) ||  !$this->user->can('user.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $users=User::find($id);
        $roles = DB::table('roles')->get();
        return view('user.useredit',compact('users','roles'));

    }
    //-----update user-----
    public function updateUser(Request $request,$id){
        if (is_null($this->user) ||  !$this->user->can('user.update')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
            
        $photo=$request->file('photo');
         $old_image=$request->old_image;
         if($photo){
            $name_gen=hexdec(uniqid());
            $img_ext=strtolower($photo->getClientOriginalExtension());
            $img_name=$name_gen.'.'.$img_ext;
            $up_location='img/brand/';
            $last_img=$up_location.$img_name;
            $photo->move($up_location,$img_name);
            unlink($old_image);

           
           $data =  User::findOrFail($id);
           $data->roles()->detach();
            if (!empty($request->roles)) {
                foreach ($request->roles as $role) {
                    $data->assignRole($role);
                }
            }
            if(!empty($request->password)){
                User::findOrFail($id)->update([
                    'password'=>bcrypt($request->password),
                ]);
            }

            User::findOrFail($id)->update([
            'student_id'=>$request->student_id,
            'username'=>$request->username,
            'email'=>$request->email,
            'name'=>$request->name,
            'department'=>$request->department,
            'ses'=>$request->ses,
            'iname'=>$request->iname,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'address'=>$request->address,
            'birth_date'=>$request->birth_date,
            'cnumber'=>$request->cnumber,
            'guarcontact'=>$request->guarcontact,
            'blood_group'=>$request->blood_group,
            'photo'=>$last_img,

        ]);
        
          return redirect()->to('userlist')->with('success_message','Successfully Data Update');
        

    }else{

    $data =  User::findOrFail($id);
        $data->roles()->detach();
        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $data->assignRole($role);
            }
     }
     if(!empty($request->password)){
        User::findOrFail($id)->update([
            'password'=>bcrypt($request->password),
        ]);
    }
    User::findOrFail($id)->update([
        'student_id'=>$request->student_id,
            'username'=>$request->username,
            'email'=>$request->email,
            'name'=>$request->name,
            'department'=>$request->department,
            'ses'=>$request->ses,
            'iname'=>$request->iname,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'address'=>$request->address,
            'birth_date'=>$request->birth_date,
            'cnumber'=>$request->cnumber,
            'guarcontact'=>$request->guarcontact,
            'blood_group'=>$request->blood_group,  

    ]);
    
     return redirect()->to('userlist')->with('success_message','Successfully Data Update');
 }
}
//userDelete
public function deleteUser($id){
    if (is_null($this->user) ||  !$this->user->can('user.delete')) {
        $message = 'You are not allowed to access this page !';
        return view('errors.403', compact('message'));
   }
    $img=User::find($id);
    $old_Image=$img->photo;
    unlink($old_Image);
    User::find($id)->delete();
    return Redirect()->back()->with('delete','User Deleted Successfully');
}



}
