<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return StudentResource::collection(
            Student::search($request->q)->orderBy('last_name')->paginate($request->integer('per_page', 15))
        );
    }

    public function show(Student $student)
    {
        return new StudentResource($student->load('enrollments.subject'));
    }

    public function store(Request $request)
    {
        $student = Student::create($this->validated($request));
        return (new StudentResource($student))->response()->setStatusCode(201);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student, true));
        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }

    private function validated(Request $request, ?Student $student = null, bool $partial = false): array
    {
        $req = $partial ? 'sometimes|required' : 'required';

        return $request->validate([
            'student_number' => [$req, 'string', 'max:50', Rule::unique('students')->ignore($student)],
            'first_name' => "$req|string|max:100",
            'last_name' => "$req|string|max:100",
            'email' => [$req, 'email', 'max:255', Rule::unique('students')->ignore($student)],
            'birthdate' => 'nullable|date|before:today',
            'gender' => 'nullable|in:Male,Female,Other',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'course' => "$req|string|max:150",
            'year_level' => "$req|integer|between:1,6",
        ]);
    }
}
