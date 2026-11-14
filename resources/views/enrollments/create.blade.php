@extends('layouts.app')
@section('title', 'Enroll student')
@section('content')
<h1 class="h3 mb-3">Enroll student</h1>
@php $y = now()->year; $sy = old('school_year', $y . '-' . ($y + 1)); @endphp
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('enrollments.store') }}">@csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="student_id">Student</label>
                <select id="student_id" name="student_id" class="form-select @error('student_id') is-invalid @enderror">
                    <option value="">Choose a student</option>
                    @foreach ($students as $s)<option value="{{ $s->id }}" @selected(old('student_id', $selectedStudent) == $s->id)>{{ $s->last_name }}, {{ $s->first_name }} ({{ $s->student_number }})</option>@endforeach
                </select>
                @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="subject_id">Subject</label>
                <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                    <option value="">Choose a subject</option>
                    @foreach ($subjects as $s)<option value="{{ $s->id }}" @selected(old('subject_id') == $s->id)>{{ $s->code }} · {{ $s->name }}</option>@endforeach
                </select>
                @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="school_year">School year</label>
                <input id="school_year" name="school_year" value="{{ $sy }}" placeholder="2026-2027" class="form-control @error('school_year') is-invalid @enderror">
                @error('school_year')<div class="invalid-feedback">Use the format 2026-2027.</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="semester">Semester</label>
                <select id="semester" name="semester" class="form-select">
                    @foreach (\App\Models\Enrollment::SEMESTERS as $s)<option @selected(old('semester') === $s)>{{ $s }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="status">Status</label>
                <select id="status" name="status" class="form-select">
                    @foreach (\App\Models\Enrollment::STATUSES as $s)<option @selected(old('status', 'Enrolled') === $s)>{{ $s }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Enroll student</button> <a href="{{ route('enrollments.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
