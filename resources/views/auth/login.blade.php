
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMS | Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(rgba(0, 30, 65, 0.15),
                rgba(0, 30, 65, 0.15)),
                url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1600&q=85');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            padding: 25px 30px;
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.93);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.20);

            backdrop-filter: blur(5px);
        }

        .logo {
            font-size: 48px;
            color: #0871d1;
            line-height: 1;
        }

        .system-title {
            font-size: 30px;
            font-weight: bold;
            color: #102447;
            margin-bottom: 0;
        }

        .system-subtitle {
            font-size: 16px;
            font-weight: bold;
            color: #102447;
            line-height: 1.3;
        }

        .login-heading {
            font-size: 14px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 12px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .input-group-text {
            background: white;
            border-right: none;
            color: #18365f;
        }

        .form-control {
            border-left: none;
            font-size: 13px;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .form-check-label {
            font-size: 12px;
            color: #344763;
        }

        .forgot-link {
            font-size: 12px;
            text-decoration: none;
            color: #006bd0;
        }

        .btn-login {
            background-color: #0871d1;
            color: white;
            font-weight: bold;
            font-size: 14px;
            padding: 10px;
            border: none;
        }

        .btn-login:hover {
            background-color: #0759a8;
            color: white;
        }

        .register-text {
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 0;
            color: #344763;
        }

        .register-text a {
            color: #006bd0;
            text-decoration: none;
        }

        .register-text a:hover,
        .forgot-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-card {
                max-width: 340px;
                padding: 25px 20px;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">

                <!-- LOGIN CARD -->
                <div class="login-card mx-auto text-center">

                    <!-- LOGO -->
                    <div class="logo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <!-- SYSTEM NAME -->
                    <h1 class="system-title">SIMS</h1>

                    <p class="system-subtitle">
                        Student Information<br>
                        Management System
                    </p>

                    <h6 class="login-heading">
                        Sign in to your account
                    </h6>

                    <!-- SESSION STATUS -->
                    @if (session('status'))
                        <div class="alert alert-success py-2 small">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- LOGIN FORM -->
                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <!-- EMAIL ADDRESS -->
                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email Address"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username">

                        </div>

                        @error('email')
                            <div class="text-danger text-start small mb-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- PASSWORD -->
                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password"
                                required
                                autocomplete="current-password">

                        </div>

                        @error('password')
                            <div class="text-danger text-start small mb-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- REMEMBER ME AND FORGOT PASSWORD -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="remember_me"
                                    name="remember">

                                <label class="form-check-label" for="remember_me">
                                    Remember me
                                </label>

                            </div>

                            @if (Route::has('password.request'))

                                <a href="{{ route('password.request') }}"
                                   class="forgot-link">
                                    Forgot password?
                                </a>

                            @endif

                        </div>

                        <!-- LOGIN BUTTON -->
                        <button type="submit" class="btn btn-login w-100">
                            Login
                        </button>

                    </form>

                    <!-- REGISTER LINK -->
                    <p class="register-text">
                        Don't have an account?

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        @endif
                    </p>

                </div>
                <!-- END LOGIN CARD -->

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
