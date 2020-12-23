<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        //if user logged in, it can access both login and Register
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {


        //validate
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        //sign in user
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with("message", "Invalid Login Detail");
        }
        //other way to sign in
        // if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
        //     return back()->with("message", "Invalid Login Detail");
        // }

        //redicret
        return redirect()->route('dashboard');
    }
}
