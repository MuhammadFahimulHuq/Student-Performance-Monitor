<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Faculty_D extends Controller
{

    public function index($id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        return redirect('/faculty')->with(['faculty' => $faculty]);
    }
    public function sR($id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        return redirect('/studentReport')->with(['faculty' => $faculty]);
    }

    public function cR($id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        return redirect('/courseReport')->with(['faculty' => $faculty]);
    }

    public function showcR()
    {
        $faculty = Session::get('faculty');
        return view('pages/faculty/coursereport')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty'
            ]
        );
    }

    public function showsR()
    {
        $faculty = Session::get('faculty');
        return view('pages/faculty/studentreport')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty'
            ]
        );
    }

    public function showH()
    {
        $faculty = Session::get('faculty');
        $card1 = DB::table('faculty_plo')
            ->select(
                DB::raw('DISTINCT courseID'),
                DB::raw('CASE
                WHEN courseID="CSE203+L" THEN 1
                WHEN courseID="CSE204+L" THEN 2
                WHEN courseID="CSE309" THEN 3
                WHEN courseID="CSE307" THEN 4
                WHEN courseID="CSE210+L" THEN 5
                WHEN courseID="CSE214" THEN 6
                WHEN courseID="CSE201" THEN 7
                WHEN courseID="CSE216+L" THEN 8
                WHEN courseID="CSE303+L" THEN 9
                ELSE 0
                END AS id')
            )
            ->where('FemployeeID', $faculty->employeeID)
            ->get();
        $card2 = DB::table('faculty_plo')
            ->select(DB::raw('DISTINCT sectionID'))
            ->where('FemployeeID', $faculty->employeeID)
            ->get();
        $card3 = DB::table('faculty_plo')
            ->where('FemployeeID', $faculty->employeeID)
            ->get();
        $card4 = DB::table('faculty_plo')
            ->select(DB::raw('DISTINCT ploID'))
            ->where('FemployeeID', $faculty->employeeID)
            ->get();
        $p1=DB::table('faculty_co')
            ->select('faculty_co.courseID','coNo',DB::raw('AVG(co_percentage) as success'))
            ->join('cos','cos.coID','=','faculty_co.coID')
            ->where('FemployeeID', $faculty->employeeID)
            ->groupBy('faculty_co.courseID','faculty_co.coID','coNo')
            ->get();
        $p2=DB::table('faculty_plo')
            ->select('faculty_plo.courseID','ploNo',DB::raw('AVG(co_percentage) as success'))
            ->join('plos','plos.ploID','=','faculty_plo.ploID')
            ->where('FemployeeID', $faculty->employeeID)
            ->groupBy('faculty_plo.courseID','faculty_plo.ploID','ploNo')
            ->get();
        $arr = array();
        return view('pages/faculty/facultydashboard')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty',
                'c1' => $card1,
                'c2' => $card2,
                'c3' => $card3,
                'c4' => $card4,
                'arr' => $arr,
                'p1'=>$p1,
                'p2'=>$p2
            ]
        );
    }
}
