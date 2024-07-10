<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Events\UserActions;
use Illuminate\Support\Facades\Auth;


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

        $user = Auth::user();

        event(new UserActions($user->name, $user->email, "Deleted a student named $student->first_name $student->last_name.", 'students'));

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

            $user = Auth::user();

            event(new UserActions($user->name, $user->email, "Added a student named $request->first_name $request->last_name.", 'students'));

            return redirect()->route('students')->with('success', 'Student added successfully');
        }
    }

    public function update(Request $request)
    {
       
        $request->validate([
            'id' => 'required|exists:students,id',
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'middle_name' => 'sometimes|required',
            'address' => 'sometimes|required',
            'DOB' => 'sometimes|required|date',
            'course' => 'sometimes|required',
            'year' => 'sometimes|required',
        ]);
    
      
        $student = Student::findOrFail($request->id);
    
       
        $user = Auth::user();
    
        $fieldNames = [
            'first_name' => 'first name',
            'last_name' => 'last name',
            'middle_name' => 'middle name',
            'address' => 'address',
            'DOB' => 'date of birth',
            'course' => 'course',
            'year' => 'year',
        ];
    
      
        $excludedFields = ['_token', '_method', 'id'];

        $changes = [];

        foreach ($request->except($excludedFields) as $key => $value) {
            if ($student->$key != $value && isset($fieldNames[$key])) {
                $changes[] = "{$fieldNames[$key]} from '{$student->$key}' to '$value'";
            }
        }

        $changesStr = implode(', ', $changes);

        $student->update($request->except($excludedFields));
    
        if (!empty($changesStr)) {
            event(new UserActions($user->name, $user->email, "Updated student's $changesStr.", 'students'));
        }
    
        return redirect()->route('students');
    }
    
    
}
