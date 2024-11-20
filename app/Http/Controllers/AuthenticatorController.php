<?php

namespace App\Http\Controllers;

use App\Utils;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticatorController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        /** @var \App\Models\User */
        $user = auth()->user();

        if (!$user["2fa_secret"]) {
            throw new HttpException(400, '2FA Not Enabled!');
        }

        if (!Utils::VERIFY_2FA($user["2fa_secret"], $request->code)) {
            throw new HttpException(400, 'Invalid Code!');
        }

        Utils::STORE_VALIDATED_DEVICE(auth()->id());

        return response()->json([
            'status' => 'success',
            'message' => '2FA Verified!',
        ]);
    }

    public function enable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        /** @var \App\Models\User */
        $user = auth()->user();

        if ($user["2fa_secret"]) {
            throw new HttpException(400, '2FA Already Enabled!');
        }

        if (!password_verify($request->password, $user->password)) {
            throw new HttpException(400, 'Invalid Password!');
        }

        $key = Utils::GENERATE_2FA_SECRET();

        $user->update([
            '2fa_secret' => $key,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'key' => $key,
                'qr' => Utils::GET_2FA_QRCODE($user->email, $key),
            ],
        ]);
    }

    public function disable(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        /** @var \App\Models\User */
        $user = auth()->user();

        if (!$user["2fa_secret"]) {
            throw new HttpException(400, '2FA Already Disabled!');
        }

        if (!Utils::VERIFY_2FA($user["2fa_secret"], $request->code)) {
            throw new HttpException(400, 'Invalid Code!');
        }

        $user->update([
            '2fa_secret' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '2FA Disabled!',
        ]);
    }
}
