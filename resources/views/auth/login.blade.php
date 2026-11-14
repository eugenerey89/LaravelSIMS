@extends('layouts.guest')
@section('title', 'Log in')
@section('heading', 'Log in')
@section('sub', 'Access the student records system')

@section('content')
<form method="POST" action="{{ route('login') }}">@csrf
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input id="password" type="password" name="password" class="form-control" required>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Keep me signed in</label>
    </div>
    <button class="btn btn-primary w-100">Log in</button>
</form>
<p class="text-center small mt-4 mb-0">No account yet? <a href="{{ route('register') }}">Create one</a></p>
@endsection
