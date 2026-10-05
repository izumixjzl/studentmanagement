@extends('layouts.app')

@section('title', 'Students')

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
        <h1 class="sl-title">Students List</h1>

        <div class="sl-breadcrumb">
            <a href="{{ route('dashboard') }}">Home</a>
            &nbsp;/&nbsp;
            <span class="current">Students</span>
        </div>
    </div>

    <a
        href="{{ route('students.create') }}"
        class="btn btn-sl"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Add Students
    </a>

</div>


<div class="sl-card">

    <!-- TOOLBAR -->

    <form
        method="GET"
        action="{{ route('students.index') }}"
        class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 px-1"
    >

        <h2 class="sl-card-title">Students Information</h2>

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
                    placeholder="Search by name or ID"
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
        action="{{ route('students.bulk-destroy') }}"
        method="POST"
        onsubmit="return confirm('Delete the selected students?');"
    >
        @csrf
        @method('DELETE')
    </form>


    @if($students->count() > 0)

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
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($students as $student)

                        <tr>

                            <td>
                                <input
                                    type="checkbox"
                                    class="form-check-input row-check"
                                    name="ids[]"
                                    value="{{ $student->id }}"
                                    form="bulk-form"
                                    aria-label="Select {{ $student->first_name }}"
                                >
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2">

                                    <span
                                        class="sl-avatar"
                                        style="background: {{ $avatarColors[$student->id % count($avatarColors)] }};"
                                    >
                                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                    </span>

                                    <a
                                        href="{{ route('students.show', $student->id) }}"
                                        class="sl-name"
                                    >
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </a>

                                </div>
                            </td>

                            <td>#{{ $student->student_id }}</td>

                            <td>{{ $student->address ? \Illuminate\Support\Str::limit($student->address, 25) : 'N/A' }}</td>

                            <td>
                                @if($student->course_code)
                                    <span title="{{ $student->course_name }}">{{ $student->course_code }}</span>
                                    <small class="text-muted d-block">{{ $student->year_level }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                            <td>
                                {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('m/d/Y') : 'N/A' }}
                            </td>

                            <td>{{ $student->phone ?? 'N/A' }}</td>

                            <td class="text-center text-nowrap">

                                <a
                                    href="{{ route('students.show', $student->id) }}"
                                    class="sl-action"
                                    title="View"
                                >
                                    <i class="bi bi-eye"></i>
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
                                        class="sl-action delete"
                                        title="Delete"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>

                                <a
                                    href="{{ route('students.edit', $student->id) }}"
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

            <h5 class="text-muted">No Students Found</h5>

            <p class="text-muted">
                @if($search !== '' || $days)
                    No students match your search or filter.
                    <a href="{{ route('students.index') }}">Clear filters</a>
                @else
                    There are currently no students registered.
                @endif
            </p>

        </div>

    @endif

</div>


<!-- PAGINATION -->

@include('partials.list-pagination', ['paginator' => $students, 'route' => 'students.index'])

@endsection


@push('scripts')
@include('partials.list-bulk-script')
@endpush
