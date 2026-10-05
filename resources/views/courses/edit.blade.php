@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card shadow-sm">

            <div class="card-header bg-dark text-white">

                <h4 class="mb-0">
                    Edit Course
                </h4>

            </div>


            <div class="card-body">

                <form
                    action="{{ route('courses.update', $course->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <!-- Course Code -->

                    <div class="mb-3">

                        <label
                            for="course_code"
                            class="form-label"
                        >
                            Course Code
                        </label>

                        <input
                            type="text"
                            name="course_code"
                            id="course_code"
                            value="{{ old('course_code', $course->course_code) }}"
                            class="form-control @error('course_code') is-invalid @enderror"
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

                        <label
                            for="course_name"
                            class="form-label"
                        >
                            Course Name
                        </label>

                        <input
                            type="text"
                            name="course_name"
                            id="course_name"
                            value="{{ old('course_name', $course->course_name) }}"
                            class="form-control @error('course_name') is-invalid @enderror"
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

                        <label
                            for="description"
                            class="form-label"
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="form-control"
                        >{{ old('description', $course->description) }}</textarea>

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
                            Update Course
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection