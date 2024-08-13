<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartments(string $company)
    {
        return Department::query()
            ->where('company', $company)
            ->with('users')
            ->get();
    }
}
