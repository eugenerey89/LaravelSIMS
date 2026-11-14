@extends('layouts.app')
@section('title', 'Subjects')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Subjects</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add subject</a>
</div>
<form class="mb-3" method="GET"><div class="input-group">
    <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by code or name">
    <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button></div></form>
<div class="card"><div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
        <thead><tr><th>Code</th><th>Name</th><th>Units</th><th>Enrolled</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($subjects as $s)
            <tr><td class="fw-medium">{{ $s->code }}</td><td>{{ $s->name }}</td><td>{{ $s->units }}</td><td>{{ $s->enrollments_count }}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('subjects.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form class="d-inline" method="POST" action="{{ route('subjects.destroy', $s) }}" onsubmit="return confirm('Delete {{ $s->code }} and its enrollments?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </td></tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-5">No subjects found. <a href="{{ route('subjects.create') }}">Add the first subject.</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $subjects->links() }}</div>
@endsection
