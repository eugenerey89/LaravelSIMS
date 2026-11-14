@extends('layouts.app')
@section('title', 'Edit subject')
@section('content')
<h1 class="h3 mb-3">Edit {{ $subject->code }}</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('subjects.update', $subject) }}">@csrf @method('PUT')
        @include('subjects._form')
        <div class="mt-4"><button class="btn btn-primary">Save changes</button> <a href="{{ route('subjects.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
