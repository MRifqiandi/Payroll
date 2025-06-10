<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getAllWithRelationsPaginate($perPage = 10)
    {
        return Employee::with('ptkp', 'jabatanFungsional')->paginate($perPage);
    }

    public function findById($id)
    {
        return Employee::findOrFail($id);
    }

    public function find($id)
    {
        return Employee::find($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update($id, array $data)
    {
        $employee = $this->findById($id);
        $employee->update($data);
        return $employee;
    }

    public function deleteById($id)
    {
        $employee = $this->findById($id);

        // Hapus relasi anak sebelum hapus employee
        $employee->bpjs()->delete();
        $employee->tax()->delete();
        $employee->salaries()->delete();
        $employee->salaryRaise()->delete();

        $employee->delete();
    }

    public function getActiveEmployeesPaginate($perPage = 10)
    {
        return Employee::where('statusKepegawaian', 'aktif')->paginate($perPage);
    }
}
