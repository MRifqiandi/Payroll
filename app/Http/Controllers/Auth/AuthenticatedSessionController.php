<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function create(){
        return view('pages.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Login Failed! Email or Password is wrong.');
    }

    public function reset(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Password has been changed successfully!',
        ]);
    }

    public function destroy(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
