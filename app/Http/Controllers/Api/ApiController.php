<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
    //Add Employee(Post, formdata)

    public function addEmployee(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            "name" => 'required|string|max:50',
            "email" => 'required|email|unique:employees,email', // Specify the column for uniqueness
            "gender" => 'required|string'
        ]);

        // Create a new employee record
        $data = Employee::create($request->only(['name', 'email', 'phone_number', 'gender'])); // Use only() to limit the fields

        // Return a success response with the created employee data
        return response()->json([
            "status" => "success",
            "message" => "Employee created!",
            //"data" => $data 
        ], 201);
    }

    //List Employee(Get)

    public function listEmployee()
    {

        $data = Employee::all();

        return response()->json([
            "status" => "success",
            "data" => $data,
            "message" => $data->isEmpty() ? 'No record found' : 'Employee list'
        ]);
    }

    //Single Employee(Get)

    public function getSingleEmployee($employeeId)
    {
        try {
            $data = Employee::findOrFail($employeeId);

            return response()->json([
                "status" => "success",
                "data" => $data,
                "message" => 'Employee found!'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "status" => "error",
                "data" => null,
                "message" => 'No record found'
            ], 404); // You can set the HTTP status code to 404
        }
    }

    //Update Employee (PUT, formdata)

    public function updateEmployee(Request $request, $employeeId)
    {
        // Validate the incoming request data
        $request->validate([
            "name" => 'sometimes|required|string|max:50',
            "email" => 'sometimes|required|email|unique:employees,email,' . $employeeId,
            "phone_number" => 'sometimes|required|string|max:15',
            "gender" => 'sometimes|required|string'
        ]);

        // Find the employee by ID
        $employee = Employee::find($employeeId);

        // Check if the employee exists
        if (!$employee) {
            return response()->json([
                "status" => "error",
                "message" => "Employee not found"
            ], 404);
        }

        // Update the employee's information
        $employee->update($request->only(['name', 'email', 'phone_number', 'gender']));

        // Return a success response
        return response()->json([
            "status" => "success",
            "message" => "Employee updated successfully!",
        ], 200);
    }

    //Delete Employee

    public function deleteEmployee($employeeId)
    {
        // Find the employee by ID
        $employee = Employee::find($employeeId);

        // Check if the employee exists
        if (!$employee) {
            return response()->json([
                "status" => "error",
                "message" => "Employee not found"
            ], 404);
        }

        // Delete the employee
        $employee->delete();

        // Return a success response
        return response()->json([
            "status" => "success",
            "message" => "Employee deleted successfully!"
        ], 200);
    }
}
