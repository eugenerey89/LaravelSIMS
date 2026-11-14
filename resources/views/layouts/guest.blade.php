@extends('layouts.base')

@section('body')
<div class="min-vh-100 d-flex align-items-center justify-content-center p-3" style="background:var(--sis-ink)">
    <div class="card shadow-lg border-0" style="width:100%;max-width:420px">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <i class="bi bi-mortarboard-fill text-primary fs-1"></i>
                <h1 class="h4 mt-2 mb-1">@yield('heading')</h1>
                <p class="text-muted small mb-0">@yield('sub')</p>
            </div>
            @if (session('success'))<div class="alert alert-success py-2">{{ session('success') }}</div>@endif
            @yield('content')
        </div>
    </div>
</div>
@endsection
