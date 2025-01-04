<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\AccountService;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function index()
    {
        return view('pages.account.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:' . config('database.tables.DB_USERS') . ',email',
            'password' => 'required|min:8',
            'rank' => 'required',
            'number' => 'required',
            'position' => 'required',
        ]);

        DB::beginTransaction();

        $key = Utils::GENERATE_RSA_KEY();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rank' => $request->rank,
            'number' => $request->number,
            'position' => $request->position,
            'public_key' => $key['public_key'],
            'private_key' => Utils::ENCRYPT_ENV($key['private_key']),
        ]);

        $user->assignRole($request->role);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'role' => 'required',
            'name' => 'required',
            'rank' => 'required',
            'number' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:' . config('database.tables.DB_USERS') . ',email,' . $request->id,
        ]);

        $user = User::whereId($request->id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        DB::beginTransaction();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'rank' => $request->rank,
            'number' => $request->number,
            'position' => $request->position,
        ]);

        $user->syncRoles([$request->role]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Account updated successfully'
        ]);
    }

    public function updatePassword(Request $request)
    {
        // $request->validate([
        //     'id' => 'required',
        //     'password' => 'required|min:8',
        // ]);

        // $user = User::whereId($request->id)->first();

        // if (!$user) {
        //     throw new HttpException(404, 'User not found');
        // }

        // $user->password = bcrypt($request->password);
        // $user->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Password updated successfully'
        // ]);
    }

    public function disableAuthenticator(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::whereId($request->id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        if (!$user["2fa_secret"]) {
            throw new HttpException(400, 'Authenticator is not enabled');
        }

        $user->update([
            '2fa_secret' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Authenticator disabled successfully'
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::whereId($request->id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        if ($user->files()->exists()) {
            throw new HttpException(400, 'Cannot delete user with files');
        }

        if ($user->uploads()->exists()) {
            throw new HttpException(400, 'Cannot delete user with uploads');
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Account deleted successfully'
        ]);
    }

    public function getDatatable()
    {
        $query = User::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('role', function ($query) {
                return $query->getRoleNames()->first();
            })
            ->addColumn('action', function ($query) {
                return view('pages.account.menu', compact('query'));
            })
            ->addColumn('role', function ($query) {
                return view('pages.account.role', compact('query'));
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    }
}
