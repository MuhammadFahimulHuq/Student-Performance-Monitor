<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\ViewStudentCo;
use App\Models\ViewStudentplo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Student_D extends Controller
{

    public function index($id)
    {
        $student = Student::where('studentID', $id)->first();
        return redirect('/student')->with(['student' => $student]);
    }
    public function oR($id)
    {
        $student = Student::where('studentID', $id)->first();
        return redirect('/overallReport')->with(['student' => $student]);
    }
    public function showOR()
    {
        $student = Session::get('student');
        $plos = DB::table('plos')
            ->join('programs', 'programs.programID', '=', 'plos.programID')
            ->join('students', 'students.programID', '=', 'plos.programID')
            ->select('ploID')
            ->where('studentID', $student->studentID)
            ->where('programs.programID', $student->programID)
            ->get();
        $success = DB::table('course_plo_percentage')
            ->select('courseID', 'ploID', 'success')
            ->where('studentID', $student->studentID)
            ->get();
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
                ELSE 0
                END AS id')
            )
            ->where('studentID', $student->studentID)
            ->groupBy('courseID')
            ->get();
        $p1 = DB::table('view_student_co')
            ->join('cos', 'view_student_co.coID', '=', 'cos.coID')
            ->select('studentID', 'courseID', 'cos.coNo', 'co_percentage')
            ->where('studentID', $student->studentID)
            ->get();
        $p2 = DB::table('course_plo_percentage')
            ->where('studentID', $student->studentID)
            ->join('plos', 'plos.ploID', '=', 'course_plo_percentage.ploID')
            ->get();
        $arr = array();
        $i=null;
        return view('pages/student/overallReport')->with(
            [
                'student' => $student,
                'username' => $student->firstname,
                'userType' => 'student',
                'courses' => $courses,
                'plos' => $plos,
                'tplo' => $plos->count()*$courses->count(),
                'success' => $success,
                'p1' => $p1,
                'p2' => $p2,
                'arr' => $arr,
                'i'=>$i
            ]
        );
    }
    public function showH()
    {
        $student = Session::get('student');
        $cards = DB::table('view_student_plo')->where('studentID', $student->studentID)->get();
        $stdplo = DB::table('view_student_plo')
            ->join('plos', 'view_student_plo.ploid', '=', 'plos.ploid')
            ->select(
                DB::raw('plos.ploID as ploNo'),
                DB::raw('view_student_plo.plo_percentage as success')
            )
            ->where('studentID', $student->studentID)
            ->get();
        $dpth = DB::table('programs')
            ->join('students', 'students.programID', '=', 'programs.programID')
            ->select('departmentID')
            ->where('students.programID', $student->programID)
            ->limit(1)
            ->first();

        $pth = DB::table('programs')
            ->join('students', 'students.programID', '=', 'programs.programID')
            ->select('programs.programID')
            ->where('students.programID', $student->programID)
            ->limit(1)
            ->first();
        $dptplo = DB::table('view_student_plo')
            ->join('plos', 'view_student_plo.ploID', '=', 'plos.ploID')
            ->join('programs', 'plos.programID', '=', 'programs.programID')
            ->select(
                DB::raw('plos.ploID as ploNo'),
                DB::raw('AVG(view_student_plo.plo_percentage) as success')
            )
            ->where('programs.departmentID', $dpth->departmentID)
            ->groupBy('plos.ploID')
            ->get();
        $ptplo = DB::table('view_student_plo')
            ->join('plos', 'view_student_plo.ploID', '=', 'plos.ploID')
            ->join('programs', 'plos.programID', '=', 'programs.programID')
            ->select(
                DB::raw('plos.ploID as ploNo'),
                DB::raw('AVG(view_student_plo.plo_percentage) as success')
            )
            ->where('programs.programID', $pth->programID)
            ->groupBy('plos.ploID')
            ->get();
        $arrp = array();
        $arrs = array();
        $arrd = array();
        foreach ($stdplo as $s)
            array_push($arrs, [$s->ploNo, (float)$s->success]);
        foreach ($dptplo as $s)
            array_push($arrd, [$s->ploNo, (float)$s->success]);
        foreach ($ptplo as $s)
            array_push($arrp, [$s->ploNo, (float)$s->success]);
        $Lowest = DB::table('view_student_plo')->where('studentID', $student->studentID)->where('plo_percentage', $cards->min('plo_percentage'))->first();
        return view('pages/student/studentdashboard')->with(
            [
                'student' => $student,
                'username' => $student->firstname,
                'userType' => 'student',
                'cards' => $cards,
                'lowest' => $Lowest,
                'stdplo' => json_encode($arrs),
                'dptplo' => json_encode($arrd),
                'ptplo' => json_encode($arrp)
            ]
        );
    }
}
