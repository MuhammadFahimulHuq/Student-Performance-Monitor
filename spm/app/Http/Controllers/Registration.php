<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Registration extends Controller
{
    public function reg()
    {
        return view('pages.registration');
    }

    public function deadCall()
    {
        // $users = User::all();
        $users= DB::select('select * from student');
        return $users;
    }

    public function validating(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|max:250',
            'password' => 'required',
            'AuthCode' => 'required|max:8',
            'userType' => 'required'
        ]);

        if ($data->AuthCode != "1") {
            return redirect()->back()->with('error', 'Invalid Auth-Code');
        }

        User::create([
            'username' => $data->username,
            'password' => $data->password,
            'userType' => $data->userType,
        ]);

        return $this->deadCall();
    }
    public function populateDatabase()
    {

DB::statement("CREATE VIEW IF NOT EXISTS view_student_plo AS
SELECT s.studentID,p.ploID,(SUM(marksObtained)/SUM(marksObtainable))*100 plo_percentage
from students s, marksDisseminations m, assessments a,cos c,comappings cm,plos p
WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID AND p.ploID=cm.ploID AND c.coID = cm.coID GROUP by s.studentID,p.ploID
;");
DB::statement(" CREATE VIEW IF NOT EXISTS view_student_co AS
SELECT s.studentID,c.coID,(SUM(marksObtained)/SUM(marksObtainable))*100 co_percentage
from students s, marksDisseminations m, assessments a,cos c
WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID
GROUP by s.studentID,c.coID;");
DB::statement("CREATE VIEW IF NOT EXISTS course_plo_percentage AS
SELECT studentID,courseID,p.ploID,AVG(co_percentage) sucess
FROM view_student_co vt, cos c, comappings cm, plos p
WHERE vt.coID=c.coID AND cm.ploID=p.ploID and c.coID=cm.coID
GROUP BY studentID,c.courseID,p.ploID;");
DB::statement("CREATE VIEW IF NOT EXISTS faculty_plo AS
SELECT s.studentID,FemployeeID,c.courseID,st.sectionID,p.ploID,(SUM(marksObtained)/SUM(marksObtainable))*100 co_percentage
from students s, marksDisseminations m, assessments a,cos c,comappings cm,plos p,assessmentTypes ta,sections st
WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID AND ta.assessmentTypeID=a.assessmentTypeID
AND st.sectionID=ta.sectionID AND p.ploID=cm.ploID AND c.coID = cm.coID
GROUP by FemployeeID,s.studentID,c.courseID,st.sectionID,p.ploID;");

DB::statement("CREATE VIEW IF NOT EXISTS faculty_co AS
SELECT s.studentID,FemployeeID,c.courseID,st.sectionID,c.coID,(SUM(marksObtained)/SUM(marksObtainable))*100 co_percentage
from students s, marksDisseminations m, assessments a,cos c,comappings cm,plos p,assessmentTypes ta,sections st
WHERE s.studentID=m.studentID AND a.assessmentID=m.assessmentID AND a.coID=c.coID AND ta.assessmentTypeID=a.assessmentTypeID
AND st.sectionID=ta.sectionID AND p.ploID=cm.ploID AND c.coID = cm.coID
GROUP by FemployeeID,s.studentID,c.courseID,st.sectionID,c.coID;");

return redirect()->back()->with('message', 'Database Populated');
    }
}
