<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFile;
use App\Services\ApiAuth;
use App\Utils;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SlipController extends Controller
{
    public function list($account_id, Request $request)
    {
        if (!ApiAuth::hasPermission(Constants::API_PERMISSION["slip: read list"])) {
            throw new HttpException(403, 'Permission denied');
        }

        $request->validate([
            "page" => "nullable|integer|min:1",
            "count" => "nullable|integer|min:1",
        ]);

        $page = $request->input("page", 1);
        $count = $request->input("count", 10);

        $user = User::where('id', $account_id)->first();

        if (!$user) {
            throw new HttpException(404, 'Account not found');
        }

        $files = $user->files()->select([
            'id',
            'name',
            'type',
            'created_at'
        ])->paginate($count, ['*'], 'page', $page);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "data" => $files->items(),
            "meta" => [
                "count" => $count,
                "page" => $page,
                "totalItems" => $files->total(),
                "totalPages" => $files->lastPage(),
            ],
        ]);
    }

    public function get($slip_id, Request $request)
    {
        if (!ApiAuth::hasPermission(Constants::API_PERMISSION["slip: read detail"])) {
            throw new HttpException(403, 'Permission denied');
        }

        $file = UserFile::where('id', $slip_id)->first();

        if (!$file) {
            throw new HttpException(404, 'File not found');
        }

        $user = $file->user;

        $data = Utils::DECRYPT_SLIP($file->file, $file->key, $file->iv, $user->private_key);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "data" => [
                "user" => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'number' => $user->number,
                    'rank' => $user->rank,
                    'position' => $user->position,
                    'created_at' => $user->created_at,
                ],
                "file" => [
                    "id" => $file->id,
                    "name" => $file->name,
                    "type" => $file->type,
                    "created_at" => $file->created_at,
                    "data" => $data,
                ]
            ],
        ]);
    }
}
