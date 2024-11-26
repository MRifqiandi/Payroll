<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class ApiKeyController extends Controller
{
    public function index()
    {
        return view('pages.api-key.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:' . config('database.tables.DB_API_KEYS') . ',name',
            'permissions' => 'required|min:1|array|in:' . implode(',', Constants::API_PERMISSION),
        ]);

        $user = Utils::GENERATE_API_USER();
        $key = Utils::GENERATE_API_KEY();

        DB::beginTransaction();

        ApiKey::create([
            'name' => $request->name,
            'user' => $user,
            'key' => Hash::make($key),
        ])->syncPermissions($request->permissions);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'key' => $key,
            ],
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $key = ApiKey::where('id', $request->id)->first();

        if (!$key) {
            throw new HttpException(404, 'API key not found');
        }

        $key->syncPermissions([]);
        $key->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'API key deleted',
        ]);
    }

    public function getDatatable()
    {
        $query = ApiKey::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return view('pages.api-key.menu', compact('query'));
            })
            ->addColumn('permission', function ($query) {
                return $query->getPermissionNames()->implode(', ');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
