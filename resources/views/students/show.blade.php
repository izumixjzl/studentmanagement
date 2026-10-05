@extends('layouts.app')

@section('title', 'View Student')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Student Details</h2>

        <p class="text-muted mb-0">
            View complete student information
        </p>
    </div>

    <div>

        <a
            href="{{ route('students.edit', $student->id) }}"
            class="btn btn-warning"
        >
            Edit
        </a>

        <a
            href="{{ route('students.index') }}"
            class="btn btn-secondary"
        >
            Back
        </a>

    </div>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <div class="row">

            <!-- LEFT SIDE -->

            <div class="col-md-6">

                <h5>Student ID</h5>

                <p>
                    {{ $student->student_id ?? 'N/A' }}
                </p>


                <h5>Name</h5>

                <p>
                    {{ $student->first_name ?? '' }}
                    {{ $student->last_name ?? '' }}
                </p>


                <h5>Gender</h5>

                <p>
                    {{ $student->gender ?? 'N/A' }}
                </p>


                <h5>Date of Birth</h5>

                <p>
                    {{ $student->date_of_birth ?? 'N/A' }}
                </p>

            </div>


            <!-- RIGHT SIDE -->

            <div class="col-md-6">

                <h5>Email</h5>

                <p>
                    {{ $student->email ?? 'N/A' }}
                </p>


                <h5>Phone</h5>

                <p>
                    {{ $student->phone ?? 'N/A' }}
                </p>


                <h5>Course</h5>

                <p>

                    @if($student->course)

                        <span class="badge bg-primary">
                            {{ $student->course->course_code }}
                        </span>

                        <br>

                        {{ $student->course->course_name }}

                    @else

                        <span class="text-danger">
                            No Course Assigned
                        </span>

                    @endif

                </p>


                <h5>Year Level</h5>

                <p>
                    {{ $student->year_level ?? 'N/A' }}
                </p>

            </div>


            <!-- ADDRESS -->

            <div class="col-md-12">

                <h5>Address</h5>

                <p>
                    {{ $student->address ?? 'N/A' }}
                </p>

            </div>

        </div>

    </div>

</div>


<!-- ACTIONS -->

<div class="mt-4">

    <a
        href="{{ route('students.edit', $student->id) }}"
        class="btn btn-warning"
    >
        Edit Student
    </a>


    <form
        action="{{ route('students.destroy', $student->id) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this student?');"
    >

        @csrf

        @method('DELETE')

        <button
            type="submit"
            class="btn btn-danger"
        >
            Delete Student
        </button>

    </form>

</div>

@endsection