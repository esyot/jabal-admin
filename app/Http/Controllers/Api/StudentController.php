<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return Student::all();
    }

    public function delete($id){

        $student = Student::find($id);
        
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
    
    
}
