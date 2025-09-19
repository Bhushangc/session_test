<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Invalid credentials');
            return redirect()->back()->withInput();
        }
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                Session::flash('error', 'Invalid credentials');
                return redirect()->back()->withInput();
            }

            $user = Auth::user();
            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        if (!$user) {
            Session::flash('error', 'no user');
            return redirect()->back()->withInput();
        }
        return view('dashboard');
    }
}
