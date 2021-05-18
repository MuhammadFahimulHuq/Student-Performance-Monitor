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
        // $cID = NULL;
        // if (!empty(Session::get('cID'))) {
        //     $cID = Session::get('cID');
        // }
        $higherO = Session::get('higherO');
        return view('pages/higher_official/studentreport')->with(
            [
                'higherO' => $higherO,
                'username' => $higherO->firstname,
                'userType' => 'Higher Official'
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
                'userType' => 'Higher Official'
            ]
        );
    }
}
