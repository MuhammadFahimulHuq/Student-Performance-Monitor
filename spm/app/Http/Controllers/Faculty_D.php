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

    public function hsr(Request $request, $id) //help student report
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


    public function hsg(Request $request, $id) //help student grade
    {
        $faculty = Employee::where('employeeID', $id)->first();
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate) {
            return redirect('/faculty')->with([
                'faculty' => $faculty,
                'startDate' => $startDate,
                'endDate' => $endtDate
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range', 'faculty' => $faculty]);
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
    public function showsR() //student report
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
                WHEN courseID="ACN302" THEN 16
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
        $faculty = Session::get('faculty');
        return view('pages/faculty/studentreport')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty',
                'arr' => $arr,
                'p1' => $p1,
                'p2' => $p2,
                'cID' => $cID,
                'courses' => $courses
            ]
        );
    }

    public function showH() //homepage
    {
        $faculty = Session::get('faculty');
        $startDate = NULL;
        $endtDate = NULL;
        $garray = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $data =
                DB::table('v_transcript')
                ->join('sections', 'sections.sectionID', '=', 'v_transcript.sectionID')
                ->join('semesters', 'semesters.semesterID', '=', 'sections.semesterID')
                ->select('semesterName', DB::raw('AVG(gradePoint) as gp'))
                ->where('FemployeeID', $faculty->employeeID)
                ->whereRaw('semesters.semesterID >= ? AND semesters.semesterID <= ?', [$startDate, $endDate])
                ->groupBy('courseID', 'startDate', 'semesters.semesterName')
                ->get();
            foreach ($data as $d)
                array_push($garray, [$d->semesterName, (float)$d->gp]);
        }
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
                WHEN courseID="ACN201" THEN 10
                WHEN courseID="ACN202" THEN 11
                WHEN courseID="ACN301" THEN 12
                WHEN courseID="ACN305" THEN 13
                WHEN courseID="MIS340" THEN 14
                WHEN courseID="MIS341" THEN 15
                WHEN courseID="ACN302" THEN 16
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
                'p2' => $p2,
                'startDate'=>$startDate,
                'garray' =>$garray
            ]
        );
    }
}
