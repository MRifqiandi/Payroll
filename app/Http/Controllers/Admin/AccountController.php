<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'rank' => 'required',
            'number' => 'required',
            'position' => 'required',
        ]);

        DB::beginTransaction();
        AccountService::store($request->role, $request->name, $request->email, $request->password, $request->rank, $request->number, $request->position);
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
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        DB::beginTransaction();
        AccountService::update($request->id, $request->role, $request->name, $request->email);
        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Account updated successfully'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required|min:8',
        ]);

        AccountService::updatePassword($request->id, $request->password);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        AccountService::delete($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Account deleted successfully'
        ]);
    }

    public function getDatatable()
    {
        return AccountService::getDatatable();
    }
}
