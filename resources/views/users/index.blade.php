@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add user</a>
</div>
<form class="mb-3" method="GET"><div class="input-group">
    <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by name or email">
    <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button></div></form>
<div class="card"><div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
        <thead><tr><th>Name</th><th>Email</th><th>Added</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($users as $u)
            <tr><td class="fw-medium">{{ $u->name }} @if ($u->is(auth()->user()))<span class="badge text-bg-light border ms-1">You</span>@endif</td>
                <td>{{ $u->email }}</td><td>{{ $u->created_at->format('M d, Y') }}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    @unless ($u->is(auth()->user()))
                    <form class="d-inline" method="POST" action="{{ route('users.destroy', $u) }}" onsubmit="return confirm('Delete {{ $u->name }}?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button></form>
                    @endunless
                </td></tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted py-5">No users found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
