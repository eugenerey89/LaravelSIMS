<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $enrollments = Enrollment::with(['student', 'subject'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->q, fn ($q, $t) => $q->where(fn ($w) => $w
                ->whereHas('student', fn ($s) => $s->search($t))
                ->orWhereHas('subject', fn ($s) => $s->search($t))))
            ->latest()->paginate(10)->withQueryString();

        return view('enrollments.index', compact('enrollments'));
    }

    public function create(Request $request)
    {
        return view('enrollments.create', [
            'students' => Student::orderBy('last_name')->get(),
            'subjects' => Subject::orderBy('code')->get(),
            'selectedStudent' => $request->student_id,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $exists = Enrollment::where($request->only('student_id', 'subject_id', 'school_year', 'semester'))->exists();
        if ($exists) {
            return back()->withInput()->withErrors(['subject_id' => 'This student is already enrolled in that subject for the chosen term.']);
        }

        Enrollment::create($data);
        return redirect()->route('enrollments.index')->with('success', 'Student enrolled.');
    }

    public function edit(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'subject']);
        return view('enrollments.edit', compact('enrollment'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validate([
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'],
            'semester' => ['required', Rule::in(Enrollment::SEMESTERS)],
            'status' => ['required', Rule::in(Enrollment::STATUSES)],
            'grade' => 'nullable|numeric|between:1,5',
        ]));

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'],
            'semester' => ['required', Rule::in(Enrollment::SEMESTERS)],
            'status' => ['required', Rule::in(Enrollment::STATUSES)],
            'grade' => 'nullable|numeric|between:1,5',
        ]);
    }
}
