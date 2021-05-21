<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HigerO_D extends Controller
{
    public function index($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/HigherO')->with(['higherO' => $higherO]);
    }
    public function sR($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/studentReportO')->with(['higherO' => $higherO]);
    }
    public function cR($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/courseReportO')->with(['higherO' => $higherO]);
    }
    public function showcR()
    {
        $higherO = Session::get('higherO');
        // $cID = NULL;
        // $c1 = NULL;
        // $c2 = NULL;
        // $c3 = NULL;
        // $c4 = NULL;
        // $arr = array();
        // if (!empty(Session::get('cID'))) {

        //     $cID = Session::get('cID');
        //     if (DB::table('faculty_co')
        //         ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
        //         ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
        //         ->where('faculty_co.courseID', $cID)
        //         ->where('faculty_co.FemployeeID', $faculty->employeeID)
        //         ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
        //         ->exists()
        //     ) {
        //         $c1 = DB::table('faculty_co')
        //             ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
        //             ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
        //             ->where('faculty_co.courseID', $cID)
        //             ->where('faculty_co.FemployeeID', $faculty->employeeID)
        //             ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
        //             ->get();
        //     }
        //     $c2 = DB::table('faculty_co')
        //         ->select('faculty_co.courseID', 'coNo', DB::raw('AVG(co_percentage) as success'))
        //         ->join('cos', 'cos.coID', '=', 'faculty_co.coID')
        //         ->where('faculty_co.courseID', $cID)
        //         ->groupBy('faculty_co.courseID', 'faculty_co.coID', 'coNo')
        //         ->get();
        //     if (DB::table('faculty_plo')
        //         ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
        //         ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
        //         ->where('faculty_plo.courseID', $cID)
        //         ->where('FemployeeID', $faculty->employeeID)
        //         ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
        //         ->exists()
        //     ) {
        //         $c3 = DB::table('faculty_plo')
        //             ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
        //             ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
        //             ->where('faculty_plo.courseID', $cID)
        //             ->where('FemployeeID', $faculty->employeeID)
        //             ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
        //             ->get();
        //     }
        //     $c4 = DB::table('faculty_plo')
        //         ->select('faculty_plo.courseID', 'ploNo', DB::raw('AVG(co_percentage) as success'))
        //         ->join('plos', 'plos.ploID', '=', 'faculty_plo.ploID')
        //         ->where('faculty_plo.courseID', $cID)
        //         ->groupBy('faculty_plo.courseID', 'faculty_plo.ploID', 'ploNo')
        //         ->get();
        // }
        // $flag = false;
        return view('pages/higher_official/coursereport')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official'
                // 'c1' => $c1,
                // 'c2' => $c2,
                // 'c3' => $c3,
                // 'c4' => $c4,
                // 'arr' => $arr,
                // 'cID' => $cID,
                // 'flag' => $flag
            ]
        );
    }


    public function hcr(Request $request, $id)
    {
        $faculty = Employee::where('employeeID', $id)->first();
        $isCourse = Course::select("*")->where('courseID', $request->input('tcID'))->exists();
        if ($isCourse) {
            return redirect('/courseReport')->with([
                'higherO' => $faculty,
                'cID' => $request->input('tcID')
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Course', 'faculty' => $faculty]);
        }
    }

    public function hsr(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $isStudent = Student::select("*")->where('studentID', $request->input('tsID'))->exists();
        if ($isStudent) {
            return redirect('/studentReportO')->with([
                'higherO' => $higherO,
                'cID' => $request->input('tsID')
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid StudentID', 'higherO' => $higherO]);
        }
    }

    public function showsR()
    {
        $cID = NULL;
        $arr = array();
        $p1 = NULL;
        $p2 = NULL;
        $courses = NULL;
        if (!empty(Session::get('cID'))) {
            $cID = Session::get('cID');
            $courses = DB::table('course_plo_percentage')
                ->select(
                    'courseID',
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
                WHEN courseID="ACN201" THEN 10
                WHEN courseID="ACN202" THEN 11
                WHEN courseID="ACN301" THEN 12
                WHEN courseID="ACN305" THEN 13
                WHEN courseID="MIS340" THEN 14
                WHEN courseID="MIS341" THEN 15
                ELSE 0
                END AS id')
                )
                ->where('studentID', $cID)
                ->groupBy('courseID')
                ->get();
            $p1 = DB::table('view_student_co')
                ->join('cos', 'view_student_co.coID', '=', 'cos.coID')
                ->select('studentID', 'courseID', 'cos.coNo', 'co_percentage')
                ->where('studentID', $cID)
                ->get();
            $p2 = DB::table('course_plo_percentage')
                ->where('studentID', $cID)
                ->join('plos', 'plos.ploID', '=', 'course_plo_percentage.ploID')
                ->get();
        }
        $higherO = Session::get('higherO');
        return view('pages/higher_official/studentreport')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'arr' => $arr,
                'p1' => $p1,
                'p2' => $p2,
                'cID' => $cID,
                'courses' => $courses
            ]
        );
    }

    public function showH()
    {
        $enrollment = DB::table('students')
            ->join('programs', 'programs.programID', '=', 'students.programID')
            ->select('programs.programID', 'programs.departmentID', 'students.admissionDate', DB::raw('COUNT(students.studentID) AS amount'))
            ->GroupBy('programs.departmentID', 'programs.programID', 'students.admissionDate')
            ->OrderBy('students.admissionDate')
            ->get();
        $programs= DB::table('students')
        ->join('programs', 'programs.programID', '=', 'students.programID')
        ->select('programs.programID')
        ->GroupBy('programs.programID')
        ->get();
        $departments= DB::table('students')
        ->join('programs', 'programs.programID', '=', 'students.programID')
        ->select('programs.departmentID')
        ->GroupBy('programs.departmentID')
        ->get();
        $higherO = Session::get('higherO');
        return view('pages/higher_official/higherOdashboard')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'departments' =>$departments
            ]
        );
    }
}
