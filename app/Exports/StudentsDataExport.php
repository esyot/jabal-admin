<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class StudentsDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $students;

    public function __construct()
    {
        $this->students = Student::all();
    }

    public function view(): View
    {
        return view('students-list', [
            'students' => $this->students
        ]);
    }
}
