@extends('layouts.app')
@section('title', 'Update enrollment')
@section('content')
<h1 class="h3 mb-1">Update enrollment</h1>
<p class="text-muted mb-3">{{ $enrollment->student->full_name }} · {{ $enrollment->subject->code }} {{ $enrollment->subject->name }}</p>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('enrollments.update', $enrollment) }}">@csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label" for="school_year">School year</label>
                <input id="school_year" name="school_year" value="{{ old('school_year', $enrollment->school_year) }}" class="form-control @error('school_year') is-invalid @enderror">
                @error('school_year')<div class="invalid-feedback">Use the format 2026-2027.</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label" for="semester">Semester</label>
                <select id="semester" name="semester" class="form-select">
                    @foreach (\App\Models\Enrollment::SEMESTERS as $s)<option @selected(old('semester', $enrollment->semester) === $s)>{{ $s }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="status">Status</label>
                <select id="status" name="status" class="form-select">
                    @foreach (\App\Models\Enrollment::STATUSES as $s)<option @selected(old('status', $enrollment->status) === $s)>{{ $s }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="grade">Grade (1.00–5.00)</label>
                <input id="grade" type="number" step="0.01" min="1" max="5" name="grade" value="{{ old('grade', $enrollment->grade) }}" class="form-control @error('grade') is-invalid @enderror">
                @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Save changes</button> <a href="{{ route('enrollments.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
