<?php

namespace App\Http\Controllers;
use App\User;
use App\Payment;
use Illuminate\Http\Request;
class DonateController extends Controller
{
    public function studentlist(){
        $users =User::orderBy('id','DESC')->role('student')->get();  
        return view('donate.studentlist',compact('users'));
    }
    public function donate($id){
        $user =User::where('id', $id)->role('student')->first();  
        return view('donate.donate',compact('user'));
    }

    public function donatePayment(Request $request,$id){
        //dd($request->all());
        $data = new Payment();
        $validator = \Validator::make($request->all(),[
            'sender_name'=>'required',
            'sender_address'=>'required',
            'sender_email'=>'required',
            'sender_cnumber'=>'required',
            'amount'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error_message','Unsuccessful,Please Fill All Field')
                ->withInput();
        }
        $user_info = User::where('id',$id)->first();
        $data->sender_name=$request->sender_name;
        $data->sender_address=$request->sender_address;
        $data->sender_email=$request->sender_email;
        $data->sender_cnumber=$request->sender_cnumber;
        $data->amount=$request->amount;
        $data->message_id=$request->message_id;
        $data->txn_id=uniqid();
        if(!empty($request->payment_type) && $request->payment_type=='on')
        {
            $payment_type = 1;
        }
        else{
            $payment_type = 0;   
        }
        $data->payment_type=$payment_type;
        $data->status='Pending';
        $data->user_id=$id;
        $data->student_id=$user_info->student_id;  
        $data->save();
    
      return redirect()->to('')->with('success_message','Successfully Data Added'); 

    }
}
