@extends('layouts.app')

@section('title', 'Add Course')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card shadow-sm">

            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Add Course</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('courses.store') }}" method="POST">

                    @csrf

                    <!-- Course Code -->
                    <div class="mb-3">

                        <label for="course_code" class="form-label">
                            Course Code
                        </label>

                        <input
                            type="text"
                            id="course_code"
                            name="course_code"
                            value="{{ old('course_code') }}"
                            class="form-control @error('course_code') is-invalid @enderror"
                            placeholder="Example: BSIT"
                            required
                        >

                        @error('course_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Course Name -->
                    <div class="mb-3">

                        <label for="course_name" class="form-label">
                            Course Name
                        </label>

                        <input
                            type="text"
                            id="course_name"
                            name="course_name"
                            value="{{ old('course_name') }}"
                            class="form-control @error('course_name') is-invalid @enderror"
                            placeholder="Example: Bachelor of Science in Computer Science"
                            required
                        >

                        @error('course_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Description -->
                    <div class="mb-3">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter course description..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('courses.index') }}"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-dark"
                        >
                            Add Course
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection