<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Registration extends Controller
{
    public function reg()
    {
        return view('pages.registration');
    }

    public function deadCall()
    {
        $users = User::all();
        return $users;
    }

    public function validating(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|max:250',
            'password' => 'required',
            'userType' => 'required'
        ]);

        User::create([
            'username' => $data->username,
            'password' => $data->password,
            'userType' => $data->userType,
        ]);

        return $this->deadCall();
    }
}
