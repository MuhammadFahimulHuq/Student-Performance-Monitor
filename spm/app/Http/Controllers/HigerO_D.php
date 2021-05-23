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
    public function sC($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/schoolcgpa')->with(['higherO' => $higherO]);
    }
    public function dC($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/departmentcgpa')->with(['higherO' => $higherO]);
    }
    public function pC($id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        return redirect('/programcgpa')->with(['higherO' => $higherO]);
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

    public function hde(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $department = array();
        if ($request->input('department1')) array_push($department, $request->input('department1'));
        if ($request->input('department2')) array_push($department, $request->input('department2'));
        if ($request->input('department3')) array_push($department, $request->input('department3'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($department)) {
            return redirect('/departmentEnrollment')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'department' => $department
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No Department Is Selected', 'higherO' => $higherO]);
        }
    }

    public function hpe(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $program = array();
        if ($request->input('program1')) array_push($program, $request->input('program1'));
        if ($request->input('program2')) array_push($program, $request->input('program2'));
        if ($request->input('program3')) array_push($program, $request->input('program3'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($program)) {
            return redirect('/programEnrollment')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'program' => $program
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No Program Is Selected', 'higherO' => $higherO]);
        }
    }


    public function hsc(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $school = array();
        if ($request->input('school1')) array_push($school, $request->input('school1'));
        if ($request->input('school2')) array_push($school, $request->input('school2'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($school)) {
            return redirect('/schoolcgpa')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'school' => $school
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No School Is Selected', 'higherO' => $higherO]);
        }
    }

    public function hdc(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $department = array();
        if ($request->input('department1')) array_push($department, $request->input('department1'));
        if ($request->input('department2')) array_push($department, $request->input('department2'));
        if ($request->input('department3')) array_push($department, $request->input('department3'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($department)) {
            return redirect('/departmentcgpa')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'department' => $department
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No Department Is Selected', 'higherO' => $higherO]);
        }
    }

    public function hpc(Request $request, $id)
    {
        $higherO = Employee::where('employeeID', $id)->first();
        $program = array();
        if ($request->input('program1')) array_push($program, $request->input('program1'));
        if ($request->input('program2')) array_push($program, $request->input('program2'));
        if ($request->input('program3')) array_push($program, $request->input('program3'));
        $startDate = $request->input('startDate');
        $endtDate = $request->input('endDate');
        if ($startDate <= $endtDate && !empty($program)) {
            return redirect('/programcgpa')->with([
                'higherO' => $higherO,
                'startDate' => $startDate,
                'endDate' => $endtDate,
                'program' => $program
            ]);
        } else {
            return redirect()->back()->with(['message' => 'Invalid Range Or No Program Is Selected', 'higherO' => $higherO]);
        }
    }


    public function showsE()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $school = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $school = Session::get('school');
            $data = DB::table('enrollment')
                ->join('semesters', 'semesters.startDate', '=', 'enrollment.admissionDate')
                ->select('schoolName', 'semesterName', DB::raw('SUM(amount) amount'))
                ->whereIn('schoolID', $school)
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->groupBy('schoolName', 'semesterName')
                ->get();

            $semesters = DB::table('semesters')
                ->select('semesterName')
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->get();

            $schools = DB::table('schools')->select('schoolName')->whereIn('schoolID', $school)->get();
            $temparry = array('semesters');
            foreach ($schools as $s)
                array_push($temparry, $s->schoolName);
            array_push($arr, $temparry);
            foreach ($semesters as $sm) {
                unset($temparry);
                $temparry = array();
                array_push($temparry, $sm->semesterName);
                foreach ($schools as $sc) {
                    foreach ($data as $d) {
                        if ($d->schoolName == $sc->schoolName && $d->semesterName == $sm->semesterName)
                            array_push($temparry, (int)$d->amount);
                    }
                }
                array_push($arr, $temparry);
            }
        }
        return view('pages/higher_official/schoolenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }
    public function showdE()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $department = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $department = Session::get('department');
            $data = DB::table('enrollment')
                ->join('semesters', 'semesters.startDate', '=', 'enrollment.admissionDate')
                ->select('departmentID', 'semesterName', DB::raw('SUM(amount) amount'))
                ->whereIn('departmentID', $department)
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->groupBy('departmentID', 'semesterName')
                ->get();

            $semesters = DB::table('semesters')
                ->select('semesterName')
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->get();

            $departments = DB::table('departments')->select('departmentID')->whereIn('departmentID', $department)->get();
            $temparry = array('semesters');
            foreach ($departments as $s)
                array_push($temparry, $s->departmentID);
            array_push($arr, $temparry);
            foreach ($semesters as $sm) {
                unset($temparry);
                $temparry = array();
                array_push($temparry, $sm->semesterName);
                foreach ($departments as $sc) {
                    foreach ($data as $d) {
                        if ($d->departmentID == $sc->departmentID && $d->semesterName == $sm->semesterName)
                            array_push($temparry, (int)$d->amount);
                    }
                }
                array_push($arr, $temparry);
            }
        }
        return view('pages/higher_official/departmentenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }
    public function showpE()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $program = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = Session::get('startDate');
            $endDate = Session::get('endDate');
            $program = Session::get('program');
            $data = DB::table('enrollment')
                ->join('semesters', 'semesters.startDate', '=', 'enrollment.admissionDate')
                ->select('programID', 'semesterName', DB::raw('SUM(amount) amount'))
                ->whereIn('programID', $program)
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->groupBy('programID', 'semesterName')
                ->get();

            $semesters = DB::table('semesters')
                ->select('semesterName')
                ->where('semesterID', '>=', $startDate)
                ->where('semesterID', '<=', $endDate)
                ->get();

            $programs = DB::table('programs')->select('programID')->whereIn('programID', $program)->get();
            $temparry = array('semesters');
            foreach ($programs as $s)
                array_push($temparry, $s->programID);
            array_push($arr, $temparry);
            foreach ($semesters as $sm) {
                unset($temparry);
                $temparry = array();
                array_push($temparry, $sm->semesterName);
                foreach ($programs as $sc) {
                    foreach ($data as $d) {
                        if ($d->programID == $sc->programID && $d->semesterName == $sm->semesterName)
                            array_push($temparry, (int)$d->amount);
                    }
                }
                array_push($arr, $temparry);
            }
        }
        return view('pages/higher_official/programenrollment')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }


    public function showsC()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $school = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = (int)Session::get('startDate');
            $endDate = (int)Session::get('endDate');
            $school = Session::get('school');

            DB::statement("DROP VIEW IF EXISTS temps;");
            DB::statement("CREATE VIEW temps AS
            SELECT p.departmentID,s.programID,AVG(VVVT.cgpa) Acgpa
            FROM(SELECT studentID,SUM(gpa)/COUNT(gpa) cgpa
            FROM(SELECT studentID,semesterID,(TgradeWeight/Tcredit) gpa
            FROM(SELECT vt.studentID,s.semesterID,SUM(vt.gradePoint*noOfCredit) TgradeWeight, SUM(noOfCredit) Tcredit
            FROM v_transcript vt,sections s, registers r, courses c
            WHERE vt.sectionID=s.sectionID AND r.studentID=vt.studentID AND s.courseID=c.courseID AND
            s.semesterID>=$startDate AND s.semesterID<=$endDate
            GROUP BY vt.studentID,s.semesterID ) VT) VVT
            GROUP BY studentID)VVVT, students s,programs p
            WHERE s.studentID=VVVT.studentID AND p.programID=s.programID
            GROUP BY p.departmentID,s.programID;");

            $data = DB::table('temps')
                ->join('departments', 'departments.departmentID', '=', 'temps.departmentID')
                ->join('schools', 'departments.schoolID', '=', 'schools.schoolID')
                ->select('schoolName', DB::raw('AVG(Acgpa) AS Acgpa'))
                ->whereIn('schools.schoolID', $school)
                ->groupBy('schools.schoolName')
                ->get();

            array_push($arr, ['School', 'CGPA']);
            foreach ($data as $d) {
                array_push($arr, [$d->schoolName,(float)$d->Acgpa]);
            }
        }
        return view('pages/higher_official/schoolcgpa')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }

    public function showdC()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $department = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = (int)Session::get('startDate');
            $endDate = (int)Session::get('endDate');
            $department = Session::get('department');

            DB::statement("DROP VIEW IF EXISTS temps;");
            DB::statement("CREATE VIEW temps AS
            SELECT p.departmentID,s.programID,AVG(VVVT.cgpa) Acgpa
            FROM(SELECT studentID,SUM(gpa)/COUNT(gpa) cgpa
            FROM(SELECT studentID,semesterID,(TgradeWeight/Tcredit) gpa
            FROM(SELECT vt.studentID,s.semesterID,SUM(vt.gradePoint*noOfCredit) TgradeWeight, SUM(noOfCredit) Tcredit
            FROM v_transcript vt,sections s, registers r, courses c
            WHERE vt.sectionID=s.sectionID AND r.studentID=vt.studentID AND s.courseID=c.courseID AND
            s.semesterID>=$startDate AND s.semesterID<=$endDate
            GROUP BY vt.studentID,s.semesterID ) VT) VVT
            GROUP BY studentID)VVVT, students s,programs p
            WHERE s.studentID=VVVT.studentID AND p.programID=s.programID
            GROUP BY p.departmentID,s.programID;");

            $data = DB::table('temps')
                ->select('departmentID','Acgpa')
                ->whereIn('departmentID', $department)
                ->get();
            array_push($arr, ['Department', 'CGPA']);
            foreach ($data as $d) {
                array_push($arr, [$d->departmentID,(float)$d->Acgpa]);
            }
        }
        return view('pages/higher_official/departmentcgpa')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }

    public function showpC()
    {
        $higherO = Session::get('higherO');
        $startDate = NULL;
        $endtDate = NULL;
        $program = NULL;
        $arr = array();
        if (!empty(Session::get('startDate'))) {
            $startDate = (int)Session::get('startDate');
            $endDate = (int)Session::get('endDate');
            $program = Session::get('program');

            DB::statement("DROP VIEW IF EXISTS temps;");
            DB::statement("CREATE VIEW temps AS
            SELECT p.departmentID,s.programID,AVG(VVVT.cgpa) Acgpa
            FROM(SELECT studentID,SUM(gpa)/COUNT(gpa) cgpa
            FROM(SELECT studentID,semesterID,(TgradeWeight/Tcredit) gpa
            FROM(SELECT vt.studentID,s.semesterID,SUM(vt.gradePoint*noOfCredit) TgradeWeight, SUM(noOfCredit) Tcredit
            FROM v_transcript vt,sections s, registers r, courses c
            WHERE vt.sectionID=s.sectionID AND r.studentID=vt.studentID AND s.courseID=c.courseID AND
            s.semesterID>=$startDate AND s.semesterID<=$endDate
            GROUP BY vt.studentID,s.semesterID ) VT) VVT
            GROUP BY studentID)VVVT, students s,programs p
            WHERE s.studentID=VVVT.studentID AND p.programID=s.programID
            GROUP BY p.departmentID,s.programID;");

            $data = DB::table('temps')
                ->select('programID','Acgpa')
                ->whereIn('programID', $program)
                ->get();
            array_push($arr, ['Program', 'CGPA']);
            foreach ($data as $d) {
                array_push($arr, [$d->programID,(float)$d->Acgpa]);
            }
        }
        return view('pages/higher_official/programcgpa')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official',
                'startDate' => $startDate,
                'arr' => $arr
            ]
        );
    }

}
