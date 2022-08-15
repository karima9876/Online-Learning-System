<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Primaryuser;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    protected function validator(array $data)
    {
      //  dd($data);
        return Validator::make($data, [     
             
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
       
      
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        
        try {
            
            $user = Socialite::driver('google')->user();
           

//condition
            $primary_user = Primaryuser::where('gmail', $user->email)->first();
            if(empty($primary_user)){
                return redirect('login')->with('error_message','You have no permission for google login');
            }
                 
           
       
            $finduser = User::where('student_id', $user->id)->orwhere('email', $user->email)->first();
            // dd($finduser);
            
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/');
       
            }else{
                //dd($user->avatar);
                
                $newUser = User::create([
                    'username' => $user->name,
                    'name' => $user->name,
                    'email' => $user->email,
                    'student_id'=> $user->id,
                    'password' => encrypt('12345678'),
                    'photo' => $user->avatar,
                    

                ]);
                
               
                $data = User::orderBy('id','desc')->first();
                
                $roles = ['4'];
    
                if ($roles != null) {
                
                    foreach ($roles as $role) {
                        $data->assignRole($role);
                    }
                }
      
                Auth::login($newUser);
               
                return redirect()->intended('/');
            }
      
        } catch (Exception $e) {
            //dd($e->getMessage());
        }
    }
}