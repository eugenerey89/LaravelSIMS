@extends('layouts.app')
@section('title', $student->full_name)
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">{{ $student->full_name }}</h1>
    <div>
        <a href="{{ route('enrollments.create', ['student_id' => $student->id]) }}" class="btn btn-primary">Enroll in a subject</a>
        <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-primary">Edit</a>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-4"><div class="card"><div class="card-body">
        <dl class="mb-0 small">
            @foreach ([['Student no.',$student->student_number],['Email',$student->email],['Course',$student->course],['Year level',$student->year_level],['Gender',$student->gender ?? '—'],['Birthdate',$student->birthdate?->format('M d, Y') ?? '—'],['Phone',$student->phone ?? '—'],['Address',$student->address ?? '—']] as [$k,$val])
                <dt class="text-muted fw-normal">{{ $k }}</dt><dd class="fw-medium">{{ $val }}</dd>
            @endforeach
        </dl>
    </div></div></div>
    <div class="col-lg-8"><div class="card">
        <div class="card-header bg-white"><h2 class="h6 mb-0">Enrollments</h2></div>
        <div class="table-responsive"><table class="table mb-0 align-middle">
            <thead><tr><th>Subject</th><th>Term</th><th>Grade</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($student->enrollments as $e)
                <tr><td>{{ $e->subject->code }} · {{ $e->subject->name }}</td><td>{{ $e->school_year }}, {{ $e->semester }}</td><td>{{ $e->grade ?? '—' }}</td><td>@include('enrollments._badge', ['status' => $e->status])</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">This student isn't enrolled in any subject yet.</td></tr>
            @endforelse
            </tbody>
        </table></div>
    </div></div>
</div>
@endsection
