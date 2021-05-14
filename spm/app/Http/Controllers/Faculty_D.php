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

    public function showH()
    {
        $faculty = Session::get('faculty');
        // $cards = DB::table('view_student_plo')->where('studentID', $student->studentID)->get();
        // $stdplo = ViewStudentplo::select(
        //     DB::raw("ploID as ploNo"),
        //     DB::raw("plo_percentage as success")
        // )
        //     ->where('studentID', $student->studentID)
        //     ->get();
        // $dptplo = ViewStudentplo::select(
        //     DB::raw("ploID as ploNo"),
        //     DB::raw("AVG(plo_percentage) as success")
        // )
        //     ->groupBy('ploID')
        //     ->get();
        // $arrs = array();
        // $arrd = array();
        // foreach ($stdplo as $s)
        //     array_push($arrs, [$s->ploNo, (float)$s->success]);
        // foreach ($dptplo as $s)
        //     array_push($arrd, [$s->ploNo, (float)$s->success]);

        // $Lowest = DB::table('view_student_plo')->where('studentID', $student->studentID)->where('plo_percentage', $cards->min('plo_percentage'))->first();
        return view('pages/faculty/facultydashboard')->with(
            [
                'faculty' => $faculty,
                'username' => $faculty->firstname,
                'userType' => 'faculty'
                // 'cards' => $cards,
                // 'lowest' => $Lowest,
                // 'stdplo' => json_encode($arrs),
                // 'dptplo' => json_encode($arrd)
            ]
        );
    }

}
