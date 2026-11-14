@extends('layouts.app')
@section('title', 'Add student')
@section('content')
<h1 class="h3 mb-3">Add student</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('students.store') }}">@csrf
        @include('students._form', ['student' => new \App\Models\Student])
        <div class="mt-4"><button class="btn btn-primary">Save student</button> <a href="{{ route('students.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
