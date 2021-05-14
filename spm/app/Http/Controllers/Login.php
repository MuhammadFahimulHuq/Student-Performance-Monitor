<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class Login extends Controller
{
    public function login()
    {
        return view('pages.login');
    }
    public function validation(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|max:250',
            'password' => 'required',
        ]);
        $isUser = User::select("*")->where('username', $data->input('username'))->where('password', $data->input('password'))->exists();

        if ($isUser) {
            $users = DB::select('SELECT * FROM users WHERE username ="' . $data->input('username') . '" AND password ="' . $data->input('password') . '"');
            foreach ($users as $user) {
                if ($user->userType == 'student') {
                    $student = Student::where('studentID', $user->username)->first();
                    return app('App\Http\Controllers\Student_D')->index($student->studentID);
                }
                if ($user->userType == 'faculty') {
                    $faculty = Employee::where('employeeID', $user->username)->first();
                    return app('App\Http\Controllers\Faculty_D')->index($faculty->employeeID);
                }
                if ($user->userType == 'higherOfficial')
                    return app('App\Http\Controllers\HigerO_D')->index($user->user_id);
            }
        } else {
            return redirect()->back()->with('message', 'Invalid User');
        }
    }
}
