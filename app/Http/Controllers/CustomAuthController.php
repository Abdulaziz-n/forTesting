<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function index()
    {

        return view('admin.auth.login');
    }

    public function Adminlogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember_me = $request->has('remember') ? true : false;

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

        } else {
            Auth::attempt($credentials, $remember_me);
            return redirect()->route('admin');
        }

    }
    public function logout(Request $request) {

        Auth::user()->id;
        Auth::logout();
        return redirect('home')->route('home');
    }

}
