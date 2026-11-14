<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'subjects' => Subject::count(),
            'enrollments' => Enrollment::count(),
            'new_students' => Student::where('created_at', '>=', now()->subDays(30))->count(),
            'total_units' => Subject::sum('units'),
            'avg_load' => Student::count() ? round(Enrollment::where('status', 'Enrolled')->count() / Student::count(), 1) : 0,
        ];

        $byStatus = Enrollment::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $byCourse = Student::selectRaw('course, count(*) as total')->groupBy('course')->orderByDesc('total')->get();
        $byYear = Student::selectRaw('year_level, count(*) as total')->groupBy('year_level')->orderBy('year_level')->pluck('total', 'year_level');
        $topSubjects = Subject::withCount('enrollments')->orderByDesc('enrollments_count')->take(5)->get();
        $recent = Enrollment::with(['student', 'subject'])->latest()->take(6)->get();

        return view('dashboard', compact('stats', 'byStatus', 'byCourse', 'byYear', 'topSubjects', 'recent'));
    }
}
