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
    public function sE($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/schoolEnrollment')->with(['higherO' => $higherO]);
    }
    public function dE($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/departmentEnrollment')->with(['higherO' => $higherO]);
    }
    public function pE($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/programEnrollment')->with(['higherO' => $higherO]);
    }
    public function showcR()
    {
        $higherO = Session::get('higherO');
        $faculty = NULL;
        $startDate = NULL;
        $endtDate = NULL;
        $courseID = NULL;
        $p1 = NULL;
        $p2 = NULL;
        $c1 = array();
        $c2 = array();
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $courseID = (string)Session::get('courseID');

            DB::statement("DROP VIEW IF EXISTS temp1");
            DB::statement("DROP VIEW IF EXISTS temp2");

            DB::statement("CREATE VIEW temp1 AS
            SELECT FemployeeID,courseID,coNo,AVG(mo/mg*100) co_percentage
            FROM (SELECT s.studentID,FemployeeID,c.courseID,c.coNo,SUM(marksObtained) mo,SUM(marksObtainable) mg
            from students s, marksDisseminations m, assessments a,cos c,comappings cm,plos p,assessmentTypes ta,sections st
            WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID AND ta.assessmentTypeID=a.assessmentTypeID
            AND st.sectionID=ta.sectionID AND p.ploID=cm.ploID AND c.coID = cm.coID
            AND (c.courseID='$courseID' AND st.semesterID>=$startDate AND st.semesterID<=$endDate)
            GROUP by FemployeeID,s.studentID,c.courseID,st.sectionID,c.coID,c.coNo) VT
            GROUP By FemployeeID,courseID,coNo;");
            DB::statement("CREATE VIEW temp2 AS
            SELECT FemployeeID,courseID,ploNo,AVG(mo/mg*100) plo_percentage
            FROM(SELECT s.studentID,FemployeeID,c.courseID,st.sectionID,p.ploNo,SUM(marksObtained) mo,SUM(marksObtainable) mg
            from students s, marksDisseminations m, assessments a,cos c,comappings cm,plos p,assessmentTypes ta,sections st
            WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID AND ta.assessmentTypeID=a.assessmentTypeID
            AND st.sectionID=ta.sectionID AND p.ploID=cm.ploID AND c.coID = cm.coID AND
            (c.courseID='$courseID' AND st.semesterID>=$startDate AND st.semesterID<=$endDate)
            GROUP by FemployeeID,s.studentID,c.courseID,st.sectionID,p.ploID,p.ploNo) VT
            GROUP BY FemployeeID,courseID,ploNo;");
            $data1 = DB::table('temp1')
                ->select('coNo', DB::raw('AVG(co_percentage) success'))
                ->groupBy('coNo')
                ->get();
            $data2 = DB::table('temp2')
                ->select('ploNo', DB::raw('AVG(plo_percentage) success'))
                ->groupBy('ploNo')
                ->get();
            $faculty = DB::table('temp1')
                ->join('employees', 'employees.employeeID', '=', 'temp1.FemployeeID')
                ->select(DB::raw('DISTINCT FemployeeID'), 'firstname')
                ->get();
            $p1 = DB::table('temp1')->get();
            $p2 = DB::table('temp2')->get();
            foreach ($data1 as $d)
                array_push($c1, [$d->coNo, ceil($d->success)]);

            foreach ($data2 as $d)
                array_push($c2, [$d->ploNo, ceil($d->success)]);
        }

        return view('pages/higher_official/coursereport')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'courseID' => $courseID,
                'faculty' => $faculty,
                'c1' => $c1,
                'c2' => $c2,
                'arr' => $arr,
                'p1' => $p1,
                'p2' => $p2
            ]
        );
    }


    public function hcr(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        $courseID = (string)$request->input('courseID');
        if ($startDate <= $endtDate) {
            return redirect('/courseReportO')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'courseID' => $courseID
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range', 'higherO' => $higherO]);
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
        $higherO = Session::get('higherO');
        return view('pages/higher_official/higherOdashboard')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
            ]
        );
    }


    public function hse(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $school = array();
        if ($request->input('school1')) array_push($school, $request->input('school1'));
        if ($request->input('school2')) array_push($school, $request->input('school2'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($school)) {
            return redirect('/schoolEnrollment')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'school' => $school
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No School Is Selected', 'higherO' => $higherO]);
        }
    }


    public function showsE()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $school = NULL;
        $arr= array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $school = Session::get('school');
            $data=DB::table('enrollment')
            ->join('semesters','semesters.startDate','=','enrollment.admissionDate')
            ->select('schoolName','semesterName','amount')
            ->whereIn('schoolID',$school)
            ->where('semesterID','>=',$startDate)
            ->where('semesterID','<=',$endDate)
            ->get();

            $semesters= DB::table('semester')
            ->select('semesterName')
            ->where('semesterID','>=',$startDate)
            ->where('semesterID','<=',$endDate)
            ->get();

            $schools=DB::table('schools')->select('schoolName')->whereIn('schoolID',$school)->get();
            $temparry=array('semesters');
            foreach($schools as $s)
                array_push($temparry,$s->schoolName);
            array_push($arr,$temparry);

            // FIX
            foreach($semeters as $s)
            {

            }
            return $arr;
        }
        return view('pages/higher_official/schoolenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
            ]
        );
    }
    public function showdE()
    {
        $higherO = Session::get('higherO');
        return view('pages/higher_official/departmentenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
            ]
        );
    }
    public function showpE()
    {
        $higherO = Session::get('higherO');
        return view('pages/higher_official/programenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
            ]
        );
    }
}
