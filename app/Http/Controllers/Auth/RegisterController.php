<?php

namespace App\Http\Controllers\Auth;
use Image;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      //  dd($data);
        return Validator::make($data, [
             'student_id' => 'exists:primaryusers,login_id|required|string|max:25|unique:users',
             'email' => 'exists:primaryusers,gmail|required|string|email|max:255|unique:users',
             'guarcontact' => 'exists:primaryusers,guarnumber',
             'cnumber' => 'exists:primaryusers,ctactnumber',
            // 'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:10|unique:users',
            'student_id' => 'required|string|max:25|unique:users',
            'password' => 'required|string|min:8|confirmed',
 
             'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
 //            'picture' => 'required|regex:/^data:image/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $photo=$data['photo'];
        
        $name_gen=hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(300,400)->save('img/brand/'.$name_gen);
        $last_img='img/brand/'.$name_gen;
  

         $return = User::create([
            'student_id' => $data['student_id'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            // 'userType' => 0,
            'name' => $data['name'],
            'department' => $data['department'],
            'ses' => $data['ses'],
            'iname' => $data['iname'],
            // 'fname' => $data['fname'],
            // 'mname' => $data['mname'],
            'address' => $data['address'],
            'birth_date' => $data['birth_date'],
            'cnumber' => $data['cnumber'],
            'guarcontact' => $data['guarcontact'],
            'blood_group' => $data['blood_group'],
            'photo' => $last_img,
            
        ]);


        $data = User::orderBy('id','desc')->first();
        $roles = ['4'];
    
        if ($roles != null) {
           
            foreach ($roles as $role) {
                $data->assignRole($role);
            }
        }

        return $return;



        
    }
    
              






}
