<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AccountController extends Controller
{
    public function get(Request $request)
    {
        if (!ApiAuth::hasPermission(Constants::API_PERMISSION["account: read"])) {
            throw new HttpException(403, 'Permission denied');
        }

        $request->validate([
            "page" => "nullable|integer|min:1",
            "count" => "nullable|integer|min:1",
        ]);

        $page = $request->input("page", 1);
        $count = $request->input("count", 10);

        $accounts = User::select([
            'id',
            'name',
            'email',
            'number',
            'rank',
            'position',
            'created_at'
        ])->paginate($count, ['*'], 'page', $page);

        return response()->json([
            "code" => 200,
            "status" => "success",
            "data" => $accounts->items(),
            "meta" => [
                "count" => $count,
                "page" => $page,
                "totalItems" => $accounts->total(),
                "totalPages" => $accounts->lastPage(),
            ],
        ]);
    }
}
