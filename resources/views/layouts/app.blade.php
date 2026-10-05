<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Student Management System')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    @stack('styles')
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Student Management System
        </a>

        @auth
            <div class="d-flex align-items-center">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn btn-outline-light me-2"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('students.index') }}"
                    class="btn btn-outline-light me-2"
                >
                    Students
                </a>

                <a
                    href="{{ route('courses.index') }}"
                    class="btn btn-outline-light me-2"
                >
                    Courses
                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-inline"
                >
                    @csrf

                    <button class="btn btn-danger">
                        Logout
                    </button>
                </form>

            </div>
        @endauth

    </div>
</nav>

<main class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')


    @if($errors->any())

    <div class="alert alert-danger">

        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>