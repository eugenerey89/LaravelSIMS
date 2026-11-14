@extends('layouts.app')
@section('title', 'Edit student')
@section('content')
<h1 class="h3 mb-3">Edit {{ $student->full_name }}</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('students.update', $student) }}">@csrf @method('PUT')
        @include('students._form')
        <div class="mt-4"><button class="btn btn-primary">Save changes</button> <a href="{{ route('students.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
