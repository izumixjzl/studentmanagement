@extends('layouts.app')

@section('title', 'Courses')

@push('styles')
@include('partials.list-styles')
@endpush

@section('content')

@php
    $avatarColors = ['#f59f00', '#7a1fd6', '#1c7ed6', '#e8590c', '#2f9e44', '#d6336c', '#0ca678', '#5c7cfa'];
@endphp


<!-- HEADER -->

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>
        <h1 class="sl-title">Courses List</h1>

        <div class="sl-breadcrumb">
            <a href="{{ route('dashboard') }}">Home</a>
            &nbsp;/&nbsp;
            <span class="current">Courses</span>
        </div>
    </div>

    <a
        href="{{ route('courses.create') }}"
        class="btn btn-sl"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Add Course
    </a>

</div>


<div class="sl-card">

    <!-- TOOLBAR -->

    <form
        method="GET"
        action="{{ route('courses.index') }}"
        class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 px-1"
    >

        <h2 class="sl-card-title">Courses Information</h2>

        <div class="d-flex flex-wrap align-items-center gap-2">

            <button
                type="submit"
                form="bulk-form"
                id="bulk-delete"
                class="btn btn-sm btn-outline-danger d-none"
            >
                <i class="bi bi-trash3 me-1"></i>
                Delete selected (<span id="bulk-count">0</span>)
            </button>

            <div class="sl-search">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search by code or name"
                >

                <button type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <select
                name="days"
                class="form-select sl-select w-auto"
                onchange="this.form.submit()"
            >
                <option value="">All time</option>
                <option value="7" @selected($days === 7)>Last 7 days</option>
                <option value="30" @selected($days === 30)>Last 30 days</option>
                <option value="90" @selected($days === 90)>Last 90 days</option>
            </select>

            <input type="hidden" name="per_page" value="{{ $perPage }}">

        </div>

    </form>


    <!-- BULK DELETE FORM (checkboxes attach to it via form="bulk-form") -->

    <form
        id="bulk-form"
        action="{{ route('courses.bulk-destroy') }}"
        method="POST"
        onsubmit="return confirm('Delete the selected courses? Students in them will become unassigned.');"
    >
        @csrf
        @method('DELETE')
    </form>


    @if($courses->count() > 0)

        <div class="table-responsive">

            <table class="table sl-table">

                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="select-all"
                                aria-label="Select all"
                            >
                        </th>
                        <th>Course Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Students</th>
                        <th>Date Added</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($courses as $course)

                        <tr>

                            <td>
                                <input
                                    type="checkbox"
                                    class="form-check-input row-check"
                                    name="ids[]"
                                    value="{{ $course->id }}"
                                    form="bulk-form"
                                    aria-label="Select {{ $course->course_name }}"
                                >
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2">

                                    <span
                                        class="sl-avatar"
                                        style="background: {{ $avatarColors[$course->id % count($avatarColors)] }};"
                                    >
                                        {{ strtoupper(substr($course->course_code, 0, 2)) }}
                                    </span>

                                    <a
                                        href="{{ route('courses.show', $course->id) }}"
                                        class="sl-name"
                                    >
                                        {{ $course->course_name }}
                                    </a>

                                </div>
                            </td>

                            <td>#{{ $course->course_code }}</td>

                            <td>
                                @if($course->description)
                                    <span title="{{ $course->description }}">
                                        {{ \Illuminate\Support\Str::limit($course->description, 40) }}
                                    </span>
                                @else
                                    <span class="text-muted">No description</span>
                                @endif
                            </td>

                            <td>{{ $course->students_count }}</td>

                            <td>{{ $course->created_at?->format('m/d/Y') }}</td>

                            <td class="text-center text-nowrap">

                                <a
                                    href="{{ route('courses.show', $course->id) }}"
                                    class="sl-action"
                                    title="View"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>

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
                                        class="sl-action delete"
                                        title="Delete"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>

                                <a
                                    href="{{ route('courses.edit', $course->id) }}"
                                    class="sl-action"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="text-center py-5">

            <h5 class="text-muted">No Courses Found</h5>

            <p class="text-muted">
                @if($search !== '' || $days)
                    No courses match your search or filter.
                    <a href="{{ route('courses.index') }}">Clear filters</a>
                @else
                    There are currently no courses.
                @endif
            </p>

        </div>

    @endif

</div>


<!-- PAGINATION -->

@include('partials.list-pagination', ['paginator' => $courses, 'route' => 'courses.index'])

@endsection


@push('scripts')
@include('partials.list-bulk-script')
@endpush
