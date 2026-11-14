<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Information System')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-font-sans-serif: 'Public Sans', system-ui, sans-serif;
            --bs-primary: #0f766e; --bs-primary-rgb: 15,118,110;
            --bs-link-color: #0f766e; --bs-link-hover-color: #0a5a54;
            --sis-ink: #10302f; --sis-paper: #f4f6f5;
        }
        body { background: var(--sis-paper); }
        .btn-primary { --bs-btn-bg:#0f766e; --bs-btn-border-color:#0f766e; --bs-btn-hover-bg:#0a5a54; --bs-btn-hover-border-color:#0a5a54; --bs-btn-active-bg:#0a5a54; --bs-btn-active-border-color:#0a5a54; --bs-btn-disabled-bg:#0f766e; --bs-btn-disabled-border-color:#0f766e; }
        .btn-outline-primary { --bs-btn-color:#0f766e; --bs-btn-border-color:#0f766e; --bs-btn-hover-bg:#0f766e; --bs-btn-hover-border-color:#0f766e; --bs-btn-active-bg:#0f766e; }
        .form-control:focus, .form-select:focus { border-color:#0f766e; box-shadow:0 0 0 .2rem rgba(15,118,110,.2); }
        .sidebar { background-color: var(--sis-ink); }
@media (min-width: 992px) {
    .sidebar { background-color: var(--sis-ink) !important; flex: 0 0 250px !important; width: 250px !important; min-height: 100vh; }
}
@media (max-width: 991.98px) {
    .sidebar { --bs-offcanvas-width: 260px; --bs-offcanvas-bg: var(--sis-ink); --bs-offcanvas-color: #fff; }
}
        .sidebar .nav-link { color: #b8cfcc; border-radius: .5rem; padding: .6rem .85rem; }
        .sidebar .nav-link:hover { color:#fff; background: rgba(255,255,255,.06); }
        .sidebar .nav-link.active { color:#fff; background: rgba(255,255,255,.12); }
        .sidebar .nav-link i { width: 1.4rem; display:inline-block; }
        .card { border: 1px solid #dfe5e3; border-radius: .75rem; }
        .table > :not(caption) > * > * { padding: .8rem 1rem; }
        .table thead th { font-weight: 600; color:#55706d; background:#fafbfa; }
        .stat-value { font-size: 2rem; font-weight: 700; line-height: 1; }
        .main-wrap { min-width: 0; }
    </style>
    @stack('head')
</head>
<body>
    @yield('body')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
