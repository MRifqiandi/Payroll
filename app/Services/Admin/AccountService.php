<?php

namespace App\Services\Admin;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class AccountService
{
    public static function store($role, $name, $email, $password, $rank, $number, $position)
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'rank' => $rank,
            'number' => $number,
            'position' => $position,
        ]);

        $user->assignRole($role);

        return $user;
    }

    public static function update($id, $role, $name, $email)
    {
        $user = User::whereId($id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        $user->update([
            'name' => $name,
            'email' => $email,
        ]);
        $user->syncRoles($role);

        return $user;
    }

    public static function updatePassword($id, $password)
    {
        $user = User::whereId($id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    public static function delete($id)
    {
        $user = User::whereId($id)->first();

        if (!$user) {
            throw new HttpException(404, 'User not found');
        }

        $user->delete();

        return $user;
    }

    public static function getDatatable()
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
