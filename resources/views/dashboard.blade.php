
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SIMS | Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        :root {
            --navy: #10294e;
            --blue: #0875ed;
            --page: #f3f7ff;
            --text: #101d3a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--page);
            color: var(--text);
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background: linear-gradient(
                160deg, #10294e, #102b51
            );
            color: white;
            z-index: 1050;
            transition: transform .3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 25px 22px 30px;
            font-size: 26px;
            font-weight: 800;
        }

        .sidebar-brand i {
            font-size: 32px;
        }

        .sidebar-nav {
            padding: 0 12px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #fff;
            text-decoration: none;
            padding: 13px 17px;
            margin-bottom: 7px;
            border-radius: 7px;
            font-size: 14px;
            transition: .2s;
            width: 100%;
            border: none;
            background: transparent;
            text-align: left;
        }

        .nav-link-custom i {
            font-size: 19px;
            width: 22px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: #0862c9;
            color: white;
        }

        .nav-divider {
            border-top: 1px solid rgba(255,255,255,.12);
            margin: 22px 12px 14px;
        }

        /* MAIN AREA */
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
        }

        .topbar {
            height: 66px;
            background: rgba(255,255,255,.94);
            border-bottom: 1px solid #e3eaf4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 23px;
            color: #10294e;
            cursor: pointer;
        }

        .admin-button {
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            background: none;
            color: #101d3a;
            font-size: 14px;
            font-weight: 700;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #d4dce8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            color: #10294e;
        }

        .dashboard-content {
            padding: 30px 34px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .welcome-text {
            font-size: 15px;
            color: #344765;
            margin-bottom: 28px;
        }

        /* STATISTICS */
        .stat-card {
            display: flex;
            align-items: center;
            gap: 17px;
            min-height: 132px;
            padding: 24px;
            border-radius: 9px;
            color: white;
            box-shadow: 0 7px 18px rgba(20,50,100,.08);
        }

        .stat-card i {
            font-size: 43px;
        }

        .stat-label {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.1;
        }

        .stat-blue {
            background: linear-gradient(125deg, #0877ff, #1475ef);
        }

        .stat-green {
            background: linear-gradient(125deg, #08a878, #19b782);
        }

        .stat-purple {
            background: linear-gradient(125deg, #7651ed, #7861e9);
        }

        .stat-orange {
            background: linear-gradient(125deg, #ff950c, #ffa71c);
        }

        /* CONTENT PANELS */
        .dashboard-panel {
            background: white;
            border: 1px solid #e6ecf6;
            border-radius: 9px;
            box-shadow: 0 4px 15px rgba(20,50,100,.05);
            height: 100%;
            overflow: hidden;
        }

        .panel-heading {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-heading h5 {
            font-size: 17px;
            font-weight: 800;
            margin: 0;
        }

        .panel-heading a {
            font-size: 13px;
            font-weight: 700;
            color: #0875ed;
            text-decoration: none;
        }

        .chart-area {
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 20px;
        }

        .chart-container {
            width: 180px;
            height: 180px;
            position: relative;
            flex-shrink: 0;
        }

        .chart-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
        }

        .chart-center strong {
            display: block;
            font-size: 27px;
            line-height: 1;
        }

        .chart-center span {
            font-size: 13px;
        }

        .chart-legend {
            flex: 1;
            max-width: 190px;
        }

        .legend-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-row strong {
            margin-left: auto;
        }

        /* ACTIVITY */
        .activity-list {
            padding: 8px 20px 16px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 16px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .activity-description {
            flex: 1;
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .activity-time {
            font-size: 11px;
            color: #51617c;
            white-space: nowrap;
        }

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */
        @media (max-width: 1199px) {
            .stat-card {
                padding: 19px;
            }

            .chart-area {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1040;
            }
        }

        @media (max-width: 576px) {
            .dashboard-content {
                padding: 22px 16px;
            }

            .topbar {
                padding: 0 16px;
            }

            .page-title {
                font-size: 26px;
            }

            .chart-area {
                flex-direction: column;
            }

            .chart-legend {
                width: 100%;
                max-width: 250px;
            }

            .activity-item {
                flex-wrap: wrap;
            }

            .activity-time {
                margin-left: 25px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill"></i>
            <span>SIMS</span>
        </div>

        <nav class="sidebar-nav">

            <a href="{{ route('dashboard') }}"
               class="nav-link-custom active">
                <i class="bi bi-house-door-fill"></i>
                Dashboard
            </a>

            @if(Route::has('students.index'))
                <a href="{{ route('students.index') }}"
                   class="nav-link-custom">
                    <i class="bi bi-people-fill"></i>
                    Students
                </a>
            @endif

            @if(Route::has('subjects.index'))
                <a href="{{ route('subjects.index') }}"
                   class="nav-link-custom">
                    <i class="bi bi-book-fill"></i>
                    Subjects
                </a>
            @endif

            @if(Route::has('enrollments.index'))
                <a href="{{ route('enrollments.index') }}"
                   class="nav-link-custom">
                    <i class="bi bi-clipboard2-check-fill"></i>
                    Enrollments
                </a>
            @endif

            @if(Route::has('users.index'))
                <a href="{{ route('users.index') }}"
                   class="nav-link-custom">
                    <i class="bi bi-shield-fill"></i>
                    Users
                </a>
            @endif

            <div class="nav-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="nav-link-custom">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <div class="sidebar-overlay"
         id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOP NAVBAR -->
        <header class="topbar">

            <button class="menu-toggle"
                    id="menuToggle"
                    aria-label="Toggle sidebar"
                    aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>

            <div class="dropdown">

                <button class="admin-button dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    <span class="admin-avatar">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    <span>
                        {{ Auth::user()->name }}
                    </span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    @if(Route::has('profile.edit'))
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-gear me-2"></i>
                                Profile
                            </a>
                        </li>
                    @endif

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST"
                              action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </header>

        <!-- DASHBOARD -->
        <div class="dashboard-content">

            <h1 class="page-title">Dashboard</h1>

            <p class="welcome-text">
                Welcome back, {{ Auth::user()->name }}!
            </p>

            <!-- STATISTICS CARDS -->
            <div class="row g-3 mb-4">

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-blue">
                        <i class="bi bi-people-fill"></i>

                        <div>
                            <div class="stat-label">
                                Total Students
                            </div>

                            <div class="stat-value">
                                {{ number_format($studentCount) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-green">
                        <i class="bi bi-book-half"></i>

                        <div>
                            <div class="stat-label">
                                Total Subjects
                            </div>

                            <div class="stat-value">
                                {{ number_format($subjectCount) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-purple">
                        <i class="bi bi-clipboard2-check-fill"></i>

                        <div>
                            <div class="stat-label">
                                Total Enrollments
                            </div>

                            <div class="stat-value">
                                {{ number_format($enrollmentCount) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card stat-orange">
                        <i class="bi bi-people-fill"></i>

                        <div>
                            <div class="stat-label">
                                Users
                            </div>

                            <div class="stat-value">
                                {{ number_format($userCount) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CHARTS AND RECENT ACTIVITY -->
            <div class="row g-4">

                <!-- ENROLLMENT OVERVIEW -->
                <div class="col-xl-6">

                    <div class="dashboard-panel">

                        <div class="panel-heading">
                            <h5>Enrollment Overview</h5>
                        </div>

                        <div class="chart-area">

                            <div class="chart-container">

                                <canvas id="enrollmentChart"></canvas>

                                <div class="chart-center">
                                    <strong>
                                        {{ number_format($enrollmentCount) }}
                                    </strong>
                                    <span>Total</span>
                                </div>

                            </div>

                            @php
                                $chartTotal = array_sum($statuses);
                            @endphp

                            <div class="chart-legend">

                                @foreach([
                                    'enrolled' => ['Enrolled', '#0875ed'],
                                    'pending' => ['Pending', '#ff9812'],
                                    'dropped' => ['Dropped', '#a1a6ae']
                                ] as $key => $legend)

                                    <div class="legend-row">

                                        <span class="legend-dot"
                                              style="background: {{ $legend[1] }}">
                                        </span>

                                        <span>{{ $legend[0] }}</span>

                                        <strong>
                                            {{ $chartTotal > 0
                                                ? round($statuses[$key] / $chartTotal * 100)
                                                : 0 }}%
                                        </strong>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>
                </div>

                <!-- RECENT ACTIVITY -->
                <div class="col-xl-6">

                    <div class="dashboard-panel">

                        <div class="panel-heading">
                            <h5>Recent Activity</h5>
                        </div>

                        <div class="activity-list">

                            @forelse($activities as $activity)

                                @php
                                    $dotColor = match($activity['type']) {
                                        'student' => '#8539e9',
                                        'enrollment' => '#ff9812',
                                        'subject' => '#0875ed',
                                        default => '#a1a6ae'
                                    };
                                @endphp

                                <div class="activity-item">

                                    <span class="activity-dot"
                                          style="background: {{ $dotColor }}">
                                    </span>

                                    <span class="activity-description">
                                        {{ $activity['description'] }}
                                    </span>

                                    <span class="activity-time">
                                        {{ \Carbon\Carbon::parse(
                                            $activity['created_at']
                                        )->diffForHumans() }}
                                    </span>

                                </div>

                            @empty

                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-clock-history fs-2"></i>
                                    <p class="mt-2 mb-0">
                                        No recent activity yet.
                                    </p>
                                </div>

                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <script>
        // Responsive sidebar
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('menuToggle');

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', () => {
            if (window.innerWidth <= 991) {
                const isOpen = sidebar.classList.toggle('show');
                overlay.classList.toggle('show', isOpen);
                toggle.setAttribute(
                    'aria-expanded',
                    String(isOpen)
                );
            }
        });

        overlay.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth > 991) {
                closeSidebar();
            }
        });

        // Dynamic enrollment chart
        const enrollmentData = @json([
            $statuses['enrolled'],
            $statuses['pending'],
            $statuses['dropped']
        ]);

        const hasData = enrollmentData.some(value => value > 0);

        const ctx = document.getElementById('enrollmentChart');

        new Chart(ctx, {
            type: 'doughnut',

            data: {
                labels: ['Enrolled', 'Pending', 'Dropped'],

                datasets: [{
                    data: hasData
                        ? enrollmentData
                        : [1],

                    backgroundColor: hasData
                        ? ['#0875ed', '#ff9812', '#a1a6ae']
                        : ['#e5e7eb'],

                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: hasData ? 5 : 0
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        enabled: hasData
                    }
                }
            }
        });
    </script>

</body>
</html>
