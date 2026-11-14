@extends('layouts.app')
@section('title', 'Enrollments')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Enrollments</h1>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Enroll student</a>
</div>
<form class="row g-2 mb-3" method="GET">
    <div class="col-md-8"><input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by student or subject"></div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">All statuses</option>
            @foreach (\App\Models\Enrollment::STATUSES as $s)<option @selected(request('status') === $s)>{{ $s }}</option>@endforeach
        </select>
    </div>
    <div class="col-md-1 d-grid"><button class="btn btn-outline-primary">Filter</button></div>
</form>
<div class="card"><div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
        <thead><tr><th>Student</th><th>Subject</th><th>Term</th><th>Grade</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($enrollments as $e)
            <tr><td>{{ $e->student->full_name }}</td><td>{{ $e->subject->code }} · {{ $e->subject->name }}</td>
                <td>{{ $e->school_year }}, {{ $e->semester }}</td><td>{{ $e->grade ?? '—' }}</td>
                <td>@include('enrollments._badge', ['status' => $e->status])</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('enrollments.edit', $e) }}" class="btn btn-sm btn-outline-primary">Update</a>
                    <form class="d-inline" method="POST" action="{{ route('enrollments.destroy', $e) }}" onsubmit="return confirm('Delete this enrollment?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </td></tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-5">No enrollments found. <a href="{{ route('enrollments.create') }}">Enroll a student.</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $enrollments->links() }}</div>
@endsection
