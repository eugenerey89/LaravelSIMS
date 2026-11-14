<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::search($request->q)->withCount('enrollments')
            ->orderBy('last_name')->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        Student::create($this->validated($request));
        return redirect()->route('students.index')->with('success', 'Student added.');
    }

    public function show(Student $student)
    {
        $student->load('enrollments.subject');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student));
        return redirect()->route('students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted along with their enrollments.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'student_number' => ['required', 'string', 'max:50', Rule::unique('students')->ignore($student)],
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student)],
            'birthdate' => 'nullable|date|before:today',
            'gender' => 'nullable|in:Male,Female,Other',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'course' => 'required|string|max:150',
            'year_level' => 'required|integer|between:1,6',
        ]);
    }
}
