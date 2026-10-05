<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap"
        rel="stylesheet"
    >

    @include('partials.auth-styles')

</head>

<body>

<main>

<div class="container py-5">

    <div class="brand mb-5 ms-md-5">
        <span class="brand-logo">S</span>
        <span>Student Management</span>
    </div>

    <div class="row align-items-center g-5">

        <!-- LEFT SIDE -->

        <div class="col-lg-6 text-center d-none d-md-block">

            <p class="quote mb-4">
                A Building With Four Walls And Tomorrow Inside
            </p>

            @include('partials.auth-illustration')

        </div>


        <!-- LOGIN CARD -->

        <div class="col-lg-6 col-md-6">

            <div class="login-card">

                <div class="login-header">
                    <div class="avatar">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                </div>

                <div class="login-body">

                    <div class="role-label">
                        Welcome back
                    </div>

                    @if($errors->any())

                        <div class="alert alert-danger py-2 small">
                            {{ $errors->first() }}
                        </div>

                    @endif

                    <form
                        action="{{ route('login.store') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="line-input">
                            <i class="bi bi-person-fill"></i>
                            <input
                                type="email"
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                        </div>

                        <div class="line-input">
                            <i class="bi bi-lock-fill"></i>
                            <input
                                type="password"
                                name="password"
                                placeholder="Password"
                                required
                            >
                        </div>

                        <div class="options d-flex justify-content-between align-items-center mb-4">
                            <label class="d-flex align-items-center gap-1">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="form-check-input mt-0"
                                >
                                Remember me
                            </label>
                        </div>

                        <div class="d-flex align-items-center gap-3">

                            <button
                                type="submit"
                                class="btn btn-signin"
                            >
                                Sign In
                            </button>

                            <span class="signup-link">
                                New user?
                                <a href="{{ route('register') }}">Sign up</a>
                            </span>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</main>


<footer>
    &copy; {{ date('Y') }} Student Management System
</footer>

</body>

</html>
