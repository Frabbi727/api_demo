<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    function listOfStudents()
    {
        return Student::all();
    }

    function addStudent(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($student->save()) {
            return "Student Added Successfully";
        } else {
            return "Student Not Added";
        }
    }

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
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['result' => 'Student Not Found'], 404);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        if ($student->save()) {
            return response()->json(['result' => 'Student Updated Successfully']);
        } else {
            return response()->json(['result' => 'Student Not Updated'], 500);
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
