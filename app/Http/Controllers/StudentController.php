<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    function listOfStudents()
    {
        return Student::all();
    }

    /// Api validation for filed
    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // ✅ Save student if validation passes
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if ($student->save()) {
            return response()->json(['status' => true, 'message' => 'Student Added Successfully'], 201);
        } else {
            return response()->json(['status' => false, 'message' => 'Student Not Added'], 500);
        }
    }


    /*    function addStudent(Request $request)
        {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ];

            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            if ($student->save()) {
                return "Student Added Successfully";
            } else {
                return "Student Not Added";
            }
        }*/

/*    function updateStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return ["result" => "Student Updated Successfully"];
        }else{
            return ["result" => "Student Not Updated"];
        }

    }*/

    public function updateStudent(Request $request, $id)
    {
        // Find the student
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['result' => 'Student Not Found'], 404);
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update student
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if ($student->save()) {
            return response()->json(['status' => true, 'result' => 'Student Updated Successfully']);
        } else {
            return response()->json(['status' => false, 'result' => 'Student Not Updated'], 500);
        }
    }


    public function deleteStudent($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['result' => 'Student Not Found'], 404);
        }

        if ($student->delete()) {
            return response()->json(['result' => 'Student Deleted Successfully']);
        } else {
            return response()->json(['result' => 'Failed to Delete Student'], 500);
        }
    }

}
