<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Session;
use Redirect;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = Users::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->uid);
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout(Request $request)
    { 
        Session::forget('user_id');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
