<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    public function createDepartment(array $data): Department
    {
        $department = new Department();

        foreach ($data as $key => $val) {
            $department->$key = $val;
        }

        $department->save();

        return $department;
    }

    public function firstOrCreate(array $keys, array $data): Department
    {
        return Department::query()->firstOrCreate($keys, $data);
    }
}