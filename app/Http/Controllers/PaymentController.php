<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\User;
use Auth;

class PaymentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function paymentlist(){
        //$paymentlist = Payment::orderBy('id','DESC')->whereIn('status', ['Processing', 'Complete'])->get();
        if (is_null($this->user) ||  !$this->user->can('paymentlist')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        if($this->user->hasRole('superadmin') || $this->user->hasRole('chairman') || $this->user->hasRole('teacher')){
            $paymentlist = Payment::orderBy('id','DESC')->with('user')->get();
        }else{
            $paymentlist = Payment::orderBy('id','DESC')->where('user_id', $this->user->id)->with('user')->get();
        }
        
        return view('payment.paymentlist',compact('paymentlist'));
    }
}
