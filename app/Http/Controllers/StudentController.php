<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index(){
        $students = Student::orderBy('id')->get();
        return view('students', ['students' => $students]);
    }

    public function delete($id){

        $student = Student::find($id);

        $students = Student::all();

        if($student){
            $student -> delete();
        }

        return redirect()->route('students')->with('success', 'Student deleted successfully');
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'address' => 'required|string',
            'DOB' => 'required',
            'course' => 'required',
            'year' => 'required',
        ]);
    
        $student = Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'address' => $request->address,
            'course' => $request->course,
            'DOB' => $request->DOB,
            'year' => $request->year,
        ]);
    
        if ($student) {
            return redirect()->route('students')->with('success', 'Student added successfully');
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:students,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'address' => 'required',
            'DOB' => 'required|date',
            'course' => 'required',
            'year' => 'required',
        ]);

        $student = Student::findOrFail($request->id);
        $student->update($request->all());
        return redirect()->route('students');
    }
    
}
