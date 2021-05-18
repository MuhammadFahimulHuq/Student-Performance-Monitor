<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Employee;
use App\Models\Student;
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
        $cID = NULL;
        $c1 = NULL;
        $c2 = NULL;
        $c3 = NULL;
        $c4 = NULL;
        $arr = array();
        if (!empty(Session::get('cID'))) {

            $cID = Session::get('cID');
            if (DB::table('faculty_co')
                ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
                ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
                ->where('faculty_co.courseID', $cID)
                ->where('faculty_co.FemployeeID', $faculty->employeeID)
                ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
                ->exists()
            ) {
                $c1 = DB::table('faculty_co')
                    ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
                    ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
                    ->where('faculty_co.courseID', $cID)
                    ->where('faculty_co.FemployeeID', $faculty->employeeID)
                    ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
                    ->get();
            }
            $c2 = DB::table('faculty_co')
                ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
                ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
                ->where('faculty_co.courseID', $cID)
                ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
                ->get();
            if (DB::table('faculty_plo')
                ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
                ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
                ->where('faculty_plo.courseID', $cID)
                ->where('FemployeeID', $faculty->employeeID)
                ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
                ->exists()
            ) {
                $c3 = DB::table('faculty_plo')
                    ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
                    ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
                    ->where('faculty_plo.courseID', $cID)
                    ->where('FemployeeID', $faculty->employeeID)
                    ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
                    ->get();
            }
            $c4 = DB::table('faculty_plo')
                ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
                ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
                ->where('faculty_plo.courseID', $cID)
                ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
                ->get();
        }
        $flag = false;
        return view('pages/faculty/coursereport')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty',
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3,
                'c4' => $c4,
                'arr' => $arr,
                'cID' => $cID,
                'flag' => $flag
            ]
        );
    }

    public function hsr(Request $request, $id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        $isStudent = Student::select("*")->where('studentID', $request->input('tsID'))->exists();
        if ($isStudent) {
            return redirect('/studentReport')->with([
                'faculty' => $faculty,
                'cID' => $request->input('tsID')
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid StudentID', 'faculty' => $faculty]);
        }
    }

    public function hcr(Request $request, $id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        $isCourse = Course::select("*")->where('courseID', $request->input('tcID'))->exists();
        if ($isCourse) {
            return redirect('/courseReport')->with([
                'faculty' => $faculty,
                'cID' => $request->input('tcID')
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Course', 'faculty' => $faculty]);
        }
    }
    public function showsR()
    {
        $cID = NULL;
        if (!empty(Session::get('cID'))) {
            $cID = Session::get('cID');
        }
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
        $p1 = DB::table('faculty_co')
            ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
            ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
            ->where('FemployeeID', $faculty->employeeID)
            ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
            ->get();
        $p2 = DB::table('faculty_plo')
            ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
            ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
            ->where('FemployeeID', $faculty->employeeID)
            ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
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
                'p1' => $p1,
                'p2' => $p2
            ]
        );
    }
}
