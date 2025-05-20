<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Menampilkan data karyawan milik user yang sedang login.
     */
    public function profile()
    {
    $user = Auth::user();

    if (!$user->employee_id) {
        // employee_id null, kita set $employee null, jangan abort 404
        $employee = null;
    } else {
        $employee = Employee::find($user->employee_id);
    }

        return view('pages.employee.index', compact('employee'));
    }

    /**
     * (Opsional) Jika ingin nanti tambahkan fitur edit profil.
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user->employee_id) {
            abort(404, 'Data karyawan tidak ditemukan.');
        }

        $employee = Employee::findOrFail($user->employee_id);

        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * (Opsional) Proses update data profil karyawan.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user->employee_id) {
            abort(404, 'Data karyawan tidak ditemukan.');
        }

        $employee = Employee::findOrFail($user->employee_id);

        $request->validate([
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $employee->update($request->only([
            'alamat',
            'telepon',
            // Tambahkan kolom lain jika perlu
        ]));

        return redirect()->route('employee.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function showOwnData()
{
    $user = auth()->user();
    $employee = null;

    if ($user->employee_id) {
        $employee = Employee::find($user->employee_id);
    }

    return view('employee.index', compact('employee'));
}

}
