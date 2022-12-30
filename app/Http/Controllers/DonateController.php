<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
class DonateController extends Controller
{
    public function studentlist(){
        $users =User::orderBy('id','DESC')->role('student')->get();  
        return view('donate.studentlist',compact('users'));
    }
    public function donate(){
        $users =User::orderBy('id','DESC')->role('student')->get();  
        return view('donate.donate',compact('users'));
    }
}
