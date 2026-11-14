@extends('layouts.app')
@section('title', 'Students')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add student</a>
</div>

<form class="mb-3" method="GET">
    <div class="input-group">
        <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by name, student number, email or course">
        <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </div>
</form>

<div class="card"><div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
        <thead><tr><th>Student no.</th><th>Name</th><th>Course</th><th>Year</th><th>Subjects</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($students as $s)
            <tr>
                <td>{{ $s->student_number }}</td>
                <td><a href="{{ route('students.show', $s) }}" class="fw-medium text-decoration-none">{{ $s->full_name }}</a><div class="small text-muted">{{ $s->email }}</div></td>
                <td>{{ $s->course }}</td><td>{{ $s->year_level }}</td><td>{{ $s->enrollments_count }}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('students.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form class="d-inline" method="POST" action="{{ route('students.destroy', $s) }}" onsubmit="return confirm('Delete {{ $s->full_name }} and all their enrollments?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-5">No students found. <a href="{{ route('students.create') }}">Add the first student.</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $students->links() }}</div>
@endsection
