<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        //only geust can acceess this controller
        $this->middleware("guest");
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //validate request data
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|confirmed'
        ]);

        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //sign in user
        auth()->attempt($request->only("email", "password"));

        //redirect
        return redirect()->route('dashboard');
    }
}
