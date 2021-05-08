<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Student_D extends Controller
{

    public function index($id)
    {
        $user=User::where('user_id',$id)->first();
        return redirect('/student')->with(['users'=>$user]);
        // return view('pages/student/studentdashboard')->with(['user'=>$user]);
    }
    public function oR($id){
        $user=User::where('user_id',$id)->first();
        // return redirect('/student',['users'=>$user]);
        return redirect('/overallReport')->with(['users'=>$user]);
    }
    public function showOR(){
        $user=Session::get('users');
        return view('pages/student/overallReport')->with(['user'=>$user]);
    }
    public function showH(){
        $user=Session::get('users');
        return view('pages/student/studentdashboard')->with(['user'=>$user]);
    }

}
