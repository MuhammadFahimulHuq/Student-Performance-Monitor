<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Student_D extends Controller
{

    public function index($id)
    {
        $user=User::where('user_id',$id)->get();
        return view('pages/student/studentdashboard')->with(['users'=>$user]);
    }
    public function oR($id){
        $user=User::where('user_id',$id)->get();
        // return redirect('/student',['users'=>$user]);
        return redirect('/student')->with(['users'=>$user]);
        return view('pages/student/overallReport')->with(['users'=>$user]);
    }

}
