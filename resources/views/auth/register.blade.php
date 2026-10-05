<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sign Up</title>

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

    <style>
        .line-input {
            margin-bottom: 20px;
        }

        .line-input.is-invalid {
            border-color: #dc3545;
        }

        .field-error {
            color: #dc3545;
            font-size: 0.75rem;
            margin: -14px 0 14px 30px;
        }

        .toggle-password {
            border: none;
            background: none;
            color: #aaa;
            padding: 0;
        }

        .toggle-password:hover {
            color: var(--brand);
        }

        .toggle-password i {
            color: inherit;
        }
    </style>

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
                Education Is The Passport To The Future
            </p>

            @include('partials.auth-illustration')

        </div>


        <!-- SIGN UP CARD -->

        <div class="col-lg-6 col-md-6">

            <div class="login-card">

                <div class="login-header">
                    <div class="avatar">
                        <i class="bi bi-person-plus"></i>
                    </div>
                </div>

                <div class="login-body">

                    <div class="role-label">
                        Create your account
                    </div>

                    <form
                        action="{{ route('register.store') }}"
                        method="POST"
                        novalidate
                    >

                        @csrf

                        <div class="line-input @error('name') is-invalid @enderror">
                            <i class="bi bi-person-fill"></i>
                            <input
                                type="text"
                                name="name"
                                placeholder="Full name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                        </div>
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <div class="line-input @error('email') is-invalid @enderror">
                            <i class="bi bi-envelope-fill"></i>
                            <input
                                type="email"
                                name="email"
                                placeholder="Email address"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <div class="line-input @error('password') is-invalid @enderror">
                            <i class="bi bi-lock-fill"></i>
                            <input
                                type="password"
                                name="password"
                                placeholder="Password (min. 8 characters)"
                                required
                            >
                            <button
                                type="button"
                                class="toggle-password"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <div class="line-input">
                            <i class="bi bi-shield-lock-fill"></i>
                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm password"
                                required
                            >
                            <button
                                type="button"
                                class="toggle-password"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="d-flex align-items-center gap-3 mt-4">

                            <button
                                type="submit"
                                class="btn btn-signin"
                            >
                                Sign Up
                            </button>

                            <span class="signup-link">
                                Already have an account?
                                <a href="{{ route('login') }}">Sign in</a>
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


<script>
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = button.parentElement.querySelector('input');
            const show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            button.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        });
    });
</script>

</body>

</html>
