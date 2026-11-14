@extends('layouts.base')

@section('body')
<div class="d-flex min-vh-100">
    <aside class="sidebar offcanvas-lg offcanvas-start text-white p-3 flex-shrink-0" tabindex="-1" id="sidebar">
        <div class="d-flex align-items-center mb-4 px-2">
            <i class="bi bi-mortarboard-fill fs-3 me-2"></i>
            <span class="fw-semibold fs-5">Campus Records</span>
            <button type="button" class="btn-close btn-close-white ms-auto d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
        </div>
        <ul class="nav nav-pills flex-column gap-1 mb-auto">
            <li><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
            <li><a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Students</a></li>
            <li><a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Subjects</a></li>
            <li><a href="{{ route('enrollments.index') }}" class="nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}"><i class="bi bi-card-checklist"></i> Enrollments</a></li>
            <li><a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> Users</a></li>
        </ul>
        <hr class="border-secondary">
        <div class="px-2 small text-white-50 mb-2">Signed in as<br><span class="text-white">{{ auth()->user()->name }}</span></div>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="btn btn-sm btn-outline-light w-100"><i class="bi bi-box-arrow-right me-1"></i> Log out</button>
        </form>
    </aside>

    <div class="flex-grow-1 main-wrap">
        <header class="d-lg-none bg-white border-bottom px-3 py-2 d-flex align-items-center">
            <button class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="offcanvas" data-bs-target="#sidebar"><i class="bi bi-list"></i></button>
            <strong>Campus Records</strong>
        </header>
        <main class="p-3 p-md-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
@endsection
