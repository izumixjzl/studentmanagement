@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<h1 class="mb-4">Add Student</h1>

<form
    action="{{ route('students.store') }}"
    method="POST"
>

@csrf

<div class="card shadow-sm">

<div class="card-body">

<div class="row">

    <div class="col-md-4 mb-3">
        <label class="form-label">Student ID</label>

        <input
            type="text"
            name="student_id"
            class="form-control"
            value="{{ old('student_id') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">First Name</label>

        <input
            type="text"
            name="first_name"
            class="form-control"
            value="{{ old('first_name') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Middle Name</label>

        <input
            type="text"
            name="middle_name"
            class="form-control"
            value="{{ old('middle_name') }}"
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Last Name</label>

        <input
            type="text"
            name="last_name"
            class="form-control"
            value="{{ old('last_name') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Gender</label>

        <select name="gender" class="form-select" required>

            <option value="">Select Gender</option>

            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">
            Date of Birth
        </label>

        <input
            type="date"
            name="date_of_birth"
            class="form-control"
            value="{{ old('date_of_birth') }}"
        >

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email') }}"
            required
        >

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Phone
        </label>

        <input
            type="text"
            name="phone"
            class="form-control"
            value="{{ old('phone') }}"
        >

    </div>

    <div class="col-md-12 mb-3">

        <label class="form-label">
            Address
        </label>

        <textarea
            name="address"
            class="form-control"
            rows="3"
        >{{ old('address') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Course
        </label>

        <select
            name="course_id"
            class="form-select"
        >

            <option value="">
                Select Course
            </option>

            @foreach($courses as $course)

                <option
                    value="{{ $course->id }}"
                    {{ old('course_id') == $course->id ? 'selected' : '' }}
                >
                    {{ $course->course_code }}
                    - 
                    {{ $course->course_name }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Year Level
        </label>

        <select
            name="year_level"
            class="form-select"
            required
        >

            <option value="">Select Year</option>

            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>

        </select>

    </div>

</div>

<button class="btn btn-primary">
    Save Student
</button>

<a
    href="{{ route('students.index') }}"
    class="btn btn-secondary"
>
    Cancel
</a>

</div>

</div>

</form>

@endsection