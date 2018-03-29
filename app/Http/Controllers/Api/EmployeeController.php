<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Libs\Supports\Result;

class EmployeeController extends Controller
{

    public function index() {

        $employee = Employee::orderBy('employee_no')->get();

        return Result::jsonResponse($employee);
    }
}
