<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMS | Register</title>

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
            padding: 25px 0;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
            padding: 25px 30px;
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.93);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.20);

            backdrop-filter: blur(5px);
        }

        .logo {
            font-size: 45px;
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

        .register-heading {
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
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

        .btn-register {
            background-color: #0871d1;
            color: white;
            font-weight: bold;
            font-size: 14px;
            padding: 10px;
            border: none;
        }

        .btn-register:hover {
            background-color: #0759a8;
            color: white;
        }

        .login-text {
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 0;
            color: #344763;
        }

        .login-text a {
            color: #006bd0;
            text-decoration: none;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            font-size: 12px;
            text-align: left;
            margin-top: -5px;
            margin-bottom: 8px;
        }

        @media (max-width: 576px) {
            .register-card {
                max-width: 350px;
                padding: 25px 20px;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">

                <!-- REGISTRATION CARD -->
                <div class="register-card mx-auto text-center">

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

                    <h6 class="register-heading">
                        Create your account
                    </h6>

                    <!-- REGISTRATION FORM -->
                    <form method="POST" action="{{ route('register') }}">

                        @csrf

                        <!-- NAME -->
                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Full Name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name">

                        </div>

                        @error('name')
                            <div class="text-danger error-message">
                                {{ $message }}
                            </div>
                        @enderror

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
                                autocomplete="username">

                        </div>

                        @error('email')
                            <div class="text-danger error-message">
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
                                autocomplete="new-password">

                        </div>

                        @error('password')
                            <div class="text-danger error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- CONFIRM PASSWORD -->
                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-shield-lock-fill"></i>
                            </span>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm Password"
                                required
                                autocomplete="new-password">

                        </div>

                        @error('password_confirmation')
                            <div class="text-danger error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- REGISTER BUTTON -->
                        <button type="submit" class="btn btn-register w-100 mt-2">
                            Register
                        </button>

                    </form>

                    <!-- LOGIN LINK -->
                    <p class="login-text">
                        Already have an account?

                        <a href="{{ route('login') }}">
                            Login
                        </a>
                    </p>

                </div>
                <!-- END REGISTRATION CARD -->

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>