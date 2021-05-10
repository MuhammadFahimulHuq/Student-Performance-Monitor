<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\ViewStudentCo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Student_D extends Controller
{

    public function index($id)
    {
        $student=Student::where('studentID',$id)->first();
        return redirect('/student')->with(['student'=>$student]);
        // return view('pages/student/studentdashboard')->with(['user'=>$user]);
    }
    public function oR($id){
        $student=Student::where('studentID',$id)->first();
        return redirect('/overallReport')->with(['student'=>$student]);
    }
    public function showOR(){
        $student=Session::get('student');
        return view('pages/student/overallReport')->with(
                                                        ['student'=>$student,
                                                        'username'=>$student->firstname,
                                                        'userType'=>'student']);
    }
    public function showH(){
        $student=Session::get('student');
        $cards=DB::table('view_student_plo')->where('studentID',$student->studentID)->get();
        $Lowest=DB::table('view_student_plo')->where('studentID',$student->studentID)->where('plo_percentage',$cards->min('plo_percentage'))->first();
        return view('pages/student/studentdashboard')->with(
                                                        ['student'=>$student,
                                                        'username'=>$student->firstname,
                                                        'userType'=>'student',
                                                        'cards'=>$cards,
                                                        'lowest'=>$Lowest]);
    }

}
