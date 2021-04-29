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

        if ($data->AuthCode != "12345678") {
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
        // $students = [
        //     ['studentID' => '1001', 'firstName' => 'testcase1', 'lastName' => 'testcase1', 'email' => 'testcase1@gmail.com', 'gender' => 'Male', 'dateOfBirth' => '2000-04-05', 'phone' => '3234142', 'address' => 'ytvjgj', 'admissionDate' => '2018-04-05'],
        //     ['studentID' => '1002', 'firstName' => 'testcase1', 'lastName' => 'testcase1', 'email' => 'testcase1@gmail.com', 'gender' => 'Male', 'dateOfBirth' => '2000-04-05', 'phone' => '3234142', 'address' => 'ytvjgj', 'admissionDate' => '2018-04-05'],
        //     ['studentID' => '1003', 'firstName' => 'testcase1', 'lastName' => 'testcase1', 'email' => 'testcase1@gmail.com', 'gender' => 'Male', 'dateOfBirth' => '2000-04-05', 'phone' => '3234142', 'address' => 'ytvjgj', 'admissionDate' => '2018-04-05']
        // ];
        // DB::table('student')->insert($students);

        DB::statement("INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `email`, `gender`, `dateOfBirth`, `phone`, `address`, `admissionDate`) VALUES
        ('10001', 'testcase1', 'testcase1', 'testcase1@gmail.com', 'male', '2011-04-05', '123342134', '3432fdffsd', '2013-04-19'),
        ('10002', 'testcase1', 'testcase1', 'testcase1@gmail.com', 'male', '2011-04-05', '123342134', '3432fdffsd', '2013-04-19'),
        ('10003', 'testcase1', 'testcase1', 'testcase1@gmail.com', 'male', '2011-04-05', '123342134', '3432fdffsd', '2013-04-19');
    ");
        return redirect()->back()->with('message', 'Database Populated');
    }
}
