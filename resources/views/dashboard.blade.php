@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-1">Dashboard</h1>
    <p class="text-muted mb-0">Where the school year stands today.</p>
</div>

<div class="row g-3 mb-4">
    @foreach ([
        ['Students', $stats['students'], 'bi-people', "{$stats['new_students']} added in the last 30 days"],
        ['Subjects', $stats['subjects'], 'bi-journal-bookmark', "{$stats['total_units']} total units offered"],
        ['Enrollments', $stats['enrollments'], 'bi-card-checklist', "{$stats['avg_load']} active subjects per student"],
    ] as [$label, $value, $icon, $note])
    <div class="col-12 col-md-4">
        <div class="card h-100"><div class="card-body d-flex justify-content-between">
            <div>
                <div class="text-muted mb-2">{{ $label }}</div>
                <div class="stat-value">{{ $value }}</div>
                <div class="small text-muted mt-2">{{ $note }}</div>
            </div>
            <i class="bi {{ $icon }} fs-2 text-primary"></i>
        </div></div>
    </div>
    @endforeach
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card h-100"><div class="card-body">
            <h2 class="h6 mb-3">Enrollment statistics</h2>
            @php $total = max($byStatus->sum(), 1); $colors = ['Enrolled'=>'primary','Completed'=>'success','Dropped'=>'danger']; @endphp
            @foreach (['Enrolled','Completed','Dropped'] as $s)
                @php $n = $byStatus[$s] ?? 0; @endphp
                <div class="d-flex justify-content-between small mb-1"><span>{{ $s }}</span><span>{{ $n }}</span></div>
                <div class="progress mb-3" style="height:8px"><div class="progress-bar bg-{{ $colors[$s] }}" style="width:{{ $n / $total * 100 }}%"></div></div>
            @endforeach
        </div></div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100"><div class="card-body">
            <h2 class="h6 mb-3">Student statistics</h2>
            <div class="small text-muted mb-1">By course</div>
            @forelse ($byCourse as $c)
                <div class="d-flex justify-content-between small py-1 border-bottom"><span>{{ $c->course }}</span><strong>{{ $c->total }}</strong></div>
            @empty <p class="text-muted small">No students yet.</p> @endforelse
            <div class="small text-muted mt-3 mb-1">By year level</div>
            <div class="d-flex gap-2 flex-wrap">
                @forelse ($byYear as $year => $n)
                    <span class="badge text-bg-light border">Year {{ $year }}: {{ $n }}</span>
                @empty <span class="text-muted small">—</span> @endforelse
            </div>
        </div></div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100"><div class="card-body">
            <h2 class="h6 mb-3">System summary</h2>
            <p class="small text-muted">Most enrolled subjects</p>
            @forelse ($topSubjects as $s)
                <div class="d-flex justify-content-between small py-1 border-bottom"><span>{{ $s->code }} · {{ $s->name }}</span><strong>{{ $s->enrollments_count }}</strong></div>
            @empty <p class="text-muted small">No subjects yet.</p> @endforelse
        </div></div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h2 class="h6 mb-0">Recent enrollments</h2>
        <a href="{{ route('enrollments.create') }}" class="btn btn-sm btn-primary">Enroll a student</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Student</th><th>Subject</th><th>Term</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($recent as $e)
                <tr><td>{{ $e->student->full_name }}</td><td>{{ $e->subject->code }}</td><td>{{ $e->school_year }}, {{ $e->semester }}</td>
                    <td>@include('enrollments._badge', ['status' => $e->status])</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No enrollments yet. Enroll a student to get started.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
