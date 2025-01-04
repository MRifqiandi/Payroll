<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('pages.auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:' . config('database.tables.DB_USERS') . ',email'
            ], [
                'email.exists' => 'Email tidak terdaftar.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.'
            ]);

            $email = $request->email;
            $token = Str::random(64);

            $existingRequest = DB::table('password_reset_tokens')
                ->where('email', $email)
                ->first();

            if ($existingRequest && Carbon::parse($existingRequest->created_at)->addHours(8)->isFuture()) {
                return view('pages.auth.forgot-password')->with('error', 'Email sudah pernah dikirimkan sebelumnya. Silahkan cek email Anda.');
            }

            // Upsert the token (insert or update)
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                [
                    'token' => $token,
                    'created_at' => now(),
                ]
            );

            Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Reset Link');
            });

            return view('pages.auth.email-sented');
        } catch (\Throwable $th) {
            if ($th instanceof ValidationException) {
                return view('pages.auth.forgot-password')->with('error', $th->getMessage());
            }

            Log::error($th);

            return view('pages.auth.forgot-password')->with('error', 'Terjadi kesalahan.');
        }
    }

    public function showResetPasswordForm($token)
    {
        return view('pages.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);

        DB::beginTransaction();

        // Find the reset request by token
        $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        // Update the user's password
        User::where('email', $reset->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete the token after successful reset
        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        DB::commit();

        return view('pages.auth.login', [
            'message' => 'Password berhasil direset. Silahkan login.'
        ]);
    }
}
