<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeSingleResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        if ($request->has('search')) {
            $employees = Employee::where("first_name", "like", "%{$request->search}%")
                ->orWhere("last_name", "like", "%{$request->search}%")
                ->get();
        } else if($request->has('department_id')) {
            $employees = Employee::where("department_id", "like", "%{$request->department_id}%")->get();
        }

        return EmployeeResource::collection($employees);
    }

    public function create()
    {
        //
    }

    public function store(EmployeeStoreRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json($employee);
    }

    public function show(Employee $employee)
    {
        return new EmployeeSingleResource($employee);
    }

    public function edit($id)
    {
        //
    }

    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

//        return response()->json('Employee Updated Successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json('Employee Deleted Successfully');
    }
}
