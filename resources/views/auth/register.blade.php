@extends('layouts.guest')
@section('title', 'Register')
@section('heading', 'Create your account')
@section('sub', 'Set up access for the records office')

@section('content')
<form method="POST" action="{{ route('register') }}">@csrf
    @foreach ([['name','Full name','text'],['email','Email','email'],['password','Password','password'],['password_confirmation','Confirm password','password']] as [$f,$label,$type])
    <div class="mb-3">
        <label class="form-label" for="{{ $f }}">{{ $label }}</label>
        <input id="{{ $f }}" type="{{ $type }}" name="{{ $f }}" @if($type!=='password') value="{{ old($f) }}" @endif class="form-control @error($f) is-invalid @enderror" required>
        @error($f)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    @endforeach
    <button class="btn btn-primary w-100">Create account</button>
</form>
<p class="text-center small mt-4 mb-0">Already registered? <a href="{{ route('login') }}">Log in</a></p>
@endsection
