@extends('layouts.app')

@section('title', 'Course Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Course Details</h2>

        <p class="text-muted mb-0">
            View course information and enrolled students
        </p>
    </div>

    <div>

        <a
            href="{{ route('courses.edit', $course->id) }}"
            class="btn btn-warning"
        >
            Edit
        </a>

        <a
            href="{{ route('courses.index') }}"
            class="btn btn-secondary"
        >
            Back
        </a>

    </div>

</div>


<div class="card shadow-sm mb-4">

    <div class="card-body">

        <h5>Course Code</h5>

        <p>
            <span class="badge bg-primary">
                {{ $course->course_code }}
            </span>
        </p>


        <h5>Course Name</h5>

        <p>
            {{ $course->course_name }}
        </p>


        <h5>Description</h5>

        <p>
            {{ $course->description ?? 'No description' }}
        </p>

    </div>

</div>


<!-- ENROLLED STUDENTS -->

<div class="card shadow-sm">

    <div class="card-header">
        Enrolled Students ({{ $course->students->count() }})
    </div>

    <div class="card-body">

        @if($course->students->isEmpty())

            <p class="text-muted mb-0">
                No students enrolled in this course.
            </p>

        @else

            <table class="table table-hover mb-0">

                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Year Level</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($course->students as $student)

                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->year_level ?? 'N/A' }}</td>
                            <td class="text-end">
                                <a
                                    href="{{ route('students.show', $student->id) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    View
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @endif

    </div>

</div>


<!-- ACTIONS -->

<div class="mt-4">

    <form
        action="{{ route('courses.destroy', $course->id) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this course?');"
    >

        @csrf

        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger"
        >
            Delete Course
        </button>

    </form>

</div>

@endsection
