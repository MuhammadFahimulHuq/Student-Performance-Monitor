<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function login()
    {
        return view('pages.login');
        // return view('pages.test');
    }
    public function validation(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|max:250',
            'password' => 'required',
        ]);
        // $user = User::select("*")->where('username', $data->input('username'))->where('password', $data->input('password'))->get();
        $isUser = User::select("*")->where('username', $data->input('username'))->where('password', $data->input('password'))->exists();

        if ($isUser) {
            $users = DB::select('SELECT * FROM users WHERE username ="' . $data->input('username') . '" AND password ="' . $data->input('password') . '"');
            foreach ($users as $user)
                // return view('pages.test', [
                //     'username' => $user->username,
                // ]);
            // $this->index($user);
            // return route('/'.$user->id.'/dashboard');
                if($user->userType=='student')
                    return view('pages.student');
                if($user->userType=='faculty')
                    return view('pages.faculty');
        } else {
            return redirect()->back()->with('message', 'Invalid User');
        }
    }

    public function index($id)
    {
        // dd($id);
        return view('pages.test', [
            'username' => $id
        ]);
    }
}
