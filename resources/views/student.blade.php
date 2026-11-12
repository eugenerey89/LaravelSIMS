
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMS | Students</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f3f7ff;
            font-family: Arial, sans-serif;
            color: #102447;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background: linear-gradient(160deg, #10294e, #102b51);
            color: white;
            z-index: 1000;
            transition: .3s;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px;
            font-size: 25px;
            font-weight: bold;
        }

        .sidebar-brand i {
            font-size: 30px;
            color: #2196ff;
        }

        .sidebar-nav {
            padding: 10px 12px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 15px;
            margin-bottom: 7px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .nav-link-custom i {
            font-size: 18px;
            width: 22px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: #0862c9;
            color: white;
        }

        .nav-divider {
            border-top: 1px solid rgba(255,255,255,.15);
            margin: 20px 10px;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 65px;
            background: white;
            border-bottom: 1px solid #e3eaf4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 23px;
            color: #10294e;
        }

        .admin-button {
            display: flex;
            align-items: center;
            gap: 9px;
            border: none;
            background: none;
            font-size: 13px;
            font-weight: bold;
            color: #102447;
        }

        .admin-avatar {
            width: 35px;
            height: 35px;
            background: #dce5f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        /* PAGE CONTENT */
        .content {
            padding: 25px 30px;
        }

        .page-title {
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .page-subtitle {
            font-size: 13px;
            margin-bottom: 0;
            color: #344765;
        }

        /* ADD BUTTON */
        .btn-add {
            background: #0875ed;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #075fc3;
            color: white;
        }

        /* SEARCH */
        .search-box {
            position: relative;
            margin: 20px 0 12px;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #50658a;
        }

        .search-box input {
            width: 100%;
            padding: 11px 15px 11px 38px;
            border: 1px solid #dce5f2;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
        }

        .search-box input:focus {
            border-color: #0875ed;
            box-shadow: 0 0 0 2px rgba(8,117,237,.1);
        }

        /* TABLE */
        .table-container {
            background: white;
            border: 1px solid #dce5f2;
            border-radius: 7px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(20,50,100,.04);
        }

        .student-table {
            margin-bottom: 0;
            font-size: 13px;
        }

        .student-table thead th {
            background: #eaf1f9;
            color: #102447;
            font-weight: bold;
            padding: 11px 12px;
            white-space: nowrap;
            border-color: #dce5f2;
        }

        .student-table tbody td {
            padding: 9px 12px;
            vertical-align: middle;
            border-color: #e2e9f3;
        }

        .student-table tbody tr:hover {
            background: #f4f8ff;
        }

        /* ACTION BUTTONS */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action {
            width: 29px;
            height: 27px;
            border: none;
            border-radius: 4px;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-view,
        .btn-edit {
            background: #0875ed;
        }

        .btn-delete {
            background: #ef4054;
        }

        .btn-action:hover {
            opacity: .8;
            color: white;
        }

        /* FOOTER */
        .table-footer {
            padding: 13px 15px;
            font-size: 12px;
            color: #344765;
        }

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */
        @media(max-width: 991px) {
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
                background: rgba(0,0,0,.4);
                z-index: 999;
            }
        }

        @media(max-width: 576px) {
            .content {
                padding: 20px 14px;
            }

            .topbar {
                padding: 0 15px;
            }

            .page-title {
                font-size: 24px;
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

                    
        @if(Route::has('subjects.index'))
            <a href="{{ route('subjects.index') }}" class="nav-link-custom">
                <i class="bi bi-book-fill"></i>
                Subjects
            </a>
        @else
            <a href="#" class="nav-link-custom">
                <i class="bi bi-book-fill"></i>
                Subjects
            </a>
        @endif

        @if(Route::has('enrollments.index'))
            <a href="{{ route('enrollments.index') }}" class="nav-link-custom">
                <i class="bi bi-clipboard2-check-fill"></i>
                Enrollments
            </a>
        @else
            <a href="#" class="nav-link-custom">
                <i class="bi bi-clipboard2-check-fill"></i>
                Enrollments
            </a>
        @endif

        @if(Route::has('users.index'))
            <a href="{{ route('users.index') }}" class="nav-link-custom">
                <i class="bi bi-shield-fill"></i>
                Users
            </a>
        @else
            <a href="#" class="nav-link-custom">
                <i class="bi bi-shield-fill"></i>
                Users
            </a>
        @endif


            <div class="nav-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-custom w-100">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <button class="menu-toggle" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>

            <div class="dropdown">

                <button class="admin-button dropdown-toggle"
                        data-bs-toggle="dropdown">

                    <span class="admin-avatar">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    {{ Auth::user()->name }}

                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>

            </div>

        </header>

        <!-- STUDENT PAGE -->
        <div class="content">

            <!-- PAGE HEADING -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h2 class="page-title">Students</h2>
                    <p class="page-subtitle">Manage student records</p>
                </div>

                @if(Route::has('students.create'))
                    <a href="{{ route('students.create') }}" class="btn-add">
                        <i class="bi bi-plus-lg"></i>
                        Add Student
                    </a>
                @endif

            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3">
                    {{ session('success') }}
                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- SEARCH BAR -->
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text"
                       id="studentSearch"
                       placeholder="Search students...">
            </div>

            <!-- STUDENT TABLE -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered student-table" id="studentTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $index => $stud)
                            <tr>
                                <td>{{ $stud->id }}</td>
                                <td>{{ $stud->first_name }}</td>
                                <td>{{ $stud->last_name }}</td>
                                <td>{{ $stud->email }}</td>
                                <td>{{ $stud->course }}</td>
                                <td>{{ $stud->year }}</td>
                                <!-- ACTIONS -->
                                <td>
                                    <div class="action-buttons">
                                        <!-- VIEW -->
                                        <a href="{{ route('students.show', $stud->id) }}"
                                           class="btn-action btn-view"
                                           title="View Student">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <!-- EDIT -->
                                        <a href="{{ route('students.edit', $stud->id) }}"
                                           class="btn-action btn-edit"
                                           title="Edit Student">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <!-- DELETE -->
                                        <form action="{{ route('students.destroy', $stud->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this student?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn-action btn-delete"
                                                    title="Delete Student">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    Showing {{ $student->count() }} student records
                </div>
            </div>
        </div>
    </main>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JAVASCRIPT -->
    <script>

        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('menuToggle');

        toggle.addEventListener('click', function() {
            if (window.innerWidth <= 991) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Student search
        document.getElementById('studentSearch').addEventListener('keyup', function() {

            let searchValue = this.value.toLowerCase();

            document.querySelectorAll('#studentTable tbody tr').forEach(function(row) {

                let rowText = row.textContent.toLowerCase();

                row.style.display = rowText.includes(searchValue) ? '' : 'none';

            });

        });

    </script>

</body>
</html>
