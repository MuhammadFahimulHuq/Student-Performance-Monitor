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

        return redirect()->back()->with('message', 'Database Populated');
    }
}
