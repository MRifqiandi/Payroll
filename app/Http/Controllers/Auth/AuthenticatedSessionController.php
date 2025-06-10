<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            ActivityLogger::log('login', 'User login dengan email: ' . $request->email, 'info');

            return redirect()->intended('/');
        }

        return view('pages.auth.login')->with('error', 'Email atau password anda salah!');
    }

    public function reset(Request $request)
    {
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

    public function destroy(Request $request)
    {
        $user = auth()->user();

        ActivityLogger::log('logout', 'User logout dengan email: ' . $user->email, 'info');

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
