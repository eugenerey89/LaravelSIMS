@extends('layouts.app')
@section('title', 'Add subject')
@section('content')
<h1 class="h3 mb-3">Add subject</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('subjects.store') }}">@csrf
        @include('subjects._form', ['subject' => new \App\Models\Subject])
        <div class="mt-4"><button class="btn btn-primary">Save subject</button> <a href="{{ route('subjects.index') }}" class="btn btn-link">Cancel</a></div>
    </form>
</div></div>
@endsection
