@extends('layouts.app')
@section('title', 'Add user')
@section('content')
<h1 class="h3 mb-3">Add user</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('users.store') }}">@csrf
        @include('users._form', ['user' => new \App\Models\User])
        <div class="mt-4"><button class="btn btn-primary">Save user</button> <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
